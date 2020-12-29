import store from "@/store";
export default function guest({next,router}){
	if (store.state.auth.user) {
		return router.push({'name':'home'})
	}
		return next()
}