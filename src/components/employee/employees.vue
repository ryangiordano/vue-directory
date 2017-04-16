<template lang="html">
<div>  <div class="col-md-3">
  <div class="panel employee" @mouseenter="viewOptions=true" @click="toDetail" @mouseleave="viewOptions=false">
  <div class="panel-heading" style="height:40px" @click.stop>
        <transition @enter="fadeIn" @leave="fadeOut">  <span v-show="viewOptions"><span  @click="editEmployee(employee)" v-if="loggedIn" class="edit icon"><img src="/src/assets/images/edit.png" /></span>
        <span  @click="deleteEmployee(employee,index)" v-if="loggedIn" class="delete icon"><img src="/src/assets/images/x.png" /></span></span></transition>
    </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-xs-4">
        <img :src="`/api/src/assets/images/ryan/${employee.img}`" alt=""  class="img-responsive employee-image">
      </div>
      <div class="col-xs-8">
           <h5>{{employee.firstName}} {{employee.lastName}}</h5>
           <p>{{employee.title}}</p>
           <p>{{employee.phone}}</p>
           <p>{{employee.email}}</p>
      </div>
    </div>
  </div>
  </div>

</div></div>
</template>

<script>
import {
    eventBus
} from '../../main.js';
export default {
    props: ['employee', 'index'],
    computed: {
        loggedIn() {
            return this.$store.getters.loggedIn;
        }
    },
    data: function() {
        return {
          viewOptions:false,
        }
    },
    methods: {
        fadeInUp(el, done) {
            let tl = new TimelineMax;
            tl.from(el, .2, {
                y: 20,
                opacity: 0,
                delay: .3,
                onComplete: done
            })
        },
        fadeIn(el, done) {
            let tl = new TimelineMax;
            tl.to(el, .3, {
                opacity: 1,
                delay: 0,
                onComplete: done
            })
        },
        fadeOut(el, done) {
            let tl = new TimelineMax;
            tl.to(el, .5, {
                opacity: 0,
                onComplete: done
            })
        },
        toDetail(){
            this.$router.push(`/detail/${this.employee.id}`)
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
}
</script>

<style scoped>
h5{
  margin-top:0;
}
.icons {}

.icon {
    cursor: pointer;
    position: absolute;
}
.panel-body{
  padding:5px;
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

.employee {
    min-height: 200px;
    cursor:pointer;
}
.employee-image{
  margin-left:10px;
  -webkit-box-shadow: 0 3px 4px rgba(0, 0, 0, 0.5);
  box-shadow: 0 3px 4px rgba(0, 0, 0, 0.5);
}
</style>
