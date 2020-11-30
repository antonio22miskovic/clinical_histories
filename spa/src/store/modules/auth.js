import axios from 'axios'
import {getlocaluser, getToken} from '@/conf/getUser'
const user  = getlocaluser()
const token = getToken()

export default {

    state: {
        access_token: token,
        user: user
    },
    mutations: {

        SET_USER(state, payload) {
            state.user = payload.user
        },

        LOGIN(state, payload){
            state.access_token = payload.access_token
            localStorage.setItem('key',JSON.stringify(state.access_token))
            localStorage.setItem('user',JSON.stringify(payload.user))
        },

        LOGOUT(state){
            localStorage.removeItem('user')
            localStorage.removeItem('key')
            state.user = null
            state.access_token = null
        }

    },
    getters: {
        userAuth: (state) => state.user,
        isAdmin:  (state) => state.user.rol === 1
    },
    actions: {

        async login({ commit }, { email, password }) {
            const resp = await axios.post('/api/auth/login', { email, password })
            commit('SET_USER', resp.data)
            commit('LOGIN',resp.data)
            return resp.data
        },

        async logout({ commit }) {
            try {
                commit('LOGOUT')
                return true
            } catch(e) {
               return false
            }


        },

        async getUserAuth({ commit }) {
            try {
                const resp = await axios.get('/api/user')
                commit('SET_USER', resp.data)
            } catch (error) {
                commit('SET_USER', null)
            }
        }
    }
}
