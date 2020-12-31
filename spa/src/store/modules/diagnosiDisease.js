import axios from 'axios'
export default {

    state: {
        diagnosi:{
            id:null,
        },
        disease:[]
    },

    mutations: {
        ALL_DD(state, payload){

        },

        SET_OPTIONS_DD(state, payload){


        },

        LOADING_DD(state, payload){

        },

        SHOW_DD(state,payload){

            state.medical_consultation.id = payload.id
            state.medical_consultation.medical_record = payload.medical_record
            console.log('data de la consulta medica:',state.medical_consultation)
        },

        STORE_DD(state,payload){

            state.medical_consultation.id = payload.id
            state.medical_consultation.medical_record = payload.medical_record

        },

        UPDATE_DD(state,payload){

        },

        DESTROY_DD(state){

        },

    },
    getters: {

        getdiagnosi : state  => state.diagnosi.id,
        getdisease  : state  => state.disease

    },

    actions: {

        async all_dd({commit},page){ // data de la paginación
            try{
                const {data} = await axios.get(`/api/doctor/disease?page=${page.page}`)
                commit('ALL_DD',data)
            }catch(err){
                return console.log(err)
            }
        },

        async loading_dd({commit},value){
            commit('LOADING_DD',value)
        },

        async show_dd({commit},value){
            try{
                const {data} = await axios.get(`/api/doctor/disease/${value}`)
                commit('SHOW_DD',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async store_dd({commit},value){
            try{
                const {data} = await axios.post(`/api/doctor/disease`,value)
                console.log('la respuesta de la data',data)
                // commit('STORE_DD',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async update_dd({commit},value,id){
            try{
                const data = await axios.put(`/api/doctor/disease/${id}`,value)
                commit('UPDATE_DD',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async destroy_dd({commit},id){
            try{
                const data = await axios.put(`/api/doctor/disease/${id}`)
                commit('DESTROY_DD')
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async setvalue_dd({commit},value){
            commit('SHOW_DD',value)
        }

    }
}