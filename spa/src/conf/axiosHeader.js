import axios from 'axios'
import {getlocaluser} from '@/conf/getUser'
// esta funcion inyecta constatemente el token que esta en el estado
export function axiosHeaders(store){

		if (store.state.auth.access_token) {
      		setAuthorization(store.state.auth.access_token)
  		}

}

// funcion de manejo de cabezera para manipular el token
export function setAuthorization(token){
	axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
}
