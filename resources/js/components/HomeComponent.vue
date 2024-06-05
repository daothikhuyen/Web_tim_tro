// HomeComponent.vue

<template>
    <div class="HomeComponent">
        <navbar-component></navbar-component>
        <div class="view_home container-fluid mt-3" style="">
            <div class="row">
                <div class="col-lg-2 advertise">
                    <div class="advertisement w-100">
                        <img class="w-100" src="../../image/advertisement/advertisement_01.png" alt="">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 view_main mt-3">
                    <div class="row header_search px-2 py-2 rounded-3" style="background-color:#C9C0BB">
                        <div class="col-lg-3 category">
                            <div class="search_item">
                                <span class="icon_default">
                                <i class="bi bi-house"></i>
                            </span>
                            <span class="">
                                <div class="ps-3 select">Phòng trọ, nhà trọ</div>
                            </span>
                            <!-- <span>
                                <i class="fa-solid fa-xmark"></i>
                            </span> -->
                            </div>
                        </div>
                        <div class="col-lg-3 location">
                            <div class="search_item">
                                <span class="icon_default">
                                    <i class="bi bi-map"></i>
                                </span>
                                <span>
                                    <select class="form-select border-0" aria-label="Default select example">
                                        <option selected>Đà Nẵng</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-3 location">
                            <div class="search_item">
                                <span class="icon_default">
                                    <i class="bi bi-cash-coin"></i>
                                </span>
                                <span>
                                    <select class="form-select border-0" aria-label="Default select example">
                                        <option selected>Chọn giá</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-3 location">
                            <div class="search_item">
                                <span class="icon_default">
                                    <i class="bi bi-rulers"></i>
                                </span>
                                <span>
                                    <select class="form-select border-0" aria-label="Default select example">
                                        <option selected>Chọn diện tích</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="main_home py-3 mt-3">
                        <div class="row">
                            <div class="col-md-8 postcomponet">
                                <PostComponent></PostComponent>
                            </div>
                            <div class="col-md-4 float-md-start">
                                <div class="search-price w-100">
                                    <h6>Lọc Theo Giá Thuê</h6>

                                    <ul class="list-group list-group-search list-group-flush">
                                        <li class="list-group-item list-group-item-action">
                                            <a href="" class="text-decoration-none">Dưới 2 triệu</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action">
                                            <a href="" class="text-decoration-none">A second ite</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action">
                                            <a href="" class="text-decoration-none">A second ite</a>
                                        </li>

                                    </ul>
                                </div>

                                <div class="search-acreage w-100">
                                    <h6>Lọc Theo Diện Tích</h6>

                                    <ul class="list-group list-group-search list-group-flush">
                                        <li class="list-group-item list-group-item-action">
                                            <a href="" class="text-decoration-none">Dưới 2 triệu</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action">
                                            <a href="" class="text-decoration-none">Dưới 2 triệu</a>
                                        </li>
                                        <li class="list-group-item list-group-item-action">
                                            <a href="" class="text-decoration-none">Dưới 2 triệu</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 advertise">
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
import feedback from "../Api/feedbackApi"

import { ref, defineComponent, onMounted } from 'vue'
import { useDateFormat, useNow } from '@vueuse/core'
import NavbarComponent from './NavbarComponent.vue'

import PostComponent from './post/index.vue'

export default defineComponent(
    {
        name: "HomeComponent",
        components: {
            NavbarComponent,
            PostComponent,
        },
        data() {
            const commentData = ref(null)

            return {
                infoPost: [],
                imagePost: [],
                user: [],
                treeFeedback: [],
                commentData,
            }
        },
        methods: {

            checkUser(){
                axios.post('checkSession')
            },

            filterFeedBackData(post_id) {
                return this.treeFeedback.feedback.filter(item => item.post_id === post_id)
            },

            // Send comment
            AddComment(postId, parentId, index, event) {
                try {
                    event.preventDefault();

                    const Hours = useDateFormat(useNow(), 'DD/MM/YYYY')
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
                    this.commentData = '';
                } catch (error) {
                    console.error("Error:", error);
                }
            },

        },
        created() {
            this.infoPost = postApi.listPost()
        }
    }
)


</script>

<style scoped></style>
