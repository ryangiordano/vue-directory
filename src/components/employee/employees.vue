<template lang="html">
<div>  <div class="col-md-3">
  <div class="panel">
  <div class="panel-body">
    <button type="button" name="button" class="btn btn-default" @click="deleteEmployee(employee,index)" v-if="loggedIn">Delete</button> {{employee.firstName}} {{employee.lastName}}
    <br /><img :src="`/api/src/assets/images/ryan/${employee.img}`" alt="" style="height:150px;">
  </div>
  </div>

</div></div>
</template>

<script>
import {
    eventBus
} from '../../main.js';
export default {
    props: ['employee','index'],
    computed:{
      loggedIn(){
        return this.$store.getters.loggedIn;
      }
    },
    data:function(){
      return{

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
        fadeOut(el, done) {
            let tl = new TimelineMax;
            tl.to(el, .2, {
                opacity: 0,
                delay: .3,
                onComplete: done
            })
        },
        create(){
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

</style>
