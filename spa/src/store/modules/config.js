export default {

    state: {
        overlay: false,
        drawer:true
    },

    mutations: {
        SET_OVERLAY (state, payload) {
            state.overlay = payload
    },

        DRAWER (state, payload) {
            state.drawer = payload
        }
    },

    getters: {
        overlay: state => state.overlay,
        drawer:  state => state.drawer
    },

    actions: {

        setOverlay({ commit },state){
            commit('SET_OVERLAY', state)
        },

        setDrawer({ commit }, state) {
            commit('DRAWER', state)
        }

    }
}