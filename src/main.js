import Vue from 'vue'
import VueResource from 'vue-resource';
import VueRouter from 'vue-router';
import App from './App.vue';
import {routes} from './routes';
import {store} from './store/store.js';


export const eventBus = new Vue({
  data:function(){
    return{
    }
  },
  methods:{

  }
});



const router = new VueRouter({
  routes,
  mode:'history'
})

Vue.use(VueResource);
Vue.use(VueRouter);

new Vue({
  el: '#app',
  router,
  store:store,
  render: h => h(App)
})
