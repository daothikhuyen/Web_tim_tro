<template>
    <aside :class="`${is_expanded && 'is_expanded'}`">
        <div class=" d-flex align-items-center mt-2">
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
        <div class="menu">
                <a href="/" class="button">
                    <span class="material-icons" to="/"><i class="fa-solid fa-house"></i></span>
                    <span class="text">Trang Chủ</span>
                </a>
                <a href="/" class="button">
                    <span class="material-icons" to="/"><i class="fa-solid fa-user"></i></span>
                    <span class="text">Tài Khoản</span>
                </a>
                <a href="/" class="button">
                    <span class="material-icons" to="/"><i class="fa-solid fa-notes-medical"></i></span>
                    <span class="text">Đăng Bài</span>
                </a>
                <a href="/" class="button">
                    <span class="material-icons" to="/"><i class="fa-solid fa-list-check"></i></span>
                    <span class="text">Quản lý tin đăng</span>
                </a>
                <a href="/" class="button">
                    <span class="material-icons" to="/"><i class="fa-solid fa-heart"></i></span>
                    <span class="text">Tin Đã Like</span>
                </a>
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

        return {
            user: [],
            is_expanded
        }
    },
    methods: {
        ToggleMenu() {
            this.is_expanded = !this.is_expanded
        }
    },
    created() {
        this.user = userApi.User()
    },

})
</script>

<style scoped>
    aside {
        position: sticky;
        display: flex;
        flex-direction: column;
        width: calc(2rem + 32px);
        min-height: 100vh;
        overflow: hidden;
        padding: 1rem;
        background-color: #f3f3f3;
        transition: 0.2s ease-out;
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
        border-radius: 8px;
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

    @media (max-width: 768px) {
        aside{
            position: fixed;
            z-index: 99;
        }

    }
</style>
