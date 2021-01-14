import axios from 'axios'
export default {

    state: {
        data:[],
        quota:{
            id:null,
            quota:null,
            specialist:null,
            date:null
        },
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
        ALL_Q (state, payload) {
            
            state.data = payload.data // la data a paginar
            // datos de la paginacion
            state.paginate.total = payload.paginate.total
            state.paginate.current_page = payload.paginate.current_page
            state.paginate.per_page = payload.paginate.per_page
            state.paginate.last_page = payload.paginate.last_page
            state.paginate.to = payload.paginate.to

        },

        UPDATE_Q (state, payload) {
          
        },

        SHOW_Q(state, payload){
            state.quota = paylaod.quota
            state.specialist = payload.specialist
        },

        STORE_Q(state, payload){
         
        }

    },

    getters: {

        getDataQuotas:       state => state.data,
        getDataPaginateQuota: state => state.paginate,
        total_q:  state => state.paginate.total,
        Getquota: state => state.quota,

    },

    actions: {

       async all_q({commit},page){ // data de la paginación
            try{
                const {data} = await axios.get(`/api/doctor/quota?page=${page.page}`)
                commit('ALL_Q',data)
            }catch(err){
                return console.log(err)
            }
        },

        async show_q({commit},id){
            try{
                const {data} = await axios.get(`/api/doctor/quota/${id}`)
                commit('SHOW_Q',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async store_q({commit},values){
            try{
                const {data} = await axios.post('/api/doctor/quota',values)
                if (data.validation !== undefined) {
                    return data
                }
                commit('SOTRE_P',data)
                return data
            }catch(err){

                console.log(err)

            }
        },

        async update_q({commit},values){
            try{
                const {data} = await axios.put(`/api/doctor/quota/${values[0]}`,{quota:values[1]})
                if (data.validation !== undefined) {
                    return data
                }
                return data
            }catch(err){
                console.log(err)
            }
        },

        async setData_q({commit}){
            try{  
                commit('SHOW_Q',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },
       
    }
}