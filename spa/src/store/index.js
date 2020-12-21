import Vue from 'vue'
import Vuex from 'vuex'
import config from './modules/config'
import auth from './modules/auth'
import user from './modules/user'
import specialist from './modules/specialist'
import waiting_list from './modules/waiting_list'
import Patient from './modules/Patient'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  getters: {},
  modules: {
  	config,
  	auth,
    user,
    specialist,
    waiting_list,
    Patient
  }
})