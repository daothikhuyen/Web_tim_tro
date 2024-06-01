<template>
    <div>
        <div class="post px-2 py-3 bg-white rounded-3 mb-2" v-for="(listPost, index) in getAllPosts" :key="index">
    
            <Poster :user="listPost.user" :created_at="listPost.postData.created_at"></Poster>
            <PostContent :postData="listPost.postData" :images="listPost.images" :extensions="listPost.extensions" :videos="listPost.videos"></PostContent>
            <Comment :postId="listPost.postData.id" :numberLike="listPost.postData.number_like"></Comment>
        </div>
    </div>
</template>

<script>

import { ref, defineComponent } from 'vue'
import {mapState,mapActions} from 'vuex'

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
        computed:{
            ...mapState(['getAllPosts'])
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
            this.$store.dispatch('getPosts')
            // this.infoPost = postApi.listPost(),
            // this.imagePost = imageApi.imagePost(),
            // this.user = userApi.User();
            // this.treeFeedback = feedbackApi.getFeedback()
        }
    }
)


</script>
