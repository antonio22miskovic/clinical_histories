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
        componet:true,
        loading:false,
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
        },
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
        },

        SET_PATIENT(state, payload){
            if (Object.keys(payload).length === 0) {

                    state.componet = false // montamos el componente de nuevo paciente
            }else{

                state.patient.id = payload.id
                state.patient.sex = payload.sex
                state.patient.first_name = payload.first_name
                state.patient.last_name = payload.last_name
                state.patient.phone = payload.phone
                state.patient.ci = payload.ci
                state.patient.civil_status = payload.civil_status
                state.patient.birthdate = payload.birthdate
                state.patient.weight = payload.weight

                state.componet = true
            }
        }

    },
    getters: {
        isloading:     (state) => state.loading,
        total:         (state) => state.paginate.total,
        getDateItems : (state) => state.data,
        options:       (state) => state.paginate,
        getPatient:    (state) => state.patient,
        Getcomponet:    (state) => state.componet,
    },

    actions: {

        async GetData({commit},page){ // data de la paginación
            try{
                const {data} = await axios.get(`/api/doctor/waiting_list?page=${page.page}`)
                commit('SET_DATA',data)
            }catch(err){
                return console.log(err)
            }
        },

        async Setloading({commit},value){
            commit('LOADING',value)
        },

        async detectPatient({commit},ci){
            try{
                const {data} = await axios.get(`/api/doctor/waiting_list/detect/${ci}`)
                commit('SET_PATIENT',data)
            }catch(err){
                console.log(err)
            }
        }

    }
}