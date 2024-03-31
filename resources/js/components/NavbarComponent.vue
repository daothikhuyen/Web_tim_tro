
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
        <nav class="navbar navbar-expand-lg navbar-light px-0 position-sticky ">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <div class="logo w-100">
                        <img class="w-100" src="../../image/logo.png" alt="">
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-md-flex align-items-center" id="navbarSupportedContent">

                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link d-flex align-items-center" href="/login" >
                                <div class="avatar d-flex align-items-center">
                                   <i class="bi bi-person-plus-fill"></i>
                                </div>
                                <small><span class="ps-1">Đăng Nhập</span></small>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link d-flex align-items-center" href="/signup" >
                                <div class="avatar d-flex align-items-center">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                </div>
                                <small><span class="ps-1">Đăng Kí</span></small>
                            </a>
                        </li>
                        <li class="nav-item_post dropdown ms-md-4 ms-sm-0 ">
                            <a class="post_new nav-link d-flex align-items-center px-4 w-sm-auto" href="#" >
                                <div class="avatar d-flex align-items-center">
                                    <i class="bi bi-file-earmark-plus-fill"></i>
                                </div>
                                <span class="ps-1">Đăng Tin</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

</template>

<script>

    export default {
        mounted() {
            console.log('Component mounted.')
        },

    }


</script>

<style>
    :root{
        --primary-color: #ff5d26
    }

    .header_navbar.logo_info{
        width: 100px;
        height: 100px;
    }

    .navbar{
        box-shadow: rgba(33, 35, 38, 0.2) 0px 10px 10px -10px;
    }

    .header_navbar .navbar .navbar-brand{
        width: 120px;
    }

    .navbar .navbar-nav .avatar{
        width: 20px;
        height: 20px
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

    .navbar-nav .nav-item:hover a{
        color: var(--primary-color);
    }

    .navbar .nav-item_post:hover a{
        background-color: #ea4e27;
    }
</style>

