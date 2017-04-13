<template lang="html">
<transition @enter="fadeInUp" @leave="fadeOut" appear><div>  <div class="col-md-3" v-for="(entry,index) in employees">
  <div class="panel">
  <div class="panel-body">
    <button type="button" name="button" class="btn btn-default" @click="deleteEmployee(entry,index)">Delete</button> {{entry.firstName}} {{entry.lastName}}
    <br /><img :src="`/api/src/assets/images/ryan/${entry.img}`" alt="" style="height:150px;">
  </div>
  </div>

</div></div></transition>
</template>

<script>
import {eventBus} from '../../main.js';
export default {
  props:['employees'],
  methods:{
    fadeInUp(el,done){
      let tl = new TimelineMax;
      tl.from(el,.2,{
        y:20,
        opacity:0,
        delay:.3,
        onComplete:done
      })
    },
    fadeOut(el,done){
      let tl = new TimelineMax;
      tl.to(el,.2,{
        opacity:0,
        delay:.3,
        onComplete:done
      })
    },
    deleteEmployee(entry,index){
      let payload = {entry,index};
      console.log(payload);
      eventBus.$emit('employeeDeleted', payload)
    }
  }
}
</script>

<style scoped>

</style>
