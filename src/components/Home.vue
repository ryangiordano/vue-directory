<template lang="html">
<div>
    <div class="banner">

    </div>
    <!-- search -->

  <div class="container main" >
      <div class="row">
          <div class="col-md-4" style="margin-top:100px">

          </div>
      </div>
      <!-- <button type="button" name="button" @click="seedDB">Seed DB</button> -->
      <div class="row">
        <transition-group @enter="fadeInUp"  appear>
          {{employeesMessage}}
          <employee v-for="(employee,index) in employees" :employee="employee" :index="index" :key="index"></employee>
        </transition-group>

      </div>

  </div></div>
</template>

<script>
import {
    eventBus
} from '../main.js';
import {
    EmployeeHttp
} from '../mixins/employee';
import AddEmployee from './employee/add-employee.vue';
import Employee from './employee/employees.vue';
import NavBar from './nav/navbar.vue';
export default {
    name: 'app',
    mixins:[EmployeeHttp],
    components: {
        addEmployee: AddEmployee,
        employee: Employee,
        appNavBar: NavBar,
    },
    data() {
        return {
            employees: [],
            loading: false,
            loadingDone: false,
            searchQuery: '',
            employeesMessage:''
        }
    },
    methods: {
        fadeOut(el, done) {
            let tl = new TimelineMax;
            tl.to(el, .2, {
                opacity: 0,
                delay: .3,
                onComplete: done
            })
        },
        fadeInUp(el, done) {
            let tl = new TimelineMax;
            tl.from(el, .2, {
                y: 20,
                opacity: 0,
                delay: .3,
                onComplete: done
            })
        },
        delete(employee) {
          this.deleteEmployee(employee);
        },
        seedDB() {
            // this.$http.get('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/employees.php')
            this.$http.get('http://localhost/api/routes/employees/seed-employees.php') //codigo local host
                // this.$http.get('http://localhost/api/routes/employees/seed.employees.php') //home local host
                .then(response => {
                    this.get();
                    this.employees = JSON.parse(response.bodyText);
                })
        },
        get() {
          this.getEmployees();
        },

    },
    mounted() {
        this.get();

    },
    computed: {
        loggedIn() {
            return this.$store.getters.loggedIn;
        }
    },
    created() {
        eventBus.$on('employeeAdded', (employee) => {
            console.log(employee);
            this.employees.push(employee);
        });
        eventBus.$on('employeeDeleted', (payload) => {
            this.delete(payload.entry);
            this.employees.splice(payload.index, 1);

        });
        eventBus.$on('uploading', (status) => {
            console.log(status);
            this.loading = status;
        })
    }

}
</script>

<style scoped>
input[type="file"] {
    display: block;
}

.banner {
    width: 100%;
    height: 300px;
    background-color: red;
    margin-top: 60px;
    background-image: url('/src/assets/images/banner.jpg');
    background-size: contain;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.xp-bar {
    width: 100%;
    height: 3px;
    position: fixed;
    top: 64px;
    z-index: 999;
}

.xp-bar .fill {
    background-color: #A3C44E;
    height: 100%;
    transition: 2s width ease, .5s opacity ease;
}



@media (min-width: 1920px) {
    .container.main {
        width: 97%;
    }
}
</style>
