<template lang="html">
<div class="container"><div class="row">
  <div class="col-md-12">
    <div class="panel" style="margin-top:100px;">
      <div class="panel-heading">
        <div class=""style="position:relative;">
  <span v-show="loggedIn">
    <button type="button" class="btn btn-default save"name="button" @click="commitEdit">Save</button>
    <span  @click="editing = !editing" v-if="loggedIn" class="edit icon">
    <svg version="1.1"
  	 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
  	 x="0px" y="0px" width="25px" height="25px" viewBox="-13 -6.146 253 234" enable-background="new -13 -6.146 253 234"
  	 xml:space="preserve">
  <defs>
  </defs>
  <path :fill="fillColorEdit" d="M198.5,222.604H9c-4.962,0-9-4.037-9-9v-173.5c0-4.962,4.038-9,9-9h133.813v10H10v171.5h187.5v-133.5h10
  	v134.5C207.5,218.567,203.463,222.604,198.5,222.604z"/>
  <path :fill="fillColorEdit" d="M72.913,166.298c-2.235,0-4.283-0.95-5.619-2.606c-1.416-1.755-1.905-4.062-1.377-6.496l5.832-26.905
  	c0.671-3.097,2.785-6.972,5.027-9.213L195.222,2.631C196.918,0.934,199.178,0,201.585,0s4.667,0.934,6.363,2.631l20.484,20.484
  	c3.51,3.509,3.51,9.219,0,12.729L109.986,154.288c-2.2,2.2-5.986,4.356-9.003,5.126l-25.916,6.605
  	C74.346,166.204,73.621,166.298,72.913,166.298z M201.585,10.41L83.847,128.147c-0.87,0.87-2.064,3.06-2.325,4.261l-4.966,22.913
  	l21.956-5.597c1.262-0.322,3.484-1.587,4.404-2.507L220.655,29.479L201.585,10.41z"/>
  </svg></span>
          <span  @click="onDelete(employee)" v-if="loggedIn" class="delete icon"><svg version="1.1"
          	 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
          	 x="0px" y="0px" width="25px" height="25px" viewBox="0 0 209 209" enable-background="new 0 0 209 209" xml:space="preserve">
          <defs>
          </defs>
          <line fill="none" :stroke="fillColorDelete" stroke-width="10" stroke-miterlimit="10" x1="3.536" y1="3.536" x2="205.536" y2="205.536"/>
          <line fill="none" :stroke="fillColorDelete" stroke-width="10" stroke-miterlimit="10" x1="205.536" y1="3.536" x2="3.536" y2="205.536"/>
          </svg></span></span>
        </div>
<div class="row">
  <div class="col-md-8">
    <h3 v-if="!editing">{{employee.firstName}} {{employee.lastName}}</h3>
  <div class="col-md-4">  <input type="text"style="font-size:24px; width:100%;" name="" @keypress.enter="commitEdit"v-if="editing" v-model="employee.firstName"></div>
    <div class="col-md-4"><input type="text"style="font-size:24px; width:100%;" name="" @keypress.enter="commitEdit"v-if="editing" v-model="employee.lastName"></div>
  </div>
</div>
      </div>

      <div class="panel-body">

      <div class="row">
        <div class="col-md-4">
                <img :src="`/api/src/assets/images/ryan/${employee.img}`" class="" alt="" style="height:300px;">
        </div>
        <div class="col-md-6">
          <h4>Title</h4>
          <p @dblclick="edit" v-if="!editing">{{employee.title || 'No data'}}</p>
          <input type="text" name="" @keypress.enter="commitEdit"v-if="editing" v-model="employee.title">
          <h4>Branch</h4>
          <p @dblclick="edit" v-if="!editing">{{employee.branch || 'No data'}}</p>
          <input type="text" name="" @keypress.enter="commitEdit"v-if="editing" v-model="employee.branch">

          <h4>email</h4>
          <p @dblclick="edit" v-if="!editing">{{employee.email || 'No data'}}</p>
          <input type="text" name="" @keypress.enter="commitEdit"v-if="editing" v-model="employee.email">
          <h4>phone</h4>
          <p @dblclick="edit" v-if="!editing">{{employee.phone || 'No data'}}</p>
          <input type="text" name="" @keypress.enter="commitEdit"v-if="editing" v-model="employee.phone">
          <h4>About</h4>
          <p @dblclick="edit" v-if="!editing">{{employee.about || 'No data'}}</p>
          <textarea style="width:100%;"type="text" name="" @keypress.enter="commitEdit"v-if="editing" value="" v-model="employee.about"></textarea>
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
            },
            oldEmployee:{
            }
            editing: false,

        }
    },
    computed: {
        loggedIn() {
            return this.$store.getters.loggedIn;
        },
        fillColorEdit(){
          if(this.editing){
            return '#646464';
          }else{
            return '#C6C6C6';
          }
        },
        fillColorDelete(){
          return '#C6C6C6';
        }
    },
    methods: {
        edit() {
            this.editing = !this.editing;
        },
        commitEdit() {
            this.editing = !this.editing;
            this.editEmployee();
        },
        onDelete(employee) {
            let r = confirm('Are you sure you want to delete ' + employee.firstName + '\'s entry?');
            if (r) {
                let payload = {
                    employee
                };
                this.deleteEmployee(employee);
                eventBus.$emit('employeeDeleted', payload);
                this.$router.push({
                    path: '/'
                })
            }
        }
    },
    created() {
        let id = this.$route.params.id;
        this.getEmployee(id);
    },

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

.icon.edit {
    top: 10px;
    right: 65px;
}
.save{
  position:absolute;
  top:5px;
  right:110px;
}
.icon svg {
    height: 25px;
}
input{
  
}
</style>
