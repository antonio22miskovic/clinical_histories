import axios from 'axios'
export default {

    state: {
        patient:{
            id:null,
            sex:'',
            first_name:'',
            last_name:'',
            phone:'',
            ci:'',
            civil_status:'',
            birthdate:'',
            weight:0
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
        pageUpdate:null
    },

    mutations: {

        ALL_P(state, payload){
            state.data = payload.data // la data a paginar
            // datos de la paginacion
            state.paginate.total = payload.paginate.total
            state.paginate.current_page = payload.paginate.current_page
            state.paginate.per_page = payload.paginate.per_page
            state.paginate.last_page = payload.paginate.last_page
            state.paginate.to = payload.paginate.to

        },

        SET_PATIENT(state, payload){

            state.patient.id = payload.id
            state.patient.sex = payload.sex
            state.patient.first_name = payload.first_name
            state.patient.last_name = payload.last_name
            state.patient.phone = payload.phone
            state.patient.ci = payload.ci
            state.patient.civil_status = payload.civil_status
            state.patient.birthdate = payload.birthdate
            state.patient.weight = payload.weight

        },

        SOTRE_P(state, {data}){

            state.patient.id = data.id
            state.patient.sex = data.sex
            state.patient.first_name = data.first_name
            state.patient.last_name = data.last_name
            state.patient.phone = data.phone
            state.patient.ci = data.ci
            state.patient.civil_status = data.civil_status
            state.patient.birthdate = data.birthdate
            state.patient.weight = data.weight
        },

        SHOW_P(state,data){

            state.patient.id = data.id
            state.patient.sex = data.sex
            state.patient.first_name = data.first_name
            state.patient.last_name = data.last_name
            state.patient.phone = data.phone
            state.patient.ci = data.ci
            state.patient.civil_status = data.civil_status
            state.patient.birthdate = data.birthdate
            state.patient.weight = data.weight

        },

        SHOW_P_Q(state,data){
        
            state.patient.id = data[0].id
            state.patient.sex = data[0].sex
            state.patient.first_name = data[0].first_name
            state.patient.last_name = data[0].last_name
            state.patient.phone = data[0].phone
            state.patient.ci = data[0].ci
            state.patient.civil_status = data[0].civil_status
            state.patient.birthdate = data[0].birthdate
            state.patient.weight = data[0].weight
            state.pageUpdate = data[1]

        },

        CLEAR_PATIENT(state){

            state.patient.id = null
            state.patient.sex = ''
            state.patient.first_name = ''
            state.patient.last_name = ''
            state.patient.phone = ''
            state.patient.ci = ''
            state.patient.civil_status = ''
            state.patient.birthdate = ''
            state.patient.weight = 0
            state.history = null
            state.consulta_medica = null

        },

        UPDATE_P(state,{data}){

            state.patient.id = data.id
            state.patient.sex = data.sex
            state.patient.first_name = data.first_name
            state.patient.last_name = data.last_name
            state.patient.phone = data.phone
            state.patient.ci = data.ci
            state.patient.civil_status = data.civil_status
            state.patient.birthdate = data.birthdate
            state.patient.weight = data.weight

        }

    },

    getters: {

        Getpatient: state => state.patient,
        newHistory: state => state.history,
        Getcomponet:state => state.componet,
        getDataPatients:state => state.data,
        getDataPaginate: state => state.paginate,
        total_p: state => state.paginate.total,
        pageUpdate_p: state => state.pageUpdate

    },

    actions: {

         async all_p({commit},page){ // data de la paginación
            try{
                const {data} = await axios.get(`/api/doctor/patient?page=${page.page}`)
                commit('ALL_P',data)
            }catch(err){
                return console.log(err)
            }
        },

        async store_p({commit},values){
            try{
                console.log(values)
                const {data} = await axios.post('/api/doctor/patient',values)
                if (data.validation !== undefined) {
                    return data
                }
                commit('SOTRE_P',data)
                return data
            }catch(err){

                console.log(err)

            }
        },

        async update_p({commit},values){
            try{
                const {data} = await axios.put(`/api/doctor/patient/${values[0]}`,values[1])
                if (data.validation !== undefined) {
                    return data
                }
                commit('UPDATE_P',data)
                return data
            }catch(err){
                console.log(err)
            }
        },

        async detectPatient({commit},ci){
            try{
                const {data} = await axios.get(`/api/doctor/waiting_list/detect/${ci}`)
                console.log('dentro de el detector del paciente:', data)
                commit('SET_PATIENT',data)
                return data
            }catch(err){
                console.log(err)
            }
        },
        async show_p({commit},id){
            try{
                const {data} = await axios.get(`/api/doctor/patient/${id}`)
                console.log('dentro del show',data)
                commit('SHOW_P',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async show_clinical_p({commit},id){
            try{// el id es el de la consulta
                const {data} = await axios.get(`/api/doctor/patient/consulta/clinical/${id}`)
                console.log('dentro del show',data)
                commit('SHOW_P',data)
                return data
            }catch(err){
                return console.log(err)
            }
        },

        async documentXml_p({commit},id){
            try{
                window.location = `${process.env.VUE_APP_BASE_URL}/document/cda/${id}`
                return true
            }catch(err){
                return console.log(err)
            }
        },
        async documentPdf_p({commit},id){
            try{
                window.location = `${process.env.VUE_APP_BASE_URL}/document/pdf/${id}`
                return true
            }catch(err){
                return console.log(err)
            }
        },

        async clearPatient({commit}){
            commit('CLEAR_PATIENT')
        },

        setDialog({commit},value){
            console.log(value)
            commit('SHOW_P_Q', value)
            return true
        }

    }
}