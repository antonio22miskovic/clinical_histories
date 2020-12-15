import axios from 'axios'
export default {

    state: {
        data:{
                data:null
            }
       
    },

    mutations: {
        SET_DATA(state, payload){
            console.log('el payload:',payload)
            state.data.data = payload.data.data
            console.log('la data:',state.data)
        }
    },
    getters: {
        getData : (state) => state.data
    },

    actions: {

        async GetData({commit},page){
            try{
                const res = await axios.get(`/api/doctor/waiting_list?page=${page}`)
                commit('SET_DATA',res)
                return res
            }catch(err){
                return err
            }
        }

    }
}