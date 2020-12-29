import store from "@/store";
export default function auth({next,router}){
	if (!store.state.auth.user) {
		return router.push({'name':'auth-login'})
	}
		return next()
}