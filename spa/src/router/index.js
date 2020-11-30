import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'

Vue.use(VueRouter)

const router = createRouter()


function nextCheck(context, middleware, index){ // ckeck  de los middlewares
	const nextMiddleware = middleware[index]
	if(!nextMiddleware){
		return context.next
	}
	return (...parameters) => {
		context.next(...parameters)
		const nextMidd = nextCheck(context, middleware, {index:index + 1})
		nextMiddleware({...context, next: nextMidd})
	}

}

function createRouter () {

	const router = new VueRouter({
		mode: 'history',
		base: process.env.BASE_URL,
		routes,
  	})

	router.beforeEach((to, from, next) => {
		if (to.meta.middleware) {
			const middleware = Array.isArray(to.meta.middleware) ? to.meta.middleware:[to.meta.middleware]
			const context = {
				from,
				next,
				router,
				to
			}
			const nextMidd = nextCheck(context, middleware, {index:1})
			return middleware[0]({...context, next: nextMidd})
		}

		return next()
	})

  	return router;
}

export default router