import axios from 'axios'
export default {

    state: {
        patient:{
            id: 0,
            sex:'',
            first_name:'',
            last_name:'',
            phone:'',
            ci:'',
            civil_status:'',
            birthdate:'',
            weight:0
        }
    },

    mutations: {

        SET_NEW_PATIENT(state, payload){

            state.patient.id = payload.id
            state.patient.sex = payload.sex
            state.patient.first_name = payload.first_name
            state.patient.last_name = payload.last_name
            state.patient.phone = payload.phone
            state.patient.ci = payload.ci
            state.patient.civil_status = payload.civil_status
            state.patient.birthdate = payload.birthdate
            state.patient.weight = payload.weight

        }

    },

    getters: {

        newPatient: state => state.patient
       
    },

    actions: {

        async newPatient({commit},values){
            try{

              const {data} = await axios.post('/api/doctor/patient',values)
                console.log(data)
                commit('SET_NEW_PATIENT',data)

            }catch(err){

                console.log(err)

            }   
        },

      
    }
}