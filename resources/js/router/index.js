
import { createRouter, createWebHistory} from "vue-router"

import HomeComponent from '../components/HomeComponent.vue';
import LoginComponent from '../components/Form/LoginComponent.vue';
import SignUpComponent from '../components/Form/SignUpComponent.vue';
import VerifyOTP from '../components/Form/SendOtp/verifyOTPComponent.vue';

// quản lí đăng tin của người dùng
import posterManagement from '../components/posterManagement/index.vue'
import index from '../components/posterManagement/creator/index.vue'
import account from '../components/posterManagement/account/index.vue'
import creator from '../components/posterManagement/creator/child/creator.vue'
import next from '../components/posterManagement/creator/child/nextCreator.vue'

const routes = [
    {
        name: 'home',
        path: '/home',
        component: HomeComponent,
        meta: { public: true }
    },
    {
        name: 'login',
        path: '/login',
        component: LoginComponent,
        meta: { public: true }
    },
    {
        name: 'signup',
        path: '/signup',
        component: SignUpComponent,
        meta: { public: true }
    },
    {
        name: 'verify_otp',
        path: '/check/:otp',
        component: VerifyOTP,
        props: true,
        meta: { public: true }
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

router.beforeEach((to, from, next) => {
    // Check if the user is authenticated (e.g., check if a token is stored)
    const isAuthenticated = !!localStorage.getItem('token');

    if (!to.meta.public && !isAuthenticated) {
    // If the route is not public and the user is not authenticated, redirect to login
        next({ name: 'login' });
    }
    else {
        // Otherwise, allow navigation
        next();
    }
});

export default router
