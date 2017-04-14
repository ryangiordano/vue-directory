<template lang="html">
  <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" @click="closeAlert">&times;</button>
    <p>{{message}}</p>
  </div>
</template>

<script>
import {eventBus} from '../../main';
export default {
  props:['message','showAlert'],
  methods:{
    closeAlert(){
      eventBus.$emit('alertClosed',false);
      clearTimeout(this.timeout);
    }
  },
  created(){
    this.timeout =  setTimeout(()=>{
      eventBus.$emit('alertClosed',false);
    },5000)
  }

}
</script>

<style scoped>
.alert{
  position:absolute;
  top:100px;
  right:100px;
  width:20%;
}
.alert p{
  font-size:20px;
}
.alert-success{
  background-color:#82d25d;
}
</style>
