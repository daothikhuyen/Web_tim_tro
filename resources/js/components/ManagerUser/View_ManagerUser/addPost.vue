// view wirte post

<template>
    <div class="container-fluid px-0 bg-white h-100">
        <navbar/>
        <div class="homeManager ">
            <sidebar/>
            <div class="ViewPost w-100">
                <div class="row">
                    <div class="col-md-9">
                        <form action="">
                            <div class="bg-secondary-subtle p-2 ps-3 w-100">
                                <span class="title">PhongTot</span> / <span class="title">Quản lí </span>/ <span>Đăng tin mới</span>
                            </div>
                            <div class="pt-4">
                                <h5 class="ps-3">Đăng Tin Mới</h5>
                                <hr>
                            </div>
                            <div class="error">

                            </div>
                            <section class="info px-3 py-3">
                                <div class="address">
                                    <div class="">
                                        <h5>Địa chỉ cho thuê</h5>
                                    </div>
                                    <section class="Address_detail d-lg-flex  d-md-block align-items-center justify-content-between ps-3">
                                        <div class="province">
                                            <div class="post_title">Tỉnh/Thành phố</div>
                                            <select name="" id="">
                                                <option value="" selected disabled>--Chọn Tỉnh/Tp--</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="district">
                                            <div class="post_title">Quận/Huyện</div>
                                            <select name="" id="">
                                                <option value="" selected disabled>--Chọn Quận/Huyện --</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="wards">
                                            <div class="post_title">Phường/Xã</div>
                                            <select name="" id="">
                                                <option value="" selected disabled>--Chọn Phường/Xã --</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="road">
                                            <div class="post_title">Đường Phố</div>
                                            <select name="" id="">
                                                <option value="" selected disabled>--Chọn Đường/Phố --</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </section>
                                    <div class="input_number_fulladdress">
                                        <div class="number_house ps-3">
                                            <div class="post_title">Số Nhà</div>
                                           <input type="text" name="" id="" class="w-100 input_item">
                                        </div>
                                        <div class="info-item full_address ps-3">
                                            <div class="post_title">Địa chỉ đầy đủ</div>
                                            <input type="text" name="" id="" class="w-100 input_item">
                                        </div>
                                    </div>
                                    <div class="info_detail">
                                        <div class="main_title">
                                            <h5>Thông tin mô tả</h5>
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
                                            <div class="info-item contactInfo">
                                                <div class="post_title">
                                                    Thông tin liên hệ
                                                </div>
                                                <input type="text" class="input_item" placeholder="(+84)">
                                            </div>
                                            <div class="info-item price">
                                                <div class="post_title">
                                                    Giá cho thuê
                                                </div>
                                                <div class="input_special d-flex justify-content-between align-items-center">
                                                    <input type="text" class="input_item">
                                                    <div class="">VNĐ</div>
                                                </div>
                                                <span class="ps-2 text-secondary">
                                                    <small>Nhập đầy đủ các số, ví dụ 1 triệu thì nhập 1000000</small>
                                                </span>
                                            </div>
                                            <div class="info-item acreage">
                                                <div class="post_title">
                                                    Diện tích
                                                </div>
                                                <div class="input_special d-flex justify-content-between align-items-center">
                                                    <input type="text" class="input_item">
                                                    <div class="">m<sup>2</sup></div>
                                                </div>
                                            </div>
                                            <div class="info-item object">
                                                <div class="post_title">
                                                    Đối tượng
                                                </div>
                                                <select name="" id="" class="input_item ">
                                                    <option value="all" selected disabled>--Tất cả--</option>
                                                </select>
                                            </div>
                                            <div class="info-item image">
                                                <div class="main_title">
                                                    <h5>Hình Ảnh</h5>
                                                </div>
                                                <div class="post_title">
                                                    Cập nhật hình ảnh rõ ràng sẽ cho thuê nhanh hơn
                                                </div>
                                                <div class="upload_image">
                                                    <div class="imagePreviewWrapper">
                                                        <img src="../../../../image/device/camera.png" alt="">
                                                        <div>Thêm ảnh</div>
                                                    </div>
                                                    <div class="rightRound" id="upload">
                                                        <input type="file" ref="fileInput" @input="pickFile">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="info-item video">
                                                <div class="main_title">
                                                    <h5>Video</h5>
                                                </div>
                                                <div class="post_title">
                                                    Upload video của bạn
                                                </div>
                                                <div class="upload_image">
                                                    <div class="imagePreviewWrapper">
                                                        <img src="../../../../image/device/video.png" alt="">
                                                        <div>Thêm video</div>
                                                    </div>
                                                    <div class="rightRound" id="upload">
                                                        <input type="file" ref="fileInput" @input="pickFile">
                                                    </div>
                                                </div>
                                            </div>

                                        </section>
                                    </div>
                                </div>
                            </section>

                            <div class="btn_submit d-flex justify-content-center ps-2">
                                <button>Đăng Bài</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <div class="note_post d-sm-none">
                            <h3>Lưu ý khi đăng tin</h3>
                            <ul>
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
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'

