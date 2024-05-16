
<template>
    <div class="header_navbar bg-white">
        <div class="d-none d-md-block header py-2 bg-light">
            <div class="d-flex justify-content-between aglin-items-center text-center">
                <div class="ps-5">
                    <span class="text-secondary" style="font-size: 14px">Nơi cung cấp những căn phòng tốt nhất</span>
                </div>
                <div class="pe-5">
                    <span class="text-secondary" style="font-size: 14px">Liên lạc: 0834006771 | Phòng tốt | Nhà tốt</span>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar-menu">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <div class="logo w-100">
                        <img class="w-100" src="../../../image/logo.png" alt="">
                    </div>
                </a>
            </div>
        </nav>

    </div>


</template>

<script>
import { ref } from 'vue'

import apiUser from '../../Api/userApi'

export default {
    mounted() {
        console.log('Component mounted.')
    },
    data() {

        return {
            user: []
        }
    },
    methods: {
    },
    computed: {

    },
    created() {
        this.user = apiUser.User()
    },
}

</script>

<style scoped>
    :root{
        --primary-color: #ff5d26
    }

    .header_navbar.logo_info{
        width: 100px;
        height: 100px;
    }

    .navbar{
        position: fixed;
        box-shadow: rgba(33, 35, 38, 0.2) 0px 10px 10px -10px;
        z-index: 100;
    }

    .header_navbar .navbar .navbar-brand{
        width: 120px;
    }

    .navbar .collapse .post_new{
        background-color: var(--primary-color);
        color: #fff;
        font-size: 15px;
        font-weight: 500;
        border: 3px solid #d95230;
        border-radius: 10px;
    }

    /* active */
    .navbar-nav .nav-link.active, .navbar-nav .nav-link.show {
        color: var(--primary-color);
    }

    .navbar .nav-item_post:hover a{
        background-color: #ea4e27;
    }

    /* avatar */

    .userLogin .avatar_name .avatar img {
        height: 30px;
        width: 30px;
        border-radius: 100rem;
        object-fit: cover;
    }

    .dropdown-menu:hover li {
        color: black;
    }

    .dropdown-menu .menu-child:hover a{
         color: var(--primary-color);
    }

    .dropdown-item.active, .dropdown-item:active {
        color: var(--bs-dropdown-link-active-color);
        text-decoration: none;
        background-color: #f4f4f4;
    }

</style>

