// HomeComponent.vue

<template>
    <div class="HomeComponent" >
        <navbar-component></navbar-component>
        <div class="view_home container-fluid mt-3" style="">
            <div class="row">
                <div class="col-md-2 d-flex align-items-center">
                    <div class="advertisement w-100">
                        <img class="w-100" src="../../image/advertisement/advertisement_01.png" alt="">
                    </div>
                </div>
                <div class="col-md-8 mt-3" >
                    <div class="header_search px-2 py-2 rounded-3 d-flex justify-content-between align-items-center" style="background-color:#C9C0BB">
                        <div class="category d-flex align-items-center border border-1 rounded-3 ps-3">
                            <span>
                                <i class="bi bi-house"></i>
                            </span>
                            <select class="form-select border-0 " aria-label="Default select example">
                                <option selected>Phòng trọ, nhà trọ</option>

                            </select>
                       </div>
                       <div class="location border border-1 rounded-3 ps-3">
                            <span>
                               <i class="bi bi-map"></i>
                            </span>
                            <select class="form-select border-0" aria-label="Default select example">
                                <option selected>Toàn quốc</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                       </div>
                       <div class="location border border-1 rounded-3 ps-3 bg-secondary-subtle" >
                            <span>
                               <i class="bi bi-geo-alt"></i>
                            </span>
                            <select class="form-select border-0" aria-label="Default select example" disabled>
                                <option selected>Tất cả</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                       </div>
                       <div class="search-info">

                            <button type="submit" class="btn-search ">
                                Tìm Kiếm
                                <span>
                                    <i class="bi bi-search"></i>
                                </span>
                            </button>
                       </div>
                    </div>

                    <div class="main_home py-3 mt-3">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="post px-2 py-3 bg-white rounded-3 mb-2" v-for="(listPost, index) in infoPost" :key="index">
                                    <div class="avatar_name d-flex align-items-center">
                                        <div class="avatar inline-block">
                                            <img :src="listPost.user.avatar"  alt="avatar" class="image_avatar_post" >
                                        </div>
                                        <div class="name px-2 fw-semibold">
                                            <span>{{listPost.user.username}}</span>
                                        </div>
                                    </div>
                                    <div class="info_post py-3">
                                        <section class="header">
                                            <h6 class="title">{{ listPost.postData.title }}</h6>
                                            <span class="info_price_arceage px-2">
                                                <span class="price">{{ listPost.postData.price }}</span>
                                                <span class="arceage"> - {{listPost.postData.arceage}}m<sup>2</sup> </span>
                                            </span>
                                        </section>
                                        <div class="address">
                                            <i class="bi bi-geo-alt"></i>
                                            <span>{{listPost.postData.full_address}}</span>
                                        </div>
                                        <div class="description p-2">
                                            <span class="title">Mô tả chi tiết:</span> <br>
                                            <span >
                                                <span class="ps-2 content" id="descriptionContent">
                                                    {{ listPost.postData.description.substring(0, 500) }}
                                                </span>
                                                <span class="description_etc hide">...</span>
                                            </span>

                                            <span class="btn-action hide">
                                                <div class=" my-2 border-top py-2 d-flex justify-content-center">
                                                    <button class="btn-SeeMore" @click="SeeMoreDescription(index)">Xem thêm <i class="bi bi-arrow-down-square"></i> </button>
                                                    <button class="btn-short hide" @click="ShortDescription(index)">Rút gọn <i class="bi bi-arrow-up-square"></i></button>
                                                </div>
                                            </span>
                                        </div>
                                        <div class="post_image mt-2 px-2 py-1">
                                            <div class="swiper">
                                                <Carousel class="swiper-wrapper">
                                                    <Slide v-for="slide in listPost.images" :key="slide.id" class="swiper-slide">
                                                        <img :src="slide.image" alt="" class="carousel__item">
                                                    </Slide>
                                                    <template #addons>
                                                        <Navigation />
                                                        <Pagination />
                                                    </template>
                                                </Carousel>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment_rating">
                                        <div class="number_like_comment d-flex justify-content-between align-items-center px-2 my-2">
                                            <div class="number_like">
                                                <span>👍</span>
                                                <span> {{listPost.postData.number_like}}</span>
                                            </div>
                                            <div class="number_comment">
                                                <span>123</span>
                                                <span> Bình luận</span>
                                            </div>
                                        </div>
                                        <div class="comment_like border-bottom border-top d-flex justify-content-between align-items-center px-2 py-1 mb-3">
                                            <div class="like ">
                                                <i class="bi bi-hand-thumbs-up me-1"></i>
                                                <span>Thích</span>
                                            </div>
                                            <div class="comment">
                                                <i class="bi bi-chat-dots me-1"></i>
                                                <span>Bình luận</span>
                                            </div>
                                        </div>
                                        <div class="content_comment" ref="tree">

                                            <div v-for="treeFeedback in treeFeedback" :key="treeFeedback.id" >
                                                <!-- <tree-feed-back :tree-data="filterFeedBackData( listPost.postData.id)"></tree-feed-back> -->
                                                <tree-feed-back :tree-data="filterFeedBackData( listPost.postData.id)"></tree-feed-back>
                                            </div>

                                        </div>
                                        <div class="writeComment">
                                            <div class="d-flex align-items-center">
                                                <div v-for="user in user" :key="user.id" class="user_writeComment">
                                                    <div class="avatar_comment">
                                                        <img :src="user.avatar" alt="" class="avatar">
                                                    </div>
                                                </div>
                                                <div class="content_writeComment" >
                                                    <form action="" class="fromSubmitComment" @submit.prevent="AddComment(listPost.postData.id, 0, index, $event)"  >
                                                        <input type="text" class="inputComment w-100" v-model="commentData" placeholder="Viết bình luận..." ref="input">
                                                        <button class="btn_send" type="submit">
                                                                <i class="bi bi-send-fill" style="color:#ea4e27 "></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4 float-md-start">
                                <div class="search-price w-100">
                                    <h6>Lọc Theo Giá Thuê</h6>

                                    <ul class="list-group list-group-search list-group-flush">
                                        <li class="list-group-item list-group-item-action" >
                                            <a href="" class="text-decoration-none">Dưới 2 triệu</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action" >
                                            <a href="" class="text-decoration-none">A second ite</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action" >
                                            <a href="" class="text-decoration-none">A second ite</a>
                                        </li>

                                    </ul>
                                </div>

                                <div class="search-acreage w-100">
                                    <h6>Lọc Theo Diện Tích</h6>

                                    <ul class="list-group list-group-search list-group-flush">
                                        <li class="list-group-item list-group-item-action" >
                                            <a href="" class="text-decoration-none">Dưới 2 triệu</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action" >
                                            <a href="" class="text-decoration-none">Dưới 2 triệu</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action" >
                                            <a href="" class="text-decoration-none">Dưới 2 triệu</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 d-flex justify-content-center align-items-center">
                    <div class="advertisement w-100 ">
                        <img class="w-100" src="../../image/advertisement/advertisement_01.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import userApi from "../Api/userApi"
    import postApi from "../Api/postApi"
    import imageApi from "../Api/imageApi"
    import feedback from "../Api/feedbackApi"

    import { ref,onMounted,onUnmounted, defineComponent } from 'vue'
    import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
    import { useDateFormat, useNow } from '@vueuse/core'
    import 'vue3-carousel/dist/carousel.css'
    import NavbarComponent from './NavbarComponent.vue'
    import TreeFeedBack from './Recursive/FeedbackTree.vue'

    export default defineComponent(
    {
        name: "HomeComponent",
        //gán kết vào vòng đời của DOM , component đã được render
        mounted() {
            console.log('Component mounted.')
            this.customDescription()

        },
        data(){
            const commentData = ref(null)
            return {
                infoPost : [],
                imagePost : [],
                user : [],
                treeFeedback:[],
                commentData


            }
        },
        methods: {

            customDescription(){
                const descriptionEtc = document.querySelectorAll('.description_etc')
                const btnAction = document.querySelectorAll('.btn-action')
                const btnLong = document.querySelectorAll('.btn-SeeMore')
                const btnShort = document.querySelectorAll('.btn-short')
               this.infoPost.forEach((element,index) => {
                    if(element.postData.description.length > 500){
                        descriptionEtc[index].classList.remove('hide')
                        btnAction[index].classList.remove('hide')
                    }
               });
            },

            SeeMoreDescription(index){
                const description = document.querySelectorAll('.description .content')
                const btnLong = document.querySelectorAll('.btn-SeeMore')
                const btnShort = document.querySelectorAll('.btn-short')
                this.infoPost.forEach((element,i) => {
                    if(i == index){
                        description[index].innerHTML = element.postData.description
                        btnLong[index].classList.add('hide')
                        btnShort[index].classList.remove('hide')
                    }
               });
            },

            ShortDescription(index){
                 const description = document.querySelectorAll('.description .content')
                 const btnLong = document.querySelectorAll('.btn-long')
                const btnShort = document.querySelectorAll('.btn-short')
                this.infoPost.forEach((element,i) => {
                    if(i == index){
                        description[index].innerHTML = element.postData.description.substring(0,500)
                        btnLong[index].classList.remove('hide')
                        btnShort[index].classList.add('hide')
                    }
               });
            },

            // Filter comments by post
            filterFeedBackData(post_id){
                return this.treeFeedback.feedback.filter(item => item.post_id === post_id)
            },

            // Send comment
            AddComment(postId, parentId,index, event) {
                try {
                    event.preventDefault();

                    const Hours = useDateFormat(useNow(),'DD/MM/YYYY')
                    const newComment = {
                        id: Math.floor(Math.random() * 1000),
                        username: this.user[0].username,
                        avatar: this.user[0].avatar,
                        post_id: postId,
                        content: this.commentData,
                        created_time: Hours,
                        parent_id: parentId,
                        feedback: []
                    };

                    this.treeFeedback.feedback.push(newComment);
                    this.commentData= '';
                } catch (error) {
                    console.error("Error:", error);
                }
            },

        },
        computed : {

        },
        components:{
            NavbarComponent,
            Carousel,
            Slide,
            Pagination,
            Navigation,
            TreeFeedBack
        },
        created() {
            this.infoPost = postApi.listPost(),
            this.imagePost = imageApi.imagePost(),
            this.user = userApi.User();
            this.treeFeedback = feedback.feedback()
        }
    }
)


</script>

<style scoped>


</style>
