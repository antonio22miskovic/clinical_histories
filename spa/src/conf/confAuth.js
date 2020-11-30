import {axiosHeaders} from '@/conf/axiosHeader'
import router from "@/router"
import store from "@/store"

export function handler(store, router){

	axios.interceptors.response.use(null, (error) =>{

		switch (error.response.status){

			case 401:
				router.push('/')
			break

			case 500:
				console.log('ah ocurrido un problema en el servidor')
				return Promise.reject(error)
			break

			default:

			break
		}
	})

	// detecta si envie el nuevo token en el header para actualizarlo en el localstore
	axios.interceptors.response.use((response) => {
  		let headers = response.headers
  		if (headers.authorization !== undefined) {
  			let newtoken = store.state.auth.access_token
  			newtoken = headers.authorization
  			localStorage.setItem('key',JSON.stringify(newtoken))
   			axiosHeaders(headers.authorization)
  		}
  		    return response
	})

}