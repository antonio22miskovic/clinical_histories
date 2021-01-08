import store from "@/store";
import Swal from 'sweetalert2'
export default function analista({next,router}){
    if (!store.state.auth.user) {

        return router.push({'name':'auth-login'})

    } else if(store.state.auth.user.rol !== 2){

        return   Swal.fire('Permiso Denegado', '', 'error')

    }else{

        return next()

    }
}