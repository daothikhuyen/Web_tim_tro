// HomeComponent.vue

<template>
    <div class="LoginComponent" :class="{loading: showLoading}">
        <navbar-component></navbar-component>
        <div class="view_home container-fluid mt-3" style="">
            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-8 py-3">
                    <Form @submit="Validate" :validation-schema="schema" v-slot="{errors}">
                        <div class="from_login login">
                            <div class="form-group">
                                <h3 class="text-center">Đăng Nhập</h3>
                            </div>
                            <div class="alter w-100">
                                <div  v-if="this.error['error'] != null" class="error">
                                        <i class="bi bi-exclamation-circle text-danger fw-bolder fs-5 pe-2"></i>
                                        {{error['error']}}
                                </div>
                                <div  v-if="this.error['success'] != null" class="success">
                                        <i class="fa-solid fa-check text-success fw-bolder fs-5 pe-2"></i>
                                        {{error['success']}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="pt-2 pb-1 ps-2">Email</label>
                                <Field type="text" name="email" id="email" class="form-control" :class="{'is-invalid' : errors.email}" />
                                <span class="invalid-feedback">{{errors.email}}</span>
                            </div>
                            <div class="form-group">
                                <label for="" class="pt-2 pb-1 ps-2">Mật Khẩu</label>
                                <Field type="password" name="password" id="password" class="form-control" :class="{'is-invalid' : errors.password}" />
                                <span class="invalid-feedback">{{errors.password}}</span>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label"></label>
                                <button type="submit"  class="form-control btn-login">Đăng Nhập</button>
                            </div>
                            <div class="form-group footer_form d-flex justify-content-between my-3">
                                <a href="/account/forgot_password" ><small>Bạn quên mật khẩu ?</small></a>
                                <a href="/signup"><small>Tạo tài khoản mới</small></a>

                            </div>
                        </div>
                    </Form>
                </div>
                <div class="col-md-2">

                </div>
            </div>
            <!-- <div class="row">
                <div class="contact_us offset-md-2 col-md-8 offset-sm-1 col-sm-10  bg-white mb-4">
                    <div class="contact_img w-50 mx-auto d-flex justify-content-center" >
                        <img class="w-75 " src="../../../image/contact.png" alt="">
                    </div>
                    <div class="info_contact text-center">
                        <span class="text-black-50" >Liên hệ với chúng tôi nếu bạn cần hổ trợ</span>
                    </div>
                    <div class=" d-flex justify-content-center my-3">
                        <button class="btn_contact p-2 px-3">Gửi Liên Hệ</button>
                    </div>
                </div>
            </div> -->
        </div>
        <footer-component></footer-component>
    </div>
    <div :class="{hide: !showLoading}">
        <div class="page_loading">
            <div>
                <div></div>
                <div class="">
                    Loading...
                </div>
            </div>
        </div>
    </div>

</template>

<script>

import {ref} from 'vue'
import { Form, Field } from 'vee-validate';
import * as yup from 'yup';
import Swal from 'sweetalert2'
import debounce from 'lodash.debounce';

import NavbarComponent from '../NavbarComponent.vue'
import FooterComponent from '../FooterComponent.vue'
import userApi from '../../Api/userApi';

export default {
    name: "LoginComponent",
    components:{
        NavbarComponent,
        FooterComponent,
        Form,
        Field,
    },
    data(){
        const error = [];
        const showLoading = ref(false)
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        const schema = yup.object().shape({
            email: yup.string().required('Vui lòng nhập thông tin').email('Email không đúng định dạng'),
            password: yup.string().required('Vui lòng nhập thông tin'),

        })
        return {
            schema,
            error,
            showLoading
        }
    },
    mounted() {
    },
    methods: {
        Validate : debounce(async function (values) {
            this.showLoading = !this.showLoading
            const result = await userApi.login(values)

            if(!result.error){
                localStorage.setItem('token',result.token);

                this.$store.dispatch('getUser');
                this.$store.commit('LOGIN')
                this.showLoading = !this.showLoading

                Swal.fire({
                    icon: "success",
                    title: "Đăng Nhập Thành Công",
                    showConfirmButton: false,
                    timer: 1500
                }).then(()=> {
                    this.showLoading = !this.showLoading
                    this.$router.push('/home')
                });
            }else{
                this.showLoading = !this.showLoading
                delete this.error['error'];
                this.error['error'] = result.message
            }
        },1000)
    },
    created(){

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
        font-size: 15px;
    }

    .from_login .form-group.footer_form a{
        list-style: none;
        text-decoration: none;
    }

    .form-group a:hover{
        color: #ff5d26;
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

        /* trang loading */
    .hide {
        display: none;
    }

    .loading{
        height: 100vh;
        overflow: hidden;
    }

    .page_loading{
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgb(0, 0, 0,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .page_loading > div {
        margin: auto;
    }

    .page_loading div > div:nth-child(1){
        height: 50px;
        width: 50px;
        border: 8px solid #45474b;
        border-top-color: #ffff ;
        border-radius: 50%;
        animation: spin 1.5s infinite linear;
    }

    .page_loading div > div:nth-child(2){
        color:#fff;
        font-size: 20px;
        text-align: center;
    }

    @keyframes spin {
        100%{
            transform: rotate(360deg);
        }
    }

    @media only screen and (max-width: 420px) {
        .account_setup{
            padding-right: 80px;
        }

        form .form-group div:nth-child(3) .btnSetUp{
            margin-top: 20px;
        }

        .row>* {
            padding-right: 0px;
            padding-left: 0px;
        }

        .from_login{
            border-radius:0px ;
        }
    }

</style>
