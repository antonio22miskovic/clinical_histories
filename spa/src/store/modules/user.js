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
        },

        SET_SHOW_U(state,paylaod){

        },

        STORE_U(state,paylaod){

        },

        UPDATE_U(state,paylaod){

        },

        DESTROY_U(state){

        },

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
       },

        // async show({commit},value){
        //     try{
        //         const data = await axios.get(`/api/doctor/user/${value}`)
        //         commit('SHOW_U',data)
        //         return data
        //     }catch(err){
        //         return console.log(err)
        //     }
        // },

        // async store({commit},value){
        //     try{
        //         const data = await axios.post(`/api/doctor/user`,value)
        //         commit('STORE_U',data)
        //         return data
        //     }catch(err){
        //         return console.log(err)
        //     }
        // },

        async update_u({commit},value){
            try{
                console.log(value)
                const {data} = await axios.put(`/api/doctor/user/${value[0]}`,value[1])
                if (data.validation !== undefined) {
                    return data
                }
                commit('UPDATE_U',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        // async destroy({commit},id){
        //     try{
        //         const data = await axios.delete(`/api/doctor/user/${id}`)
        //         commit('DESTROY_U')
        //         return data
        //     }catch(err){
        //         return console.log(err)
        //     }
        // },
   }
}