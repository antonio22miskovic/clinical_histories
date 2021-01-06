export default {

    state: {
        overlay: false,
        drawer:true,
        dialog:false,
    },

    mutations: {
        SET_OVERLAY (state, payload) {
            state.overlay = payload
        },
        DRAWER (state, payload) {
            state.drawer = payload
        },
        DIALOG(state, payload){
            state.dialog = payload
        }
    },

    getters: {
        overlay: state => state.overlay,
        drawer : state => state.drawer,
        getdialog: state => state.dialog,
    },

    actions: {

        setOverlay({ commit },state){
            commit('SET_OVERLAY', state)
        },

        setDrawer({ commit }, state) {
            commit('DRAWER', state)
        },

        Ondialog({ commit }, value){
            commit('DIALOG', value)
        }
    }
}