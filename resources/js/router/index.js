
import { createRouter, createWebHistory} from "vue-router"

import HomeComponent from '../components/HomeComponent.vue';
import LoginComponent from '../components/LoginComponent.vue';
import SignUpComponent from '../components/SignUpComponent.vue';

// quản lí đăng tin của người dùng
import posterManagement from '../components/posterManagement/index.vue'
import index from '../components/posterManagement/creator/index.vue'
import account from '../components/posterManagement/account/index.vue'
import creator from '../components/posterManagement/creator/child/creator.vue'
import next from '../components/posterManagement/creator/child/nextCreator.vue'

const routes = [
    {
        name: 'home',
        path: '/',
        component: HomeComponent
    },
    {
        name: 'login',
        path: '/login',
        component: LoginComponent
    },
    {
        name: 'signup',
        path: '/signup',
        component: SignUpComponent
    },
    {
        name: 'postManagement',
        path: '/postManagement',
        component: posterManagement,
        children: [
            {
                name: 'index',
                path: 'index',
                component: index,
                children: [
                    {
                        name: 'creator',
                        path: 'creator',
                        component: creator,
                    },
                    {
                        name: 'next',
                        path: 'next/:data',
                        component: next,
                        props: true
                    }
                ]
            },
            {
                name: 'account',
                path: 'account',
                component: account
            },
        ]
    },

  ];


const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
