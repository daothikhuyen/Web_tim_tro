<template>
    <div>
        <div class="post px-2 py-3 bg-white rounded-3 mb-2" v-for="(listPost, index) in infoPost" :key="index">
            <Poster :user=listPost.user></Poster>
            <PostContent :postData="listPost.postData" :images="listPost.images"></PostContent>
            <Comment :postId="listPost.postData.id" :numberLike="listPost.postData.number_like"></Comment>
        </div>
    </div>
</template>

<script>

import { ref, defineComponent } from 'vue'

import userApi from "../../Api/userApi"
import postApi from "../../Api/postApi"
import imageApi from "../../Api/imageApi"
import feedbackApi from "../../Api/feedbackApi"

import Poster from "./Poster.vue"
import PostContent from "./Content.vue"
import Comment from './comment/index.vue'

export default defineComponent(
    {
        name: "HomeComponent",
        components: {
            Poster,
            PostContent,
            Comment,

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

                      

        },
        created() {
            this.infoPost = postApi.listPost(),
            this.imagePost = imageApi.imagePost(),
            this.user = userApi.User();
            this.treeFeedback = feedbackApi.getFeedback()
        }
    }
)


</script>
