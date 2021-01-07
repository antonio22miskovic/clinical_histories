import axios from 'axios'
export default {

    state: {
        specialists:[]
    },

    mutations: {

        SET_SPECIALISTS(state, payload){
            state.specialists = payload
        },

        SHOW_SP(state, payload){

        }

    },

    getters: {
        listSpecialists: (state) => state.specialists
    },

    actions: {
        async getSpecialist({commit}){
            try{
                const resp = await axios.get('/api/doctor/specialist/')
                commit('SET_SPECIALISTS',resp.data)
                return res
            }catch(err){
                return err
            }
        }
    }
}