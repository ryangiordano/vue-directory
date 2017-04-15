const state = {
    user: {},
    loggedIn: false,
}
const getters = {
    loggedIn: state => {
        return state.loggedIn
    },
    user:state=>{
      return state.user
    }
}
const mutations = {
    login: (state, payload) => {
        state.loggedIn = payload;
    },
    user:(state,payload)=>{
      state.user = payload;
    }
}
const actions = {
    login: ({
        commit
    }, payload) => {
        commit('login', payload);
    },
    setUser: ({
        commit
    }, payload) => {
        commit('user', payload);
    }
}

export default {
    state,
    mutations,
    actions,
    getters
}
