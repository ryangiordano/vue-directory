import Vue from 'vue';
import Vuex from 'vuex';


Vue.use(Vuex);

export const store = new Vuex.store({
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
      console.log(payload);
      commit('updateValue',payload);
    }
  },
  modules:{
    
  }
})
