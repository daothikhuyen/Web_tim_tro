
<template>
    <div class="footer bg-white py-5">
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-1"></div> -->
                <div class="col-md-11 py-2 ms-2 d-flex justify-content-between align-items-center">
                    <div class="row w-100">
                        <div class="col-md-5">
                            <div class="info_footer">
                                <div class="logo_info">
                                    <img src="../../image/logo.png" alt="" class="w-100">
                                </div>
                                <span class="text-secondary">
                                    <b>PhongTot</b> <small>luôn tự tin mang đến cho người dùng <br>  các cơ hội tìm nhà tốt nhất.</small>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-7 d-flex justify-content-between align-content-center">
                            <div class="customer_support">
                                <span class="footer-col-title fw-semibold pb-3">Thông tin về PhongTot</span>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#" class="text-decoration-none text-black">Trang chủ</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-decoration-none text-black">Tin tức</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-decoration-none text-black">Quy chế hoạt động</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-decoration-none text-black">Chính sách bảo mật</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-decoration-none text-black">Liên hệ </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-decoration-none text-black">Quy định sử dụng</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="customer_support">
                                <span class="footer-col-title fw-semibold pb-3">Hỗ trợ khách hàng</span>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#" class="text-decoration-none text-black">Câu hỏi thường gặp</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-decoration-none text-black">Hướng dẫn đăng tin</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-decoration-none text-black">Quy định đăng tin</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-decoration-none text-black">Giải quyết khiếu nại</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="customer_support">
                                <span class="footer-col-title fw-semibold pb-3">Liên hệ với chúng tôi</span>
                                <div class="social-link mt-1">
                                    <a v-for="social in social_link" :key="social.id" :class="social.name" :href="social.link">
                                        <i></i>
                                    </a>
                                </div>

                                <span class="footer-col-title fw-semibold pt-3">Phương thức thanh toán</span>
                                <div class="social-link">
                                    <ul class="list-unstyled">
                                        <li>
                                            <a href="#" class="text-decoration-none text-black">Thanh toán bằng tiền mặt</a>
                                        </li>
                                        <li>
                                            <a href="#" class="text-decoration-none text-black">Thanh toán quét mã</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                social_link: [
                    {name: 'social-fa', link : 'https://www.facebook.com/groups/833843313788409/?hoisted_section_header_type=recently_seen&multi_permalinks=1822768544895876'},
                    {name: 'social-youtube', link : 'https://www.facebook.com/groups/833843313788409/?hoisted_section_header_type=recently_seen&multi_permalinks=1822768544895876'},
                    {name: 'social-instagram', link : 'https://www.facebook.com/groups/833843313788409/?hoisted_section_header_type=recently_seen&multi_permalinks=1822768544895876'},
                    {name: 'social-twitter', link : 'https://www.facebook.com/groups/833843313788409/?hoisted_section_header_type=recently_seen&multi_permalinks=1822768544895876'}
                ]
            }
        },
    }
</script>

<style>
    :root{
        --primary-color: #ff5d26
    }

    .footer{
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
    }

    .footer .info_footer .logo_info{
        width: 48%;
        height: auto;
    }

    .customer_support ul li{
        font-size: 14px;
    }

    .customer_support ul li a{
        margin: 3px 0;
        display: block;
        padding: 5px 0;
        color: #333;
    }

    .customer_support .footer-col-title{
        display: block;
        font-size: 13px;
    }

    .social-link a>i{
        margin-right: 5px;
        display: inline-block;
        width: 35px;
        height: 35px;
    }

    .social-link .social-fa i {
        background-image: url("../../image/icon_facebook.svg");
        display: inline-block;
        background-size: contain;
        background-repeat: no-repeat;
    }

    .social-link .social-youtube i {
        background-image: url("../../image/icon_youtube.svg");
        display: inline-block;
        background-size: contain;
        background-repeat: no-repeat;
    }

    .social-link .social-instagram i {
        background-image: url("../../image/Icon_of_Zalo.svg");
        display: inline-block;
        background-size: contain;
        background-repeat: no-repeat;
    }

    .social-link .social-twitter i{
        background-image: url("../../image/icon_twitter.svg");
        display: inline-block;
        background-size: contain;
        background-repeat: no-repeat;
    }

    @media (max-width: 768px) {
        .footer{
            position: sticky;
            z-index: 99;
        }

    }

</style>
