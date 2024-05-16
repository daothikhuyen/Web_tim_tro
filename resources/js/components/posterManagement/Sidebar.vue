<template>
    <aside :class="`${is_expanded && 'is_expanded'}`">
        <div class="sidebarPost d-flex align-items-center mt-2">
            <div class="avatar inline-block">
                <img :src="user[0].avatar" alt="avatar" class="image_avatar_user">
            </div>
            <div class="name ps-3 d-block" >
                <div style="font-size:15px" class=" fw-semibold">{{ user[0].username }}</div>
                <div style="font-size:14px"><small>{{ user[0].phone }}</small></div>
            </div>
        </div>
        <div class="menu-toggle-wrap">
            <button class="menu-toggle" @click="ToggleMenu()">
                <span class="material-icons">
                    <i class="fa-solid fa-angles-right"></i>
                </span>
            </button>
        </div>
        <hr class="dropdown-divider border-bottom mb-2 mt-1">
        <div class="menu" v-for="menuAttribute in menuAttributes" :key="menuAttribute.id">
            <router-link class="button" :to="menuAttribute.url">
                <span class="material-icons" ><i :class="menuAttribute.icon"></i></span>
                <span class="text">{{menuAttribute.title}}</span>
            </router-link>
        </div>
    </aside>
</template>

<script>
import { ref, defineComponent } from 'vue'

import userApi from '../../Api/userApi'


export default defineComponent({
    name: "Siderbar",
    components: {
    },
    data() {
        const is_expanded = ref(false)
        const menuAttributes = ref([])

        return {
            user: [],
            is_expanded,
            menuAttributes
        }
    },
    mounted() {
        this.addMenuAttribute();
    },
    methods: {
        ToggleMenu() {
            this.is_expanded = !this.is_expanded
        },

        addMenuAttribute(){
            const listMenus = [
                {
                    icon : 'fa-solid fa-house',
                    title : 'Trang chủ',
                    url : '/'
                },
                {
                    icon : 'fa-solid fa-user',
                    title : 'Tài khoản',
                    url : '/postManagement/account'
                },
                {
                    icon : 'fa-solid fa-notes-medical',
                    title : 'Đăng bài',
                    url : '/postManagement/index/creator'
                },
                {
                    icon : 'fa-solid fa-list-check',
                    title : 'Quản lí tin đăng',
                    url : '/postManagement/ports/creator'
                },
                {
                    icon : 'fa-solid fa-heart',
                    title : 'Tin đã yêu thích',
                    url : "{ name: '/postManagement/index/creator/next', params: { postInfo: 'xin choà' } }"
                },
            ]

            this.menuAttributes = listMenus
        }
    },
    created() {
        this.user = userApi.User()
    },

})
</script>

<style scoped>
    aside {
        position:static ;
        display: flex;
        flex-direction: column;
        width: calc(2rem + 32px);
        /* height: 100vh;
        overflow-y: scroll; */
        min-height: 100vh;
        overflow: hidden;
        background-color: #f3f3f3;
        transition: 0.2s ease-out;
    }

    aside::-webkit-scrollbar{
        width: 0%;
    }

    aside .sidebarPost{
        padding: 5rem 1rem 1rem 1rem;
    }

    .avatar img{
        height: 2rem;
        width: 2rem;
        border-radius: 100rem;
        object-fit: cover;
    }

    aside .name div:nth-child(1){
        line-height: 15px;
        margin-top: 4px;
    }

    aside.is_expanded{
        width: 300px;
        transition: 0.2s ease-in;
    }

    aside .menu-toggle-wrap{
        display: flex;
        justify-content: flex-end;
        position: relative;
        top: 0;
        transition: 0.2s ease-out;
    }

    aside.is_expanded .menu-toggle-wrap{
        top: -3rem;
    }

    aside .menu-toggle-wrap .material-icons{
        font-size: 1rem;
        padding: 1rem;
    }

    aside h3,
    aside .button .text{
        opacity: 0;
        transition: 0.3s ease-out;
    }

    aside .menu .button {
        display: flex;
        align-items: center;
        text-decoration: none;
        padding: 0rem 0.5rem;
        transition: 0.2s ease-out;
        padding-left: 1rem;
    }

    aside .menu .button .material-icons{
        font-size: 1rem;
        /* color: var( --primary-color); */
        margin-right: 1rem;
        transition: 0.2s ease-out;
    }

    aside .menu .button .text{
        /* color: var( --primary-color); */
        transition: 0.2s ease-out;
    }

    aside .menu .button:hover{
        background-color: var(--hover-color)
    }

    aside.is_expanded .logo img{
        width: 10rem;
        margin: auto;
    }

    aside.is_expanded .menu-toggle-wrap{
        display: flex;
        justify-content: flex-end;
    }

    aside.is_expanded .menu-toggle-wrap .menu-toggle{
        transform: rotate(-180deg);
    }

    aside.is_expanded h3,
    aside.is_expanded .button .text{
        opacity: 1;
    }

    aside.is_expanded .button .material-icons{
        padding: 0.5rem 1rem;
        margin-right: 1rem;
    }

    .menu .button:hover{
        color: var(--primary-color);
    }

    .menu .button.router-link-active{
        border-right: 5px solid var(--primary-color);
        color: var(--primary-color);
        background-color: var(--hover-color);
    }

    /* .hover {
        border-radius: 8px;
        background-color: var(--hover-color);
    } */

    @media (max-width: 768px) {
        aside{
            position: fixed;
            z-index: 99;
        }

        aside .sidebarPost{
            padding: 5rem 1rem 0rem 1rem;
        }

    }
</style>
