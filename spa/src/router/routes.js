function page (path) {
    return () =>
    import(/* webpackChunkName: '' */ `@/views/${path}`).then(
        m => m.default || m,
        )
}
function comp (path) {
    return () =>
    import(/* webpackChunkName: '' */ `@/components/${path}`).then(
        m => m.default || m,
        )
}

import middlewares from './middleware/index'
export default [
    {
        path: '/',
        name: 'auth-login',
        component: page('auth/Login.vue'),
        meta:{
            middleware: [middlewares.guest],
        }
    },
    {
        path: '/home',
        name: 'home',
        components: {
                        default: page('Home.vue'),
                        header:  comp('core/AppBar.vue'),
                        sidebar: comp('core/SideBar.vue'),
                        footer:  comp('core/Footer.vue')
                    },
        meta: {
            middleware: [middlewares.auth],
        },

    },

    {
        path: '/consulta/:id',
        props: true,
        name: 'consulta',
        components: {
                        default: page('NewConsulta.vue'),
                        header:  comp('core/AppBar.vue'),
                        sidebar: comp('core/SideBar.vue'),
                        footer:  comp('core/Footer.vue')
                    },
        meta: {
            middleware: [middlewares.auth],
        },
    },

    {
        path: '/consulta/patient/:id',
        props: true,
        name: 'consultaPatient',
        components: {
                        default: page('ConsultaPatient.vue'),
                        header:  comp('core/AppBar.vue'),
                        sidebar: comp('core/SideBar.vue'),
                        footer:  comp('core/Footer.vue')
                    },
        meta: {
            middleware: [middlewares.auth],
        },
    },

    {
        path: '/profile',
        name: 'profile',
        components: {
                        default: page('Profile.vue'),
                        header:  comp('core/AppBar.vue'),
                        sidebar: comp('core/SideBar.vue'),
                        footer:  comp('core/Footer.vue')
                    },
        meta: {
            middleware: [middlewares.auth],
        },

    },

    /* Errors */
    {
        path: '*',
        name: 'error-404',
        props: false,
        component: page('errors/404.vue'),
    },
]

