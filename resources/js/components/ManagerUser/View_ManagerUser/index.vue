// view wirte post

<template>
    <div class="container-fluid px-0 bg-white h-100">
        <navbar/>
        <div class="homeManager">
            <sidebar/>
            <div class="ViewPost w-100 m-auto pb-4">
                <div class="row">
                    <div class="col-lg-9 col-md-12 mt-5">
                        <form action="" class="">
                            <div class="p-2 ps-3 mx-2 rounded-3 w-100"  style="background-color: rgb(162, 160, 160,0.25)">
                                <span class="title">PhongTot</span> / <span class="title">Quản lí </span>/ <span>Đăng tin mới</span>
                            </div>
                            <div class="pt-4">
                                <h5 class="ps-3">Đăng Tin Mới</h5>
                                <hr>
                            </div>
                            <div class="error">

                            </div>
                            <section class="info px-3 py-3 row">
                                <createAddress :createAddress="createAddress" />
                                <div class="detail_info ps-3 col-md-7">
                                    <div class="info_detail">
                                        <div class="">
                                            <h5>Thông tin bài đăng</h5>
                                        </div>
                                        <section class="ps-3">
                                            <div class="info-item">
                                                <div class="post_title">
                                                    Tiêu đề
                                                </div>
                                                <input type="text" name="" id="" class="input_item w-100">
                                            </div>
                                            <div class="info-item description">
                                                <div class="post_title">
                                                    Nội dung mô tả
                                                </div>
                                                <textarea name="" id="" class="w-100 input_item" cols="30" rows="8" ></textarea>
                                            </div>
                                            <div class="info-item contactInfo mb-3" v-for="attribute in postAttributes " :key="attribute.id">
                                                <div class="post_title">
                                                    {{attribute.name}}
                                                </div>
                                                 <div class="input_special d-flex justify-content-between align-items-center">
                                                    <input type="text" class="input_item" :placeholder="attribute.placeholder">
                                                    <div class="" v-if="attribute.unit!=''">{{attribute.unit}}</div>
                                                </div>
                                            </div>
                                            <AddPicture/>
                                        </section>
                                    </div>
                                </div>
                            </section>

                            <div class="btn_submit ps-2 d-flex justify-content-md-end justify-content-center">
                                <a href="addPost/next" class="button" @click="onCreatePost">Tiếp Theo</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 d-lg-block d-none mt-5 pt-5">
                        <div class="note_post">
                            <h3>Lưu ý khi đăng tin</h3>
                            <ul class="">
                                <li>Nội dung phải viết bằng Tiếng Việt, có dấu</li>
                                <li>Tiêu đề không dài quá 100 kí tự</li>
                                <li>Các bạn nên điền đầy đủ thông tin để tin có thể đạt hiểu suất nhanh</li>
                                <li>Để để tạo sự tin cậy các bạn nên đăng ảnh và video rõ ràng , địa chỉ cũ thể !</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <FooterComponentVue/>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'
import FooterComponentVue from '../../FooterComponent.vue'
import createAddress from '../View_ManagerUser/viewChildren/createAddress.vue'
import locationApi from '../../../Api/locationApi'

import Navbar from '../NavbarManagerUser.vue'
import Sidebar from '../Sidebar.vue'
import AddPicture from './viewChildren/addPictuere.vue'

export default defineComponent({
    name: "HomeManager",
    props(){
    },
    components: {
        Navbar,
        Sidebar,
        AddPicture,
        createAddress,
        FooterComponentVue
    },
    data() {
        const postAttributes = ref([]);
        const addressAttribuets = ref([])
        return {
            postAttributes,
            addressAttribuets,
            getCity : [],
            getDistrict: [],
            getWards: []
        }
    },
    mounted(){
        this.addDefaultAttribute()
    },
    methods:{
        addDefaultAttribute(){
            const defaultAttributes = [
                {
                    name: "Số Điện Thoại",
                    placeholder: "(+84)",
                    unit: "",
                },
                {
                    name: "Giá Cho Thuê",
                    placeholder: "Nhập đầy đủ các số, ví dụ 1 triệu thì nhập 1000000",
                    unit: "VND",
                },
                {
                    name: "Diện Tích",
                    placeholder: "15 m2",
                    unit: "m2",
                }
            ]
            this.postAttributes = defaultAttributes
        },

        onCreatePost(){
            // console.log(createAddress)
        },

        createAddress(address){
            console.log(address)
        }

    },
    created() {
    }
})
</script>

<style >
    .homeManager{
        display: flex;
    }

    .homeManager .ViewPost{
        padding-top: 50px;
        margin:30px;
    }

    .homeManager .ViewPost span{
        font-size: 15px;
    }

    .homeManager .ViewPost .title{
        color: var(--primary-color);
        font-weight: 600;
    }

    .homeManager .ViewPost .info .post_title{
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
        margin-top: 15px ;
        padding-left: 5px;
    }

    .homeManager .ViewPost .info .info-item{
        margin-top: 20px;
    }

    .homeManager .ViewPost .info .input_number_fulladdress .input_item,
    .homeManager .ViewPost .info .info_detail .input_item{
        width: 100%;
        padding: 5px;
        border: 1px solid rgb(162, 160, 160,0.5);
        border-radius: 2px;
    }

    .homeManager .ViewPost .info .info_detail .input_special .input_item{
        border: none;
        outline: none;
        width: 90%;
    }

    .homeManager .ViewPost .info .info_detail .input_special div {
        background-color: rgb(162, 160, 160,0.5);
        height: auto;
        padding: 4.6px 8px;
    }

    .homeManager .ViewPost .info .info_detail .input_special{
        width: 100%;
        min-width: auto;
        border: 1px solid rgb(162, 160, 160,0.5);
        border-radius: 2px;
        overflow: hidden;
    }

    .homeManager .ViewPost .btn_submit .button{
        width: 50%;
        background-color: var(--primary-color);
        padding: 8px;
        margin: 10px;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        border-radius: 4px;
        text-align: center;
        color: #fff;
    }

    .homeManager .ViewPost .note_post{
        padding: 10px;
        margin: 20px;
        background-color: #FFEC8B;
        color: #A0522D;
        font-size: 15px;
    }

    .homeManager .ViewPost .note_post ul li {
        list-style: square;
        font-size: 14px;
        line-height: 25px;
    }

    .homeManager .ViewPost .note_post h3{
        font-size: 18px;
    }

    @media (max-width: 768px) {
        .homeManager .ViewPost{
            padding-left: 5rem;
        }

        .homeManager .ViewPost .info .Address_detail select{
            width: 100%;
            padding: 5px;
            border: 1px solid rgb(162, 160, 160,0.5);
            border-radius: 2px;
        }

    }

</style>
