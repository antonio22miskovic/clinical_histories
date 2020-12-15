import axios from 'axios'
export default {
    state: {
        specialist:{
            id:null,
            name: null,
            description:null,
        },
        quota:{
            quota:null,
            date: null,
        }
    },

    mutations: {
        SET_SPECIALIST(state, payload){
           state.specialist.id = payload.specialist.id
           state.specialist.name = payload.specialist.name
           state.specialist.description = payload.specialist.description
           state.quota.quota = payload.quota.quota
           state.quota.date = payload.quota.date
        }
    },
    getters: {
        specialistAuth: state => state.specialist,
        getquotas:      state => state.quota
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