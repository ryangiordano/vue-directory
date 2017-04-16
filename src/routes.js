
const Login = resolve => {
    require.ensure(['./components/auth/login.vue'], () => {
        resolve(require('./components/auth/login.vue'))
    })
}
const EmployeeDetail = resolve => {
    require.ensure(['./components/employee/employee-detail.vue'], () => {
        resolve(require('./components/employee/employee-detail.vue'))
    })
}

const Home = resolve => {
    require.ensure(['./components/Home.vue'], () => {
        resolve(require('./components/Home.vue'))
    })
}

export const routes = [{
        path: '/',
        name:'home',
        component: Home,
        name: 'Home'
    },
    {
        path: '/login',
        component: Login,
        name: 'Login'
    },
    {
        path: '/detail/:id',
        name: 'detail',
        component: EmployeeDetail
    },
    {
        path: '*',
        redirect: {
            name: 'Home'
        }
    }
]
