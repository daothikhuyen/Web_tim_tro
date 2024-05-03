<template>
    <div class="comment_rating">
        <div class="number_like_comment d-flex justify-content-between align-items-center px-2 my-2">
            <div class="number_like">
                <span>👍</span>
                <span> {{ numberLike }}</span>
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
            <div class="TreeFeedBack">
                <ListComment :tree-data="treeFeedback" :add="add"></ListComment>
            </div>
        </div>
        <div class="writeComment" :class="{ hide: showWriteComment }">
            <div class="d-flex align-items-center">
                <div v-for="user in users" :key="user.id" class="user_writeComment">
                    <div class="avatar_comment">
                        <img :src="user.avatar" alt="" class="avatar">
                    </div>
                </div>
                <AddComment :add="add" :postId="postId" :nodeData="1"></AddComment>
            </div>
        </div>
    </div>
</template>
<script>
import { ref, defineComponent } from 'vue'
import feedbackApi from "../../../Api/feedbackApi"
import ListComment from "./listComment/index.vue"
import userApi from "../../../Api/userApi"
import AddComment from "./AddComment.vue"
import { useDateFormat, useNow } from '@vueuse/core'

export default defineComponent({
    props: {
        postId: Number,
        numberLike: Number,
    },
    components: {
        ListComment,
        AddComment,
    },

    data() {
        const showWriteComment = ref(true)
        const feedBackData = ref([])
        return {
            showWriteComment,
            feedBackData,
            users: [],
            commentData: "",
            treeFeedback: [],

        }
    },
    created() {
        this.getComments()
        this.users = userApi.User();
    },
    methods: {
        getComments() {
            this.treeFeedback = feedbackApi.getFeedback(this.postId)
            console.log("this.treeFeedback", this.treeFeedback)
        },
        ShowWriteComment(index) {
            this.showWriteComment = false
            console.log(this.showWriteComment)
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
        add(postId, nodeData, commentData) {
            try {
                console.log(nodeData, nodeData === 0)
                const Hours = useDateFormat(useNow(), 'DD/MM/YYYY')
                const parent_id = 0 ? nodeData === 1 : nodeData.id_feedback
                const newComment = {
                    id_feedback: Math.floor(Math.random() * 1000),
                    username: this.users[0].username,
                    avatar: this.users[0].avatar,
                    post_id: postId,
                    content: commentData,
                    created_time: Hours,
                    parent_id: parent_id,
                    feedback: []
                };

                if (nodeData == 1) {
                    this.treeFeedback.push(newComment)
                }
                else {
                    nodeData.feedback.push(newComment)
                }

                this.showWriteComment = true

            } catch (error) {
                console.error("Error:", error);
            }
        },
    }

})
</script>
