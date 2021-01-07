import axios from 'axios'
export default {

    state: {
        data:[],
        paginate: {
            total: 0,
            current_page: 0,
            per_page: 0,
            last_page: 0,
            from: 0,
            to: 0
        },
        componet:true,
        loading:false,
        alert:false
    },

    mutations: {
        ALL_WL(state, payload){
            state.data = payload.data // la data a paginar
            // datos de la paginacion
            state.paginate.total = payload.paginate.total
            state.paginate.current_page = payload.paginate.current_page
            state.paginate.per_page = payload.paginate.per_page
            state.paginate.last_page = payload.paginate.last_page
            state.paginate.to = payload.paginate.to
            state.alert = false
        },

        SET_OPTIONS_WL(state, payload){
            // datos de la paginacion
            state.paginate.total = payload.total
            state.paginate.current_page = payload.current_page
            state.paginate.per_page = payload.per_page
            state.paginate.last_page = payload.last_page
            state.paginate.to = payload.to
            state.alert = false

        },

        LOADING_WL(state, payload){
            state.payload
        },

        SHOW_WL(state,paylaod){

        },

        STORE_WL(state,paylaod){

        },

        UPDATE_WL(state,paylaod){

        },

        DESTROY_WL(state){

        },

        ALERT_NULL(state,payload){
            state.alert = payload
        }

    },
    getters: {
        isloading:     (state) => state.loading,
        total:         (state) => state.paginate.total,
        getDateItems : (state) => state.data,
        options:       (state) => state.paginate,
        alert:         (state) => state.alert,
    },

    actions: {

        async all_wl({commit},page){ // data de la paginación
            try{
                const {data} = await axios.get(`/api/doctor/waiting_list?page=${page.page}`)
               if (data === '') {
                  return  commit('ALERT_NULL',true)
               }
                commit('ALL_WL',data)
            }catch(err){
                return console.log(err)
            }
        },

        async loading_wl({commit},value){
            commit('LOADING_WL',value)
        },

        async show_wl({commit},value){
            try{
                const {data} = await axios.get(`/api/doctor/waiting_list/${value}`)
                commit('SHOW_WL',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async store_wl({commit},value){
            try{
                const data = await axios.put(`/api/doctor/waiting_list`,value)
                commit('STORE_WL',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async update_wl({commit},value,id){
            try{
                const data = await axios.put(`/api/doctor/waiting_list/${id}`,value)
                commit('UPDATE_WL',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async destroy_wl({commit},ci){
            try{
                const data = await axios.delete(`/api/doctor/waiting_list/${ci}`)
                commit('DESTROY_WL')
                return data
            }catch(err){
                return console.log(err)
            }
        },

    }
}