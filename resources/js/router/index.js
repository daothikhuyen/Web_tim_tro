
import { createRouter, createWebHistory} from "vue-router"

import HomeComponent from '../components/HomeComponent.vue';
import LoginComponent from '../components/LoginComponent.vue';
import SignUpComponent from '../components/SignUpComponent.vue'

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
    }
  ];


const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
