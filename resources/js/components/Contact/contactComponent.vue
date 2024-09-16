<template>
    <navbar-component></navbar-component>
    <div class="container contact_page">
        <div class="container_row">
            <h3 class="py-3">Liên Hệ Với Chúng Tôi</h3>
            <div class="row">
                <div class="contact_left ">
                    <div class="img_contact large">
                        <img src="storage/uploads/2024/images/0-e0394-removebg-preview.png" alt="">
                    </div>
                    <div class="img_contact small">
                        <img src="storage/uploads/2024/images/nhan-vien-removebg-preview.png" alt="">
                    </div>
                    <div class="contact_info">
                        <h5 class="text-white">Thông tin liên hệ</h5>
                        <span class="ps-1">Bạn gặp vấn đề gì sao, bạn có thể liên hệ với chúng tôi giải quyết</span>
                        <div class="item_group">
                            <label for="">Điện thoại: </label>
                            <span>0835667332</span>
                        </div>
                        <div class="item_group">
                            <label for="">Email: </label>
                            <span>phongtrotot.com</span>
                        </div>
                        <div class="item_group">
                            <label for="">Zalo: </label>
                            <span>0835667332</span>
                        </div>
                        <div class="item_group">
                            <label for="">Địa chỉ: </label>
                            <span>Căn 02.34, Lầu 2, Tháp 3, The Sun Avenue,
                                Số 28 Mai Chí Thọ, Phường An Phú, Thành phố Thủ Đức, Thành phố Hồ Chí Minh, Việt Nam.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="contact_right">
                    <div class="img_contact">
                        <img src="storage/uploads/2024/images/0-e0394-removebg-preview.png" alt="">
                    </div>
                    <div class="w-100">
                        <h5>Gửi chúng tôi vấn đề của bạn</h5>
                    </div>
                    <form action="" class="form_group w-100">
                        <div class="item_group">
                            <label for="">Họ Tên</label>
                            <div class="">
                                <input type="text" name="" id="" @input="status_error('username')"  v-model="username" class="form_control">
                            </div>
                            <div class="">
                                <span class="text-danger ps-2">{{error['username']?error['username']:""}}</span>
                            </div>
                        </div>
                        <div class="item_group">
                            <label for="">Email</label>
                            <div>
                                <input type="email" name="" id="" @input="status_error('email')" v-model="email" class="form_control">
                            </div>
                            <div class="">
                                <span class="text-danger ps-2">{{error['email']?error['email']:""}}</span>
                            </div>
                        </div>
                        <div class="item_group">
                            <label for="">Nội dung</label>
                            <div>
                                <textarea name="" id="" cols="30" rows="6" v-model="content" @input="status_error('content')" class="form_control w-100"></textarea>
                            </div>
                            <div class="">
                                <span class="text-danger ps-2">{{error['content']?error['content']:""}}</span>
                            </div>
                        </div>
                        <div class="item_group mt-1">
                            <button type="submit" class="btn btn_completed" @click.prevent="send_contact()">Gửi liên hệ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer-component></footer-component>
    <div class="loading" :class="{'d-block': !loading}">
        <div></div>
    </div>
</template>

<script>
import { ref, defineComponent, onMounted } from 'vue'
import Swal from 'sweetalert2'

import NavbarComponent from '../NavbarComponent.vue';
import FooterComponent from '../FooterComponent.vue';

import contactApi from '../../Api/contactApi.js';
import { date } from 'yup';
export default {
    components: {
        NavbarComponent,
        FooterComponent
    },
    data(){
        const username = ref(null)
        const email = ref(null)
        const content = ref(null)
        const error = ref([])
        const loading = ref(true)

        return {
            username,
            email,
            content,
            error,
            loading
        }
    },
    methods: {

        status_error(value){
            if(this[value] != null || this[value] != ''){
                delete this.error[value]
            }
        },

        async send_contact(){
            const array = ["username","email","content"]

            array.forEach(element => {
                if(this[element] == null){
                    this.error[element] = "Vui lòng không để trống"
                    console.log(this.error)
                }
            });

            const reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/
            if (!reg.test(this.email)) {
                this.error['email'] = 'Bạn nhập sai định dạng';
            }

            if(Object.keys(this.error).length == 0){
                console.log('hi')
                const data = {
                    email : this.email,
                    username : this.username,
                    content : this.content
                }

                this.loading = !this.loading
                const response = await contactApi.sendContact(data)
                this.loading = !this.loading
                if(response){
                    Swal.fire({
                        icon: "success",
                        title: "Gửi thành công",
                        showConfirmButton: true,
                    }).then(()=> {
                        location.reload()
                    });
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Gửi thất bại",
                        showConfirmButton: true,
                    }).then(()=> {
                        // location.reload()
                    });
                }
            }
        }
    }
}
</script>

