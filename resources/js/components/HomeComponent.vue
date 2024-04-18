// HomeComponent.vue

<template>
    <div class="HomeComponent">
        <navbar-component></navbar-component>
        <div class="view_home container-fluid mt-3" style="">
            <div class="row">
                <div class="col-md-2 d-flex align-items-center">
                    <div class="advertisement w-100">
                        <img class="w-100" src="../../image/advertisement/advertisement_01.png" alt="">
                    </div>
                </div>
                <div class="col-md-8 mt-3">
                    <div class="header_search px-2 py-2 rounded-3 d-flex justify-content-between align-items-center"
                        style="background-color:#C9C0BB">
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
                        <div class="location border border-1 rounded-3 ps-3 bg-secondary-subtle">
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

import { ref, defineComponent } from 'vue'
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
            this.infoPost = postApi.listPost(),
            this.imagePost = imageApi.imagePost(),
            this.user = userApi.User();
        }
    }
)


</script>

<style scoped></style>
