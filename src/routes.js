
const Login = resolve => {
    require.ensure(['./components/auth/login.vue'], () => {
        resolve(require('./components/auth/login.vue'))
    })
}

const Home = resolve => {
    require.ensure(['./components/Home.vue'], () => {
        resolve(require('./components/Home.vue'))
    })
}

export const routes = [{
        path: '/',
        component: Home,
        name: 'Home'
    },
    {
        path: '/login',
        component: Login,
        name: 'Login'
    },
    {
        path: '*',
        redirect: {
            name: 'Home'
        }
    }
]
