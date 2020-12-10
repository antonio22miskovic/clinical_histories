import Vue from 'vue'
import Vuex from 'vuex'
import config from './modules/config'
import auth from './modules/auth'
import user from './modules/user'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  getters: {},
  modules: {
  	config,
  	auth,
    user
  }
})