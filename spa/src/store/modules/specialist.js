import axios from 'axios'
export default {

    state: {
        specialists:[],
        specialistsCreate:[]
    },

    mutations: {

        SET_SPECIALISTS(state, payload){
            state.specialists = payload
        },

        SET_SPECIALISTS_CREATE(state, payload){
            state.specialistsCreate = payload
        },

        SHOW_SP(state, payload){

        }

    },

    getters: {
        listSpecialists: (state) => state.specialists,
        listSpecialistsCreate: (state) => state.specialists,
    },

    actions: {
        async getSpecialist({commit}){
            try{
                console.log('cargando la especialidad')
                const resp = await axios.get('/api/doctor/specialist/')
                commit('SET_SPECIALISTS',resp.data)
                return res
            }catch(err){
                return err
            }
        },

        async getSpecialistByCreate({commit}){
            try{
                const {data} = await axios.get('/api/doctor/specialist/by/create')
                commit('SET_SPECIALISTS_CREATE',data)
                return res
            }catch(err){
                return err
            }
        }
    }
}