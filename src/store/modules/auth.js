const state = {
    user: {},
    loggedIn: false,
}
const getters = {
    loggedIn: state => {
        return state.loggedIn
    }
}
const mutations = {
    login: (state, payload) => {
        state.loggedIn = payload;
    }
}
const actions = {
    login: ({
        commit
    }, payload) => {
        commit('login', payload);
    }
}

export default {
    state,
    mutations,
    actions,
    getters
}
