<template>
    <aside class="main-siderbar" v-if="authUser" :class="`${is_expanded && 'is_expanded'}`">
        <a href="index3.html" class="brand-link">
            <span class="brand-text font-weight-light">PhongTot</span>
        </a>
        <div class="siderbar">
            <div class="sidebarPost d-flex align-items-center mb-1">
                <div class="avatar inline-block" style="padding: 0 .5rem;">
                    <img v-if="authUser.avatar" :src="authUser.avatar" alt="avatar" class="image_avatar_user">
                    <img v-else class="image_avatar_user" src="https://static.vecteezy.com/system/resources/thumbnails/005/129/844/small_2x/profile-user-icon-isolated-on-white-background-eps10-free-vector.jpg" alt="">
                </div>
                <div class="name ps-3 d-block" >
                    <div style="font-size:15px" class=" fw-bold">{{authUser.username}}</div>
                    <div style="font-size:14px" class=""><small>{{authUser.email}}</small></div>
                </div>
            </div>

            <div class="menu-toggle-wrap">
                <button class="menu-toggle" @click="ToggleMenu()">
                    <span class="material-icons">
                         <i class="fa-solid fa-angles-right fa-xl" style="color:#c2c7d0; "></i>
                       <!-- <i class="fa-solid fa-bars fa-xl" style="color:#c2c7d0; "></i> -->
                    </span>
                </button>
            </div>
            <div class="menu" v-for="menuAttribute in menuAttributes" :key="menuAttribute.id">

                <router-link v-if="menuAttribute.title != 'Đăng xuất' " class="button" :to="menuAttribute.url">
                    <i :class="menuAttribute.icon"></i>
                    <span class="text">{{menuAttribute.title}}</span>
                </router-link>
                <a v-else href="#" class="button" @click.prevent="logoutWeb">
                    <i :class="menuAttribute.icon"></i>
                    <!-- <span class="material-icons" ></i></span> -->
                    <span class="text">{{menuAttribute.title}}</span>
                </a>
            </div>
        </div>
    </aside>
</template>

<script>
import { ref, defineComponent } from 'vue'
import {mapState,mapGetters,mapActions} from 'vuex'
import Swal from 'sweetalert2'

export default defineComponent({
    name: "Siderbar",
    computed: {
        ...mapGetters(['authUser'])
    },
    data() {
        const is_expanded = ref(true)
        const menuAttributes = ref([])

        return {
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
                    url : '/postManagement/my_posts/list_posts'
                },
                {
                    icon: 'fa-solid fa-right-from-bracket',
                    title: 'Đăng xuất',
                    url : "/logout",
                }
            ]

            this.menuAttributes = listMenus
        },

        logoutWeb(){
            console.log("1")
            Swal.fire({
                title: "Thông Báo!",
                text: "Banh Muốn Rời Web!",
                icon: "success",
                confirmButtonText: "Đồng Ý",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$store.dispatch('logout');
                }
            });
        }
    },
    created() {
        this.$store.dispatch('getUser');
    },

})
</script>

<style scoped>
    aside {
        position:relative;
        display: flex;
        flex-direction: column;
        width: calc(2rem + 34px);
        min-height: 100vh;
        overflow: hidden;
        background-color: #343a40;
        transition: 0.2s ease-out;
        box-shadow: 0 14px 28px rgba(0, 0, 0, .25), 0 10px 10px rgba(0, 0, 0, .22) !important;
        z-index: 1000;
        padding: 0 .25rem;
    }

    aside .brand-link{
        width: 250px;
        color: #c2c7d0;
        display: block;
        font-size: 1.25rem;
        line-height: 1.5;
        padding: .8125rem .5rem;
        transition: width .3s ease-in-out;
        white-space: nowrap;
        text-align: center;
        border-bottom: 1px solid #4f5962;
    }

    aside::-webkit-scrollbar{
        width: 0%;
    }

    aside .siderbar .menu{
        padding: 0 .25rem;
    }

    aside .sidebarPost{
        padding: 1rem 0rem 1rem 0rem;
        color: #c2c7d0;
        margin: 0 5px;
        border-bottom: 1px solid #4f5962;

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

    aside .menu-toggle-wrap{
        display: flex;
        justify-content: flex-end;
        position: relative;
        top: 0;
        transition: 0.2s ease-out;
    }

    aside .menu-toggle-wrap{
        top: -7.3rem;
        justify-content: center;
    }

    aside h3,
    aside .button .text{
        opacity: 0;
        transition: 0.3s ease-out;
        color: #c2c7d0;
    }

    aside .menu .button {
        min-height: 40px;
        overflow: hidden;
        display: flex;
        text-decoration: none;
        transition: 0.2s ease-out;
        padding-left: 1rem;
        margin-bottom: .2rem;
        border-radius: .25rem;
    }

    aside .menu .button i{
        font-size: 1rem;
        transition: 0.2s ease-out;
        color: #c2c7d0;
        margin: auto;
    }

    aside .menu .button:hover{
        background-color: var(--hover-color)
    }

    aside.is_expanded .menu-toggle-wrap{
        display: flex;
        justify-content: flex-end;
    }

    aside.is_expanded{
        width: 250px;
        min-width: 250px;
        transition: 0.2s ease-in;
    }

    aside.is_expanded .button{
        min-height: 40px;
        display: flex;
        align-items: center;
        padding-left: 0;
        transition: 0.2s ease-out;
    }

    /* aside.is_expanded .menu-toggle-wrap{
        top: -3rem;
    } */

    aside.is_expanded .menu-toggle-wrap .menu-toggle{
        transform: rotate(-180deg);
    }

    aside.is_expanded h3,
    aside.is_expanded .button .text{
        opacity: 1;
    }

    aside.is_expanded .menu .button i{
        padding: 0.5rem 1rem;
        margin: 0;
    }

    .menu .button:hover{
        color: var(--primary-color);
    }

    .menu .button.router-link-active{
        background-color: rgba(255, 255, 255, .9);
        color: #343a40;
    }

    aside .button.router-link-active i,
    aside .button.router-link-active .text{
        color: black;
    }

    @media (max-width: 1024px) {
        aside{
            position: fixed;
            z-index: 99;
        }

        /* aside .sidebarPost{
            padding: 5rem 1rem 0rem 1rem;
        } */

    }
</style>
