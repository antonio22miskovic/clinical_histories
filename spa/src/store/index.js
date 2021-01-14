import Vue from 'vue'
import Vuex from 'vuex'
import config from './modules/config'
import auth from './modules/auth'
import user from './modules/user'
import specialist from './modules/specialist'
import waiting_list from './modules/waiting_list'
import Patient from './modules/Patient'
import medical_consultation from './modules/medical_consultation'
import medical_record from './modules/medical_record'
import diagnosiDisease from './modules/diagnosiDisease'
import quota from './modules/quota'

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
    Patient,
    medical_consultation,
    medical_record,
    diagnosiDisease,
    quota
  }
})