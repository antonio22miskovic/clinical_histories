import axios from 'axios'
export default {

    state: {
        medical_record:{
            id:null,
            patient:null,
        }
    },

    mutations: {
        ALL_MR(state, payload){

        },

        SET_OPTIONS_MR(state, payload){


        },

        LOADING_MR(state, payload){

        },

        SHOW_MR(state,paylaod){

            state.medical_record.id = payload.id,
            state.medical_record.patient = payload.patient
        },

        STORE_MR(state,paylaod){

            state.medical_record.id = payload.id,
            state.medical_record.patient = payload.patient

        },

        UPDATE_MR(state,paylaod){

        },

        DESTROY_MR(state){

        },

    },
    getters: {

    },

    actions: {

        async all_mr({commit},page){ // data de la paginación
            try{
                const {data} = await axios.get(`/api/doctor/medical/record?page=${page.page}`)
                commit('ALL_MR',data)
            }catch(err){
                return console.log(err)
            }
        },

        async loading_mr({commit},value){
            commit('LOADING_MR',value)
        },

        async show_mr({commit},value){
            try{
                const {data} = await axios.get(`/api/doctor/medical/record/${value}`)
                commit('SHOW_MR',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async store_mr({commit},value){
            try{
                const data = await axios.put(`/api/doctor/medical/record`,value)
                commit('STORE_MR',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async update_mr({commit},value,id){
            try{
                const data = await axios.put(`/api/doctor/medical/record/${id}`,value)
                commit('UPDATE_MR',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async destroy_mr({commit},id){
            try{
                const data = await axios.put(`/api/doctor/medical/record/${id}`)
                commit('DESTROY_MR')
                return data
            }catch(err){
                return console.log(err)
            }
        },

    }
}