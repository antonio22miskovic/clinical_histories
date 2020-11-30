export default function guest({next,router}){
	if (localStorage.getItem('user')) {
		return router.push({'name':'home'})
	}
		return next()
}