
<template>
    <div class="header_navbar px-0 bg-white">
        <div class="header py-2 bg-light">
            <div class="d-flex justify-content-between aglin-items-center text-center">
                <div class="ps-5">
                    <span class="text-secondary" style="font-size: 14px">Nơi cung cấp những căn phòng tốt nhất</span>
                </div>
                <div class="pe-5">
                    <span class="text-secondary" style="font-size: 14px">Liên lạc: 0834006771 | Phòng tốt | Nhà tốt</span>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light px-0" id="navbar-menu">
            <div class="container">
                <a class="navbar-brand" href="/home">
                    <div class="logo w-100">
                        <img class="w-100" src="../../image/logo.png" alt="">
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-md-flex align-items-center"  id="navbarSupportedContent">

                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
                        <li class="nav-item dropdown" v-if="!isLoggedIn" >
                            <a class="nav-link d-flex align-items-center" href="/login" >
                                <div class="avatar d-flex align-items-center">
                                   <i class="bi bi-person-plus-fill"></i>
                                </div>
                                <small><span class="ps-1">Đăng Nhập</span></small>
                            </a>
                        </li>
                        <li class="nav-item dropdown" v-if="!isLoggedIn">
                            <a class="nav-link d-flex align-items-center" href="/signup" >
                                <div class="avatar d-flex align-items-center">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                </div>
                                <small><span class="ps-1">Đăng Kí</span></small>
                            </a>
                        </li>
                        <li  class="nav-item dropdown" v-if="isLoggedIn && authUser">
                            <div class="userLogin w-100">

                                <div class="avatar_name d-flex align-items-center dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar inline-block">
                                        <img v-if="authUser.avatar" :src="authUser.avatar" alt="avatar" class="image_avatar_post">
                                        <img v-else class="image_avatar_post" src="/storage/uploads/2024/06/04/profile.jpg" alt="">
                                    </div>
                                    <div class="name ps-1 fw-semibold" >
                                        <span style="font-size:15px">{{authUser.username}}</span>
                                    </div>
                                </div>
                                <ul class="dropdown-menu mt-2 p-1" aria-labelledby="navbarDropdown">
                                    <li class="menu-child border-bottom py-1">
                                        <a class="dropdown-item" href="/postManagement/index/creator">📝 Đăng tin cho thuê</a>
                                    </li>
                                    <li class="menu-child border-bottom py-1">
                                        <a class="dropdown-item" href="/postManagement/my_posts/list_posts">📑 Quản lí tin đăng</a>
                                    </li>
                                    <li class="menu-child border-bottom py-1">
                                        <a class="dropdown-item" href="#">👤 Thông tin tài khoản</a>
                                        </li>
                                    <li class="menu-child border-bottom py-1">
                                        <a class="dropdown-item" href="#">💖 Tin đã yêu thích</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/login" @click.prevent="logoutWeb" ><i class="fa-solid fa-right-from-bracket"></i> Thoát</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item_post">
                            <div class=" dropdown ms-md-4 ms-sm-0 ">
                                <a class="post_new nav-link d-flex align-items-center px-4 w-sm-auto" href="/postManagement/index/creator" >
                                    <div class="avatar d-flex align-items-center">
                                        <i class="bi bi-file-earmark-plus-fill"></i>
                                    </div>
                                    <span class="ps-1">Đăng Tin</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


</template>

<script>
import { ref } from 'vue'
import {mapState,mapGetters,mapActions} from 'vuex'
import Swal from 'sweetalert2'

import userApi from '../Api/userApi'

export default {
    computed: {
        ...mapGetters(['isLoggedIn']),
        ...mapGetters(['authUser'])
    },
    mounted() {
        console.log('Component mounted.')
    },
    data() {
    },
    methods: {

        logoutWeb(){
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
        this.user = this.$store.dispatch('getUser');
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

    .App.fix_body #navbar-menu {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
    }

    #navbar-menu {
        display: block;
        width: 100%;
        background-color: #fff;
    }
    .navbar{
        box-shadow: rgba(33, 35, 38, 0.2) 0px 10px 10px -10px;
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

    .navbar-light .navbar-nav .nav-link:focus,
    .navbar-light .navbar-nav .nav-link:hover {
        color: rgb(255, 93, 38,0.7);
    }
</style>

