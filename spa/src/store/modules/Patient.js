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
    },

    mutations: {

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

    },

    getters: {

        Getpatient: state => state.patient,
        newHistory: state => state.history,
        Getcomponet:state => state.componet,

    },

    actions: {

        async store_p({commit},values){
            try{
                console.log(values)
                const {data} = await axios.post('/api/doctor/patient',values)
                commit('SOTRE_P',data)
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

        async clearPatient({commit}){
            commit('CLEAR_PATIENT')
        }

    }
}