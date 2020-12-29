import axios from 'axios'
import {axiosHeaders} from '@/conf/axiosHeader'
import Swal from 'sweetalert2'
export function handler(store, router){

	axios.interceptors.response.use(null, (error) =>{

		switch (error.response.status){

			case 401:
                    localStorage.removeItem('user')
                    localStorage.removeItem('key')
				router.push('/')
			break

			case 500:
				// console.log('ah ocurrido un problema en el servidor')
    //             Swal.fire({
    //                 position:'top-end',
    //                 icon: 'error',
    //                 title: 'Disculpe ah ocurrido un error interno.. Intente mas tarde',
    //                 showConfirmButton: false,
    //                 timer: 1500
    //             })
			break

			default:

			break
		}
	})
    console.log('dentro del auth')
	// detecta si envie el nuevo token en el header para actualizarlo en el localstore
	axios.interceptors.response.use((response) => {
  		let headers = response.headers
        // console.log('dentro del intercetor')
        // console.log('el response:', response)
        // console.log('el header:',headers)
  		if (headers.authorization !== undefined) {
  			let newtoken = store.state.auth.access_token
            console.log('el token del store:', newtoken)
  			newtoken = headers.authorization
            console.log('el new token:', newtoken)
  			localStorage.setItem('key',JSON.stringify(newtoken))
   			axiosHeaders(headers.authorization)
  		}
  		    return response
	})

}