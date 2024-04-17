<template>
    <li class="content_feedback">
        <div class="show_writeComment d-flex" :id="node.id_feedback">
            <div class="avatar_name d-flex ">
                <div class="avatar inline-block">
                    <img :src="node.avatar" alt="avatar" class="image_avatar_feedback">
                </div>
            </div>
            <div class="NameAndFeedback w-100 pe-3">
                <div class="node-tree d-flex align-items-center mb-1">
                    <div class="name px-2">
                        <div class="px-2 py-1 rounded-3" style=" background-color: rgb(119, 119, 119,0.10);">
                            <div class="fw-semibold">{{ node.username }}</div>
                            <div class="show_content_feedback">
                                <div class="content">
                                    {{ node.content }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="TimeAndReply ps-3">
                    <div class="d-flex mt-1 ms-1">
                        <div class="created_time">
                            {{ node.created_time }}
                        </div>
                        <div class="reply ps-4" @click.prevent="relpyComment()">
                           Thích
                        </div>
                        <div class="reply ps-4" @click.prevent="relpyComment()">
                            Trả lời
                        </div>
                    </div>
                </div>
                <div class="writeComment" :class="{hide : !showReply}">
                    <div class="d-flex align-items-center">
                        <div v-for="user in user" :key="user.id" class="user_writeComment">
                            <div class="avatar_comment">
                                <img :src="user.avatar" alt="" class="avatar">
                            </div>
                        </div>
                        <div class="content_writeComment">
                            <form action="" class="fromSubmitComment"
                                @submit.prevent="AddComment(node.post_id, node.id_feedback, $event)">
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
        <ul v-if="node.feedback && node.feedback.length ">
            <node v-for="child in node.feedback" :key="child.id" :node="child"></node>
        </ul>

    </li>
</template>

<script>
import { ref,onMounted,onUnmounted, defineComponent } from 'vue'
import { useDateFormat, useNow } from '@vueuse/core'

import userApi from '../../Api/userApi'
import feedbackApi from '../../Api/feedbackApi'

export default defineComponent ({
    name: "node",
    props: {
        node: Array,
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

        AddComment(postId, parentId, event) {
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

                    this.$emit('load-comment',newComment)
                    this.commentData = '';
                    this.showReply = false
                } catch (error) {
                    console.error("Error:", error);
                }
        },
    },
    components: {

    },

    created() {
        this.user = userApi.User()
        this.treeFeedback = feedbackApi.feedback()
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
