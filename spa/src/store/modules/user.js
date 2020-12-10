import axios from 'axios'
export default {
    state: {
        specialist:{
            id:null,
            name: null,
            description:null
        }
    },

    mutations: {
        SET_SPECIALIST(state, payload){
           state.specialist.id = payload.id
           state.specialist.name = payload.name
           state.specialist.description = payload.description
        }
    },
    getters: {
        specialistAuth: (state) => state.specialist
    },

    actions: {
       async specialistSet({commit}){
            try {
                const res = await axios.get('api/doctor/specialist/auth/user')
                commit('SET_SPECIALIST',res.data)
                return res.data
            }catch(err){
                return err
            }
       }
   }
}