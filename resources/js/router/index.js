
import { createRouter, createWebHistory} from "vue-router"

import HomeComponent from '../components/HomeComponent.vue';
import LoginComponent from '../components/LoginComponent.vue';
import SignUpComponent from '../components/SignUpComponent.vue';
import AddPost from '../components/ManagerUser/View_ManagerUser/addPost.vue'
import listPost from '../components/ManagerUser/View_ManagerUser/list.vue'

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
        component:AddPost
    },
    {
        name: 'ListPost',
        path: '/listpost',
        component:listPost
    }
  ];


const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
