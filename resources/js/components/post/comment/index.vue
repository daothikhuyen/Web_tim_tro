<template>
    <div class="comment_rating">
        <div class="number_like_comment d-flex justify-content-between align-items-center px-2 my-2">
            <div class="number_like">
                <span>👍</span>
                <span class="first_span_number_like"> {{ numberLike }}</span>
            </div>
            <div class="number_comment">
                <span class="first_span_number">{{treeFeedback.total_feedback}}</span>
                <span> Bình luận</span>
            </div>
        </div>
        <div
            class="comment_like border-bottom border-top d-flex justify-content-between align-items-center px-2 py-1 mb-3">
            <div class="like" @click.prevent="likePost(postId)">
                <span class="like_icon">
                    <i v-if="showIcon === false" class="bi bi-hand-thumbs-up me-1"></i>
                    <i v-else class="bi bi-hand-thumbs-up-fill" style="color: #ff5d26;"></i>
                </span>
                <span>Thích</span>
            </div>
            <div class="comment" @click="ShowWriteComment()">
                <i class="bi bi-chat-dots me-1"></i>
                <span>Bình luận</span>
            </div>
        </div>
        <div class="content_comment" ref="tree">
            <div class="TreeFeedBack">
                <ListComment :tree-data="treeFeedback.message" :add="add"></ListComment>
            </div>
        </div>

        <div class="writeComment" :class="{ hide: showWriteComment }">
            <div class="d-flex align-items-center">
                <AddComment :add="add" :postId="postId" :nodeData="1"></AddComment>
            </div>
        </div>
    </div>
</template>
<script>
import { ref, defineComponent } from 'vue'
import {mapGetters,mapActions} from 'vuex'
import { useDateFormat, useNow } from '@vueuse/core'
import Swal from 'sweetalert2'

import feedbackApi from "../../../Api/feedbackApi"
import rattig_api from "../../../Api/ratting_like"
import ListComment from "./listComment/index.vue"
import AddComment from "./AddComment.vue"


export default defineComponent({
    computed: {
        ...mapGetters(['authUser'])
    },
    props: {
        postId: Number,
        like: Array
    },
    components: {
        ListComment,
        AddComment,
    },
    data() {
        const showWriteComment = ref(true)
        const showIcon = ref(false)
        const feedBackData = ref([])
        const total_feedback = ref(null)
        const Ratting_likePost = ref([])
        const numberLike = ref(0)

        return {
            showWriteComment,
            showIcon,
            feedBackData,
            total_feedback,
            users: [],
            commentData: "",
            treeFeedback: [],
            Ratting_likePost,
            numberLike

        }
    },
    mounted(){
    },
    methods: {

        ShowWriteComment(index) {
            this.showWriteComment = false
        },

        addCommentToNode(feedBacks, parentId, newComment) {
            if (!feedBacks) {
                return feedBacks;
            }
            return feedBacks.map((feedBackChild) => {
                if (feedBackChild.id_feedback === parentId) {
                    feedBackChild.feedBack.push(newComment)

                    return feedBackChild
                }
                return addCommentToNode(feedBackChild.feedBack, parentId)
            })
        },

        async add(postId, nodeData, commentData) {

            if(this.authUser != null){

                try {
                    const Hours = useDateFormat(useNow(), 'DD/MM/YYYY')
                    const parent_id = ( nodeData === 1 ) ? 0: nodeData.id

                    console.log(parent_id)
                    const newComment = {
                        id: Math.ceil(Math.random()*10000),
                        user_id: this.authUser.id,
                        post_id: postId,
                        comment: commentData,
                        created_time: Hours,
                        parent_id: parent_id,
                        user: this.authUser,
                        feedback: []

                    };

                    const result = await feedbackApi.creatFeedback(newComment)

                    if(!result.error){
                        if (nodeData == 1) {
                            this.treeFeedback.message.push(newComment)
                        }
                        else {
                            nodeData.feedback.push(newComment)
                        }

                        this.treeFeedback.total_feedback = this.treeFeedback.total_feedback + 1

                        this.showWriteComment = true
                    }

                } catch (error) {
                    console.log(error)
                    console.error("Error:", error);
                }
            }else{
                Swal.fire({
                    title: "Thông Báo!",
                    text: "Vui lòng đăng nhập",
                    icon: "info",
                    confirmButtonText: "Đồng ý",
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$router.push('/login')
                    }

                });
            }

        },

        // Yêu thích
        async likePost(postId){

            if(this.authUser != null){
                const like = {
                    user_id : this.authUser.id,
                    post_id : postId,
                    like : true
                }
                const result = await rattig_api.createLikePost(like)

                if(!result.error){
                    this.showIcon = !this.showIcon
                    this.numberLike += result.status==="like" ? 1: -1
                }
            }else{
                    Swal.fire({
                    title: "Thông Báo!",
                    text: "Vui lòng đăng nhập",
                    icon: "info",
                    confirmButtonText: "Đồng ý",
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$router.push('/login')
                    }
                })
            }
        },

        async loadLike(){
            if(this.authUser != null){
                this.like.forEach(element => {

                    if(element.post_id == this.postId ){

                        this.numberLike = this.numberLike + 1;

                        if(element.user_id == this.authUser.id){
                            this.showIcon = !this.showIcon
                        }

                    }
                });
            }
        }
    },

    async created() {
        this.treeFeedback = await feedbackApi.getFeedback(this.postId)
        this.loadLike()
    },

})
</script>

<style scoped>

    .comment_like:hover span{
        cursor: pointer;
    }

</style>
