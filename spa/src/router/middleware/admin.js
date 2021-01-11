import store from "@/store";
import Swal from 'sweetalert2'
export default function admin({next,router}){
    if (!store.state.auth.user) {

        return router.push({'name':'auth-login'})

    } else if(store.state.auth.user.rol !== 1){

        return   Swal.fire('Permiso Denegado', '', 'error')

    }else{

        return next()

    }
}