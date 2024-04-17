<template>
    <div>
        <div class="post px-2 py-3 bg-white rounded-3 mb-2" v-for="(listPost, index) in infoPost" :key="index">
            <Poster :user=listPost.user></Poster>
            <PostContent :postData="listPost.postData" :images="listPost.images"></PostContent>
            <div class="comment_rating">
                <div class="number_like_comment d-flex justify-content-between align-items-center px-2 my-2">
                    <div class="number_like">
                        <span>👍</span>
                        <span> {{ listPost.postData.number_like }}</span>
                    </div>
                    <div class="number_comment">
                        <span>123</span>
                        <span> Bình luận</span>
                    </div>
                </div>
                <div
                    class="comment_like border-bottom border-top d-flex justify-content-between align-items-center px-2 py-1 mb-3">
                    <div class="like ">
                        <i class="bi bi-hand-thumbs-up me-1"></i>
                        <span>Thích</span>
                    </div>
                    <div class="comment" @click="ShowWriteComment()">
                        <i class="bi bi-chat-dots me-1"></i>
                        <span>Bình luận</span>
                    </div>
                </div>
                <div class="content_comment" ref="tree">
                    <div v-for="treeFeedback in treeFeedback" :key="treeFeedback.id">
                        <div class="TreeFeedBack">
                            <tree-feed-back :tree-data="filterFeedBackData(listPost.postData.id)"></tree-feed-back>
                        </div>
                    </div>
                </div>
                <div class="writeComment" :class="{hide : showWriteComment}">
                    <div class="d-flex align-items-center">
                        <div v-for="user in user" :key="user.id" class="user_writeComment">
                            <div class="avatar_comment">
                                <img :src="user.avatar" alt="" class="avatar">
                            </div>
                        </div>
                        <div class="content_writeComment">
                            <form action="" class="fromSubmitComment"
                                @submit.prevent="AddComment(listPost.postData.id, 0, index, $event)">
                                <input type="text" class="inputComment w-100" v-model="commentData"
                                    placeholder="Viết bình luận..." ref="input">
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
</template>

<script>

import { ref, defineComponent } from 'vue'
import { useDateFormat, useNow } from '@vueuse/core'

import userApi from "../../Api/userApi"
import postApi from "../../Api/postApi"
import imageApi from "../../Api/imageApi"
import feedbackApi from "../../Api/feedbackApi"

import Poster from "./Poster.vue"
import PostContent from "./Content.vue"
import TreeFeedBack from '../Recursive/FeedbackTree.vue'

export default defineComponent(
    {
        name: "HomeComponent",
        components: {
            Poster,
            PostContent,
            TreeFeedBack,

        },
        data() {
            const commentData = ref(null)
            const showWriteComment = ref(true)
            return {
                infoPost: [],
                imagePost: [],
                user: [],
                treeFeedback: [],
                commentData,
                showWriteComment
            }
        },
        methods: {
            // Filter comments by post
            filterFeedBackData(post_id) {
                return this.treeFeedback.feedback.filter(item => item.post_id === post_id)
            },

            ShowWriteComment(index){
                this.showWriteComment = false
                console.log(this.showWriteComment)
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
            this.treeFeedback = feedbackApi.feedback()
        }
    }
)


</script>
