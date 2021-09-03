import { createStore } from 'vuex'

export default createStore({
  state: {
    spec: {}
  },
  mutations: {
    UPDATE_SPEC(state, payload) {
      state.spec = payload;
    }
  },
  actions: {
  },
  modules: {
  }
})
