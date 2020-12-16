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
        loading:false
    },

    mutations: {
        SET_DATA(state, payload){
            state.data = payload.data // la data a paginar
            // datos de la paginacion
            state.paginate.total = payload.paginate.total
            state.paginate.current_page = payload.paginate.current_page
            state.paginate.per_page = payload.paginate.per_page
            state.paginate.last_page = payload.paginate.last_page
            state.paginate.to = payload.paginate.to
        },

        SET_OPTIONS(state, payload){
            // datos de la paginacion
            state.paginate.total = payload.total
            state.paginate.current_page = payload.current_page
            state.paginate.per_page = payload.per_page
            state.paginate.last_page = payload.last_page
            state.paginate.to = payload.to
         
        },

        LOADING(state, payload){
            state.payload
        }
    },
    getters: {
        isloading:     (state) => state.loading,
        total:         (state) => state.paginate.total,
        getDateItems : (state) => state.data,
        options:       (state) => state.paginate,
    },

    actions: {
        async GetData({commit},page){
            try{
                const {data} = await axios.get(`/api/doctor/waiting_list?page=${page.page}`)
                commit('SET_DATA',data)
            }catch(err){
                return console.log(err)
            }
        },
        async Setloading({commit},value){
            commit('LOADING',value)
        }
    }
}