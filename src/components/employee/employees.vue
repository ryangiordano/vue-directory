<template lang="html">
<div>  <div class="col-md-3">
  <div class="panel employee" @mouseenter="viewOptions=true" @mouseleave="viewOptions=false">
  <div class="panel-heading" style="height:40px" >
        <transition @enter="fadeIn" @leave="fadeOut">  <span v-show="viewOptions"><span  @click="deleteEmployee(employee,index)" v-if="loggedIn" class="edit icon"><img src="/src/assets/images/edit.png" /></span>
        <span  @click="deleteEmployee(employee,index)" v-if="loggedIn" class="delete icon"><img src="/src/assets/images/x.png" /></span></span></transition>
    </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-xs-4">
        <img :src="`/api/src/assets/images/ryan/${employee.img}`" alt=""  class="img-responsive employee-image">
      </div>
      <div class="col-xs-8">
           <h5>{{employee.firstName}} {{employee.lastName}}</h5>
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
        create() {
            console.log(employee);
        },
        deleteEmployee(entry, index) {
            let payload = {
                entry,
                index
            };
            eventBus.$emit('employeeDeleted', payload)
        }
    }
}
</script>

<style scoped>
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
}
.employee-image{
  margin-left:10px;
  -webkit-box-shadow: 0 3px 4px rgba(0, 0, 0, 0.5);
  box-shadow: 0 3px 4px rgba(0, 0, 0, 0.5);
}
</style>
