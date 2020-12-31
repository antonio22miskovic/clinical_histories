import axios from 'axios'
export default {

    state: {
        medical_consultation:{
            id:null,
            medical_record:null
        }
    },

    mutations: {
        ALL_MC(state, payload){

        },

        SET_OPTIONS_MC(state, payload){


        },

        LOADING_MC(state, payload){

        },

        SHOW_MC(state,payload){

            state.medical_consultation.id = payload.id
            state.medical_consultation.medical_record = payload.medical_record
            console.log('data de la consulta medica:',state.medical_consultation)
        },

        STORE_MC(state,payload){

            state.medical_consultation.id = payload.id
            state.medical_consultation.medical_record = payload.medical_record

        },

        UPDATE_MC(state,payload){

        },

        DESTROY_MC(state){

        },

    },
    getters: {

        getMedical_consultation : state => state.medical_consultation

    },

    actions: {

        async all_mc({commit},page){ // data de la paginación
            try{
                const {data} = await axios.get(`/api/doctor/medical/consultation?page=${page.page}`)
                commit('ALL_MC',data)
            }catch(err){
                return console.log(err)
            }
        },

        async loading_mc({commit},value){
            commit('LOADING_MC',value)
        },

        async show_mc({commit},value){
            try{
                const {data} = await axios.get(`/api/doctor/medical/consultation/${value}`)
                commit('SHOW_MC',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async store_mc({commit},value){
            try{
                const {data} = await axios.post(`/api/doctor/medical/consultation`,{medical_record_id:value})
                commit('STORE_MC',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async update_mc({commit},value,id){
            try{
                const data = await axios.put(`/api/doctor/medical/consultation/${id}`,value)
                commit('UPDATE_MC',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async destroy_mc({commit},id){
            try{
                const data = await axios.put(`/api/doctor/medical/consultation/${id}`)
                commit('DESTROY_MC')
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async setvalue_mc({commit},value){
            commit('SHOW_MC',value)
        }

    }
}