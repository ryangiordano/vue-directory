import Vue from 'vue';
import Vuex from 'vuex';
import Auth from './modules/auth';

Vue.use(Vuex);

export const store = new Vuex.Store({
  state:{
    value:'f'
  },
  getters:{
    value:state=>{
      return state.value
    }
  },
  mutations:{
    updateValue:(state,payload)=>{
      state.value = payload
    }
  },
  actions:{
    updateValue:({commit},payload)=>{
      commit('updateValue',payload);
    }
  },
  modules:{
    Auth
  }
})
