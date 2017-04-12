import Vue from 'vue'
import VueResource from 'vue-resource';
import App from './App.vue';

export const eventBus = new Vue({
  data:function(){
    return{

    }
  },
  methods:{

  }
})

Vue.use(VueResource);


new Vue({
  el: '#app',
  render: h => h(App)
})
