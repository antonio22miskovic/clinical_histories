import axios from 'axios'
export default {

    state: {

    },

    mutations: {
        ALL_MC(state, payload){

        },

        SET_OPTIONS_MC(state, payload){


        },

        LOADING_MC(state, payload){

        },

        SHOW_MC(state,paylaod){

        },

        STORE_MC(state,paylaod){

        },

        UPDATE_MC(state,paylaod){

        },

        DESTROY_MC(state){

        },

    },
    getters: {

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
                const data = await axios.put(`/api/doctor/medical/consultation`,value)
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

    }
}