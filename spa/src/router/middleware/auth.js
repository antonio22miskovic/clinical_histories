export default function auth({next,router}){
	if (!localStorage.getItem('user')) {
		return router.push({'name':'auth-login'})
	}
		return next()
}