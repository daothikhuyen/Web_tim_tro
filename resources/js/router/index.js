
import { createRouter, createWebHistory} from "vue-router"

import HomeComponent from '../components/HomeComponent.vue';
import LoginComponent from '../components/LoginComponent.vue';
import SignUpComponent from '../components/SignUpComponent.vue';
import viewAddPost from '../components/ManagerUser/View_ManagerUser/index.vue'
import listPost from '../components/ManagerUser/View_ManagerUser/list.vue'
import newPostNext from '../components/ManagerUser/View_ManagerUser/viewChildren/newPostNext.vue'

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
        name: 'addPost',
        path: '/addPost',
        component:viewAddPost
    },
    {
        name: 'seeBefore',
        path: '/addPost/next',
        component:newPostNext
    },
    {
        name: 'ListPost',
        path: '/listpost',
        component:listPost
    },

  ];


const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