import Navbar from '../NavbarManagerUser.vue'
import Sidebar from '../Sidebar.vue'

export default defineComponent({
    name: "HomeManager",
    components: {
        Navbar,
        Sidebar
    }
})
</script>

<style scoped>
    .homeManager{
        display: flex;
    }

    .homeManager .ViewPost{
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

    .homeManager .ViewPost .info .main_title{
        margin: 40px 0 0px 0;
    }

    .homeManager .ViewPost .info .Address_detail select{
        width: 230px;
        padding: 5px;
        border: 1px solid rgb(162, 160, 160,0.5);
        border-radius: 2px;
    }

    @media (max-width: 1600px) {
        .homeManager .ViewPost .info .Address_detail select{
            width: 200px;
            padding: 5px;
            border: 1px solid rgb(162, 160, 160,0.5);
            border-radius: 2px;
        }

    }

    .homeManager .ViewPost .info .input_number_fulladdress .input_item,
    .homeManager .ViewPost .info .info_detail .input_item{
        width: 50%;
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
        width: 50%;
        min-width: auto;
        border: 1px solid rgb(162, 160, 160,0.5);
        border-radius: 2px;
        overflow: hidden;
    }

    .homeManager .ViewPost .info .info_detail .upload_image{
        height: 250px;
        border:  1px dashed rgb(162, 160, 160,0.5);
        border-radius: 2px ;
        text-align: center;
        margin: auto;
        position: relative;
    }

    .homeManager .ViewPost .info .info_detail .upload_image .rightRound{
        position: absolute;
        margin: 5px;
        bottom: 16px;
        left: 20px;
        text-align: center;
        width: 99%;
        height: 95%;
        overflow: hidden;
        line-height: 33px;
        cursor: pointer;
    }

    .homeManager .ViewPost .info .info_detail .upload_image img{
        height: 100px;
        text-align: center;
        object-fit: cover;
        object-position: center;
        margin-top: 60px;
    }

    .homeManager .ViewPost .info .info_detail .upload_image input[type='file']{
        position: absolute;
        transform: scale(10);
        opacity: 0;
    }

    .homeManager .ViewPost .btn_submit button{
        width: 96%;
        background-color: var(--primary-color);
        padding: 8px;
        margin: 10px;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        border-radius: 2px;
        text-align: center;
        color: #fff;
    }

    .homeManager .ViewPost .note_post{
        padding: 10px;
        margin-top: 20px;
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
            padding-left: 36px;
        }

        .homeManager .ViewPost .info .Address_detail select{
            width: 60%;
            padding: 5px;
            border: 1px solid rgb(162, 160, 160,0.5);
            border-radius: 2px;
        }

    }

    /* .homeManager .ViewPost .info .Address_detail{
        display: ;
    } */

</style>
