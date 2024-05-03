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
                            <div class="p-2 ps-3 mx-2 rounded-3 w-100" style="background-color: rgb(162, 160, 160,0.25)">
                                <span class="title">PhongTot</span> / <span class="title">Quản lí </span>/ <span>Đăng tin mới</span>
                            </div>
                            <section class="seeBefore m-2">
                                <div class="seeItem">
                                    <Poster :user="newPost[0].user"></Poster>
                                    <PostContent :postData="newPost[0].postData" :images="newPost[0].images"></PostContent>
                                </div>
                            </section>

                            <div class="btn_submit ps-2 d-flex justify-content-md-end justify-content-center">
                                <a href="listpost/see" class="button">Đăng Bài</a>
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
import userApi from '../../../../Api/userApi'
import FooterComponentVue from '../../../FooterComponent.vue'

import Poster from "../../../post/Poster.vue"
import PostContent from "../../../post/Content.vue"
import Comment from '../../../post/comment/index.vue'

import Navbar from '../../NavbarManagerUser.vue'
import Sidebar from '../../Sidebar.vue'

export default defineComponent({
    name: "HomeManager",
    components: {
        Navbar,
        Sidebar,
        FooterComponentVue,
        Poster,
        PostContent,
        Comment,
    },
    data() {
        const newPost = [
            {
                user : {
                    id: 1,
                    username: "Khuyên Khuyên",
                    password: "123456",
                    email: "daothikhuyen30@gmail.com",
                    phone: "0835667553",
                    avatar: 'http://localhost/Lavarel_Vuejs_project/Web_tim_phong_project/resources/image/avatar/35974153931cc138a337256ce086e9f1.jpg'
                },
                postData: {
                    id: 1,
                    title: "Phòng full nt ở Bùi Đình Tuý Bình Thạnh",
                    description: `
                    Phòng cho thuê cao cấp - Oledo maison
                    Giá chỉ: 2.5 triệu/ tháng - Diện tích: 25m2

                    Một không gian sống văn minh, trong lành, yên tĩnh, an ninh trong lòng TP, với đầy đủ tiện nghi, không chung chủ và tự do về giờ giấc
                    - Địa chỉ: Đường Tôn Đản - TP Đà Nẵng
                    + Vị trí nằm trong TTTP, chỉ với 5p đến Bến xe Trung Tâm, gần cầu vượt ngã ba Huế hiện đại nút giao thông Điện Biên Phủ – Tôn Đức Thắng - Trường Chinh, 10-15p đến Coop mart, Sân Bay Quốc tế ĐN, ĐH Duy Tân, Bách Khoa, Sư Phạm, Big C, Bến xe, Ga tàu,...
                    + Hẻm dân cư rộng 3m
                    * Đầy đủ tiện nghi thoải mái
                    - Camera, hệ thống điều hòa, nóng lạnh, truyền hình cáp quang FPT, Wifi tốc độ cao, bãi để xe rộng rãi, sân phơi, sân sinh hoạt chung, hệ thống điện nước âm tường, trần đóng thạch cao, đồng hồ điện nước riêng.
                    - Có gác lửng đúc, WC, bếp sạch sẽ, sang trọng
                    * Giá thuê hấp dẫn bất ngờ chỉ từ 2.5trđ - 2.9trđ/ tháng
                    * Thời gian thuận tiện liên hệ xem phòng: 13h - 17h (thứ 7 và CN). Hoặc sau 19h hàng ngày
                    * Gọi ngay cho tôi Mr Thành: ***
                    + Mail: phuocthanh85@gmail.com`,
                    full_address: " Đường Tôn Đản - TP Đà Nẵng",
                    price: "2,5 triệu/tháng",
                    arceage:25,
                    user_id: 1,
                    category_id:1,
                    number_like: 13

                },
                images :[
                    {
                        id: 1,
                        image: 'https://cloud.mogi.vn/images/2024/03/29/570/3c707d8330004321b870d719942f2db1.jpg',
                        post_id: 1
                    },
                    {
                        id: 2,
                        image: 'https://cloud.mogi.vn/images/2024/03/29/571/7f61404c62a6412ca109ff5beceaff55.jpg',
                        post_id: 1
                    }
                ]

            }
        ]

        console.log(newPost[0]);

        return {
            newPost
        }
    },
    mounted(){
    },
    methods:{

    },
    created(){
        
    }
})
</script>

<style scoped>
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
        font-weight: 700;
        margin-bottom: 8px;
        margin-top: 15px ;
        padding-left: 5px;
    }

    .homeManager .ViewPost .info .info-item{
        margin-top: 20px;
    }

    .homeManager .ViewPost .info .Address_detail select{
        width: 100%;
        padding: 5px;
        border: 1px solid rgb(162, 160, 160,0.5);
        border-radius: 2px;
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
        width: 100%;
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
