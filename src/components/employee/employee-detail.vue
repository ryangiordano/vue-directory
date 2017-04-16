<template lang="html">
<div class="container"><div class="row">
  <div class="col-md-12">
    <div class="panel" style="margin-top:100px;">
      <div class="panel-heading">
        <div class=""style="position:relative;">
  <span v-show="loggedIn"><span  @click="editEmployee(employee)" v-if="loggedIn" class="edit icon"><img src="/src/assets/images/edit.png" /></span>
          <span  @click="deleteEmployee(employee,index)" v-if="loggedIn" class="delete icon"><img src="/src/assets/images/x.png" /></span></span>
        </div>
      <h3>{{employee.firstName}} {{employee.lastName}}</h3>

      </div>
      <div class="panel-body">

      <div class="row">
        <div class="col-md-4">
                <img :src="`/api/src/assets/images/ryan/${employee.img}`" class="" alt="" style="height:300px;">
        </div>
        <div class="col-md-6">
          <h4>Title</h4>
          <p @dblclick="edit" v-if="!editing">{{employee.title}}</p>
          <input type="text" name="" @keypress.enter="commitEdit"v-if="editing" v-model="employee.title">
          <h4>Branch</h4>
          <p @dblclick="edit" v-if="!editing">{{employee.branch}}</p>
          <input type="text" name="" @keypress.enter="commitEdit"v-if="editing" v-model="employee.branch">

          <h4>email</h4>
          <p @dblclick="edit" v-if="!editing">{{employee.email}}</p>
          <input type="text" name="" @keypress.enter="commitEdit"v-if="editing" v-model="employee.email">
          <h4>phone</h4>
          <p @dblclick="edit" v-if="!editing">{{employee.phone}}</p>
          <input type="text" name="" @keypress.enter="commitEdit"v-if="editing" v-model="employee.phone">
          <h4>About</h4>
          <p @dblclick="edit" v-if="!editing">{{employee.about}}</p>
          <textarea type="text" name="" @keypress.enter="commitEdit"v-if="editing" value="" v-model="employee.about"></textarea>
        </div>
      </div>
      </div>
    </div>
  </div>
</div></div>
</template>

<script>
import {
    EmployeeHttp
} from '../../mixins/employee';
export default {
    mixins: [EmployeeHttp],
    data: function() {
        return {
            employee: {
              email:""
            },
            editing:false,

        }
    },
    computed: {
        loggedIn() {
            return this.$store.getters.loggedIn;
        }
    },
    methods: {
        edit() {
          this.editing = !this.editing;
        },
        commitEdit(){
          this.editing = !this.editing;
          this.editEmployee();
        }
    },
    created() {
        let id = this.$route.params.id;
        this.getEmployee(id);
        console.log(this.employee);
    },
    deleteEmployee(entry, index) {
      let r = confirm('Are you sure you want to delete '+entry.firstName+'\'s entry?');
      if(r){
        let payload = {
            entry,
            index
        };
        eventBus.$emit('employeeDeleted', payload)
      }
    },
    editEmployee(entry) {
        this.$router.push({
            path: `/edit/${entry.id}`
        })

    }
}
</script>

<style scoped>
.icon {
    cursor: pointer;
    position: absolute;
}
.icon.delete {
    top: 10px;
    right: 30px;
}
.icon.edit{
  top:10px;
  right:65px;
}

.icon img {
    height: 25px;
}
</style>
