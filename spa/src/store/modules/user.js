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
        },
        userSpecialist:{
            name:'',
            email:'',
            specialist_id:null
        },
        data:[],
        paginate: {
            total: 0,
            current_page: 0,
            per_page: 0,
            last_page: 0,
            from: 0,
            to: 0
        },
    },

    mutations: {

        ALL_U(state, payload){
            state.data = payload.data // la data a paginar
            // datos de la paginacion
            state.paginate.total = payload.paginate.total
            state.paginate.current_page = payload.paginate.current_page
            state.paginate.per_page = payload.paginate.per_page
            state.paginate.last_page = payload.paginate.last_page
            state.paginate.to = payload.paginate.to
        },

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
        getquotas:      state => state.quota,
        getDataUser: state => state.data,
        total_u: state => state.paginate.total,
        getUser: state => state.userSpecialist
    },

    actions: {

        async all_u({commit},page){ // data de la paginación
            try{
                const {data} = await axios.get(`/api/doctor/user?page=${page.page}`)
                commit('ALL_U',data)
            }catch(err){
                return console.log(err)
            }
        },

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

        async store_u({commit},value){
            try{
                console.log('el value',value)
                const {data} = await axios.post(`/api/doctor/user`,value)
                commit('STORE_U',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async update_u({commit},value){
            try{
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
        async update_u_specialist({commit},value){
            try{
                const {data} = await axios.post(`/api/doctor/user/specialist/${value[0]}`,value[1])
                return data
            }catch(err){
                return console.log(err)
            }
        },

        // async setDialogUser ({commit}, value){
        //     console.log('el value',value)
        //     commit('SetUser',value)
        // }

        async destroy_u({commit},id){
            try{
                const data = await axios.delete(`/api/doctor/user/${id}`)
                commit('DESTROY_U')
                return data
            }catch(err){
                return console.log(err)
            }
        },
   }
}