// HomeComponent.vue

<template>
    <div class="LoginComponent" >
        <navbar-component></navbar-component>
        <div class="view_home container-fluid mt-3" style="">
            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-8 py-3">
                    <form action="" method="post">
                        <div class="from_login login">
                            <div class="form-group">
                                <h3 class="text-center">Đăng Kí Tài Khoản</h3>
                            </div>
                            <div class="form-group">
                                <label for="" class="py-1 ps-2">Họ tên</label>
                                <input type="text" name="" id="" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="" class="pt-2 pb-1 ps-2">Email</label>
                                <input type="email" name="" id="" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="" class="pt-2 pb-1 ps-2">Số điện thoại(+84)</label>
                                <input type="email" name="" id="" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="" class="pt-2 pb-1 ps-2">Password</label>
                                <input type="password" name="" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="" class="pt-2 pb-1 ps-2">Nhập lại mật khẩu</label>
                                <input type="password" name="" id="" class="form-control">
                            </div>
                            <div class="d-flex align-items-center mt-4 ps-2">
                                <input type="checkbox" name="" id="" class="">
                                <label for="" class="pt-2 pb-1 ps-3 ">Đồng ý với <span class="text-primary">các chính sách bảo mật</span> của  <br>chúng tôi.</label>
                            </div>
                            <div class="form-group">
                                  <label for="" class="pt-2 pb-1 ps-2"></label>
                                <input type="submit" class="form-control btn-login" value="Tạo tài khoản">
                            </div>
                            <div class="form-group footer_form my-3 text-black-50">
                                <span>Bạn đã có tài khoản? </span>
                                <a href="/login">Đăng nhập ngay</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">

                </div>
            </div>
            <div class="row">
                <div class="contact_us offset-2 col-md-8 bg-white mb-4">
                    <div class="contact_img w-50 mx-auto d-flex justify-content-center" >
                        <img class="w-75 " src="../../image/contact.png" alt="">
                    </div>
                    <div class="info_contact text-center">
                        <span class="text-black-75" >Liên hệ với chúng tôi nếu bạn cần hổ trợ</span>
                    </div>
                    <div class=" d-flex justify-content-center my-3">
                        <button class="btn_contact p-2 px-3">Gửi Liên Hệ</button>
                    </div>
                </div>
            </div>
        </div>
        <footer-component></footer-component>
    </div>
</template>

<script>

    import NavbarComponent from './NavbarComponent.vue'
    import FooterComponent from './FooterComponent.vue'

    export default {
        name: "LoginComponent",
        mounted() {
            console.log('Component mounted.')
        },
        components:{
        NavbarComponent,
        FooterComponent
    }
    }


</script>

<style scoped>

    :root{
        --primary-color: #ff5d26
    }


    .from_login{
        background-color: #fff;
        border: 1px solid #dedede;
        border-radius: 8px;
    }

    .from_login.login{
        max-width: 600px;
        margin: 0 auto;
        padding: 30px 30px 100px;
        background-color: #fff;
    }

    .from_login .form-group .btn-login{
        background-color: var(--primary-color);
        color: #ffff;
        font-size: 18px;
    }

    .from_login .form-group.footer_form a{
        list-style: none;
        text-decoration: none;
    }

    .view_home .contact_us{
        border: 5px solid rgb(255, 93, 38,0.2);
        padding: 16px;
        border-style: dashed;
        border-radius: 10px;
    }

    .view_home .btn_contact{
        background-color: var(--primary-color);
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 8px;
    }

    .view_home .btn_contact:hover{
        background-color: #af3810 ;
    }

</style>