<style scoped>
    .container.contact_page{
        width: 1100px;
        padding: 40px 0px;

    }

    .contact_left {
        width: 48%;
        padding: 0px 20px 20px;
        background: linear-gradient(145deg,#ff3131,#ff914d,#f8bd79 100%);
        border-radius: 40px ;
    }

    .contact_left .img_contact {
        width: 100%;
    }

    .contact_left .img_contact.small{
        display: none;
        position: relative;
    }

    .contact_left .img_contact img{
        width: 80%;
        object-fit: cover;
        object-position: center;
        text-align: center;
    }

    .contact_left .img_contact.small img{
        position: absolute;
        z-index: 999;
    }

    .contact_left .contact_info{
        color: #fff;
        font-size: 1rem;
    }

    .contact_left .contact_info .item_group label{
        font-weight: 600;
        font-size: 1.2rem;
        padding-right: 5px;
    }

    .contact_right{
        width: 49%;
        background-color: #ffff;
        margin-left: 10px;
        padding: 30px;
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
    }

    .contact_right img{
        display: none;
    }

    .contact_right .form_group .item_group label{
        display: block;
        font-weight: 400;
        font-size: 1rem;
        margin-bottom: 5px;
        /* text-transform: uppercase; */
    }

    .item_group div .form_control {
        width: 100%;
        height: 45px;
        border: 0;
        background-color: rgb(250, 198, 181,0.5);
        padding: 0 10px;
        border-radius: 5px;
        font-size: 1.5rem;
        font-weight: 600;
        outline: none;
        color: black;
    }

    .item_group div .form_control:focus{
        color: #ff5d26;
    }

    .item_group div textarea.form_control{
        height: 90px;
        padding: 10px;
    }

    .item_group .btn.btn_completed{
        width: 100%;
        height: 45px;
        border-radius: 5px;
        border: 1px solid #ff5d26;
        background: #ff5d26;
        font-weight: 700;
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        cursor: pointer;
        padding: 0px 10px;
        margin: 0;
    }

    .item_group .btn.btn_completed:hover{
        border: 1px solid rgb(255, 93, 38,0.8);
        background: rgb(255, 93, 38,0.8);
    }

    .loading{
        display: none;
        z-index: 99999;
        position: absolute;
        left: 60%;
        top: 46%;
        margin: auto;
    }

    .loading div{
        height: 35px;
        width: 35px;
        border: 4px solid #45474b;
        border-top-color: #DCDCDC ;
        border-radius: 50%;
        border-style:dotted ;
        animation: spin 1.5s infinite linear;
        margin: auto;
    }

    @media only screen and (max-width: 1000px)  {

        h3{
            color: #ffff;
        }

        .container{
            padding: 0rem;

        }

        .container.contact_page {
            width: 100%;
            padding: 40px 0px;
        }

        .container_row{
            background: linear-gradient(145deg,#ff3131,#ff914d,#f8bd79 100%);
            padding: 20px;
            border-radius: 30px;
        }

        .contact_left{
            width: 45%;
            background: transparent;
        }

        .contact_left .contact_info{
            color: #fff;
            font-size: 1rem;
            display: none;
        }

        .contact_left .img_contact.small {
            display: block;
            width: 100%;
        }

        .contact_left .img_contact.small::after{
            content: "";  /* Cần thiết để hiển thị pseudo-element */
            display: block;  /* Hoặc inline-block, tùy thuộc vào nhu cầu */
            width: 200px;
            height: 200px;
            z-index: 6;
            border-radius:50%;
            background-color: #ffff;
            position: absolute;
            top: 100px;
            right: 3px;
            left: 20px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        }

        .contact_left .img_contact.large {
            display: none;
        }

        .contact_right{
            width: 51%;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }
    }

    @media only screen and (max-width: 796px)  {

    }

    @media only screen and (max-width: 420px)  {
        .container{
            padding: 0rem;
        }

        h3{
            color: black;
        }

        .container_row{
            background: transparent;
            padding: 0px;
            border-radius: 30px;
        }

        .container.contact_page{
            width: 100%;
            padding: 40px 0px;

        }
        .contact_left{
            display: none;
        }

        .contact_right{
            width: 100%;
            background-color: #ffff;
            margin-left: 0px;
            padding: 0px 30px 30px;
            border-radius: 0px;
            box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
        }

        .contact_right img{
            display: block;
            width: 100%;
            padding-top: 0px;
        }
    }
</style>
