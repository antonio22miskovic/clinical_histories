import axios from 'axios'
export default {
    state: {
        specialist:null,
    },

    mutations: {
        SET_SPECIALIST(state, payload){
           state.specialist = payload 
        }
    },
    getters: {
        specialistAuth: (state) => state.specialist
    },

    actions: {
       async specialistSet({commit}){
        console.log('estoy dentro')
            try {
                const res = await axios.get('api/doctor/specialist/auth/user')
                commit('SET_SPECIALIST',res.data.name)
                return res.data
            }catch(err){
                return err
            }
       }
   }
}