import axios from 'axios'
export default {

    state: {
        medical_consultation:{
            id:null,
            medical_record:null
        },
        data:[],
        diseases:[],
        medical_treatment:[],
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
        ALL_MC(state, payload){
            state.data = payload.data
            state.paginate.total = payload.paginate.total
            state.paginate.current_page = payload.paginate.current_page
            state.paginate.per_page = payload.paginate.per_page
            state.paginate.last_page = payload.paginate.last_page
            state.paginate.to = payload.paginate.to
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

        SHOW_CLINICAL_MC(state,{consulta,diseases,medicamentos}){
           state.medical_consultation.id = consulta.id
           state.medical_consultation.medical_record = consulta.medical_record
           state.diseases = diseases
           state.medical_treatment = medicamentos
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

        getMedical_consultation : state => state.medical_consultation,
        getDataConsulta : state => state.data,
        total_mc: state => state.paginate.total,
        getmedicamentos: state => state.medical_treatment,
        getdiseases: state => state.diseases,

    },

    actions: {

        async all_mc({commit},{page,id}){ // data de la paginación
            try{
                const {data} = await axios.get(`/api/doctor/medical/consultation/clinical/${id}?page=${page.page}`)
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

        async show_clinical_mc({commit},value){
            try{
                const {data} = await axios.get(`/api/doctor/medical/consultation/clinical/consulta/${value}`)
                commit('SHOW_CLINICAL_MC',data)
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