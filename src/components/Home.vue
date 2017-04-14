<template lang="html">
  <div class="container main">
      <div class="row">
          <div class="col-md-6 col-md-offset-2" style="margin-top:100px">
              <add-employee></add-employee>
          </div>
      </div>
      <!-- <button type="button" name="button" @click="seedDB">Seed DB</button> -->
      <div class="row">
        <transition-group @enter="fadeInUp" @leave="fadeOut" appear>  <employee v-for="(employee,index) in employees" :employee="employee" :index="index" :key="index"></employee></transition-group>

      </div>

  </div>
</template>

<script>
import {
    eventBus
} from '../main.js';
import AddEmployee from './employee/add-employee.vue';
import Employee from './employee/employees.vue';
import NavBar from './nav/navbar.vue';
export default {
  name: 'app',
  components: {
      addEmployee: AddEmployee,
      employee: Employee,
      appNavBar: NavBar
  },
  data() {
      return {
          employees: [],
          loading:false,
          loadingDone:false
      }
  },
  methods: {
    fadeOut(el,done){
      let tl = new TimelineMax;
      tl.to(el,.2,{
        opacity:0,
        delay:.3,
        onComplete:done
      })
    },
    fadeInUp(el,done){
      let tl = new TimelineMax;
      tl.from(el,.2,{
        y:20,
        opacity:0,
        delay:.3,
        onComplete:done
      })
    },
      deleteEmployee(employee) {
          let formData = new FormData();
          formData.append('img', employee.img);
          formData.append('id', employee.id);
          this.$http.post('http://localhost/api/routes/employees/delete.php', formData, {
                      emulateJSON: true,
                    })
                  .then(response => {
                      if (response.ok) {
                          console.log("Employee removed successfully");
                      } else {
                          console.error('there was an error')
                      }
                  })
              },
              seedDB() {
                  // this.$http.get('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/employees.php')
                  this.$http.get('http://localhost/api/routes/employees/seed-employees.php') //codigo local host
                      // this.$http.get('http://localhost/api/routes/employees/seed.employees.php') //home local host
                      .then(response => {
                          console.log(response.bodyText);
                          this.get();
                          this.employees = JSON.parse(response.bodyText);
                      })
              },
              get() {
                  // this.$http.get('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/employees.php')
                  this.$http.get('http://localhost/api/routes/employees/get-post.php')
                      // this.$http.get('http://localhost/api/routes/employees/get-post.php')
                      .then(response => {
                          console.log(response);
                          if (response.ok) {
                              console.log(response.body);
                              this.employees = JSON.parse(response.bodyText);
                          } else {
                              console.error(response.statusText);

                          }

                      })
              },

      },
      mounted() {
          this.get();

      },
      computed: {

      },
      created() {
          eventBus.$on('employeeAdded', (employee) => {
              console.log(employee);
              this.employees.push(employee);
          });
          eventBus.$on('employeeDeleted', (payload) => {
              console.log(payload.entry);
              this.deleteEmployee(payload.entry);
              this.employees.splice(payload.index, 1);

          });
          eventBus.$on('uploading',(status)=>{
            console.log(status);
            this.loading=status;
          })
      }

  }
</script>

<style scoped>
input[type="file"] {
  display: block;
}

.xp-bar {
  width: 100%;
  height:3px;
  position:fixed;
  top:64px;
  z-index:999;
}

.xp-bar .fill {
  background-color: #A3C44E;
  height: 100%;
  transition: 2s width ease,.5s opacity ease;
}

@media (min-width: 1920px) {
  .container.main {
      width: 97%;
  }
}
</style>
