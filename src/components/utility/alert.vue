<template lang="html">
  <div class="alert alert-dismissible alert-success" :style="{backgroundColor:color}">
    <button type="button" class="close" @click="closeAlert">&times;</button>
    <p>{{message}}</p>
  </div>
</template>

<script>
import {eventBus} from '../../main';
export default {
  props:['message','showAlert','color','id'],
  methods:{
    closeAlert(){
      eventBus.$emit('removeAlert',this.id);
      clearTimeout(this.timeout);
    }
  },
  created(){
    this.timeout =  setTimeout(()=>{
      eventBus.$emit('removeAlert',this.id);
    },3000)
  }

}
</script>

<style scoped>
.alert{

}
.alert p{
  font-size:20px;
}
.alert-success{
  background-color:#82d25d;
}
</style>
