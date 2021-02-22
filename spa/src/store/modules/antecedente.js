import axios from 'axios'
export default {

    state: {
        antecendente:{
            name:'',
            description:'',
            patient:null
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

        ALL_ANT(state, payload){
            state.data = payload.data // la data a paginar
            // datos de la paginacion
            state.paginate.total = payload.paginate.total
            state.paginate.current_page = payload.paginate.current_page
            state.paginate.per_page = payload.paginate.per_page
            state.paginate.last_page = payload.paginate.last_page
            state.paginate.to = payload.paginate.to
            console.log('data:',state.data)
            console.log('paginate:',state.paginate)
        },

        SOTRE_ANT(state, {data}){


        },

        SHOW_P(state,data){



        },

    },

    getters: {

        GetAntecedente : state => state.antecendente,
        getDataAntecedentes : state => state.data,
        getDataPaginateAntecedente : state => state.paginate,
        total_ant : state => state.paginate.total,

    },

    actions: {

         async all_ant({commit},{ id , page }){ // data de la paginación
            console.log('patiente:',id)
            try{
                const {data} = await axios.get(`/api/doctor/antecedente/list/${id}?page=${page.page}`)
                commit('ALL_ANT',data)
            }catch(err){
                return console.log(err)
            }
        },

        async store_ant({commit},values){
            try{
                console.log(values)
                const {data} = await axios.post('/api/doctor/antecedente',values)
                if (data.validation !== undefined) {
                    return data
                }
                commit('SOTRE_ANT',data)
                return data
            }catch(err){

                console.log(err)

            }
        },

        async update_ant({commit},values){
            try{
                const {data} = await axios.put(`/api/doctor/antecedente/${values.id}`,{ name:values.name,
                                                                                        description:values.description})
                if (data.validation !== undefined) {
                    return data
                }
                commit('UPDATE_ANT',data)
                return data
            }catch(err){
                console.log(err)
            }
        },

        async show_ant({commit},id){
            try{
                const {data} = await axios.get(`/api/doctor/antecedente/${id}`)
                commit('SHOW_ANT',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async destroy_ant({commit},id){
            console.log('el id',id)
            try{
                const {data} = await axios.delete(`/api/doctor/antecedente/${id}`)
                console.log('la data:',data)
                commit('SHOW_ANT',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

    }
}