<template>
    <li class="content_feedback">
        <div class="show_writeComment d-flex" :id="nodeData.id_feedback">
            <div class="avatar_name d-flex ">
                <div class="avatar inline-block">
                    <img v-if="nodeData.avatar != null" :src="nodeData.avatar" alt="avatar" class="image_avatar_feedback">
                    <img v-else src="https://static.vecteezy.com/system/resources/thumbnails/005/129/844/small_2x/profile-user-icon-isolated-on-white-background-eps10-free-vector.jpg" alt="avatar" class="image_avatar_feedback">
                </div>
            </div>
            <div class="NameAndFeedback w-100 pe-3">
                <div class="node-tree d-flex align-items-center mb-1">
                    <div class="name px-2">
                        <div class="px-2 py-1 rounded-3" style=" background-color: rgb(119, 119, 119,0.10);">
                            <div class="fw-semibold">{{ nodeData.username }}</div>
                            <div class="show_content_feedback">
                                <div class="content">
                                    {{ nodeData.content }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="TimeAndReply ps-3">
                    <div class="d-flex mt-1 ms-1">
                        <div class="created_time">
                            {{ nodeData.created_time }}
                        </div>
                        <div class="reply ps-4" @click.prevent="">
                           Thích
                        </div>
                        <div class="reply ps-4" @click.prevent="relpyComment()">
                            Trả lời
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul v-if="nodeData.feedback && nodeData.feedback.length ">
            <FeedBackNode v-for="childNodeData in childCommentData"  :key="childNodeData.id" :nodeData="childNodeData" :add="add"></FeedBackNode>
        </ul>

    </li>
    <div class="writeComment" :class="{hide : !showReply}">
        <div class="d-flex align-items-center">
            <div v-for="user in user" :key="user.id" class="user_writeComment">
                <div class="avatar_comment">
                    <img :src="user.avatar" alt="" class="avatar">
                </div>
            </div>
            <AddComment :add="add" :postId="nodeData.post_id" :nodeData="nodeData" :showReply="showReply"></AddComment>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'

import userApi from '../../../../Api/userApi'
import AddComment from '../AddComment.vue'

export default defineComponent ({
    name: "FeedBackNode",
    props: {
        nodeData: Array,
        add: Function,
    },
    components:{
        AddComment,
    },
    data() {
        const commentData = ref(null)
        const showReply = ref(false)
        return {
            user: [],
            treeFeedback: [],
            showReply,
            commentData
        }
    },
    methods: {
        relpyComment(index){
            this.showReply = true
        },

    },
    computed: {
        childCommentData(){
            console.log("this.nodeData.feedback", this.nodeData.feedback)
            return this.nodeData.feedback;
        }
    },
    created() {
        this.user = userApi.User()
        console.log("niode", this.nodeData)
    },
})
</script>

<style scoped>
.writeComment {
    border:none;
    box-shadow: none;
    padding-top: 10px;
    margin: 0 0 20px 0px;
}

.writeComment .content_writeComment{
    width: 95%;
    height: auto;
    max-height: 70px;
    overflow-y: auto;
}

.writeComment .content_writeComment .fromSubmitComment{
    display: flex;
    align-items: center;
    margin-left: 15px;
    background-color: rgb(119, 119, 119,0.20);
    padding: 10px 5px 10px 20px;
    border-radius: 10px;

}

.TimeAndReply .reply{
    cursor: pointer;
}


</style>
