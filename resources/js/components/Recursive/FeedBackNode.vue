<template>
    <li class="content_feedback">
        <div class="show_writeComment" :id="node.id_feedback">
            <div class="node-tree avatar_name d-flex align-items-center mb-1">
                <div class="avatar inline-block">
                    <img :src="node.avatar" alt="avatar" class="image_avatar_feedback">
                </div>
                <div class="name px-2">
                    <div class="px-2 py-1 rounded-3" style=" background-color: rgb(119, 119, 119,0.10);">
                        <div class="fw-semibold">{{ node.username }}</div>
                        <div class="show_content_feedback">
                            <div class="content">
                                {{ node.content }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-1 ms-1">
                        <div class="created_time">
                            {{ node.created_time }}
                        </div>
                        <div class="reply ps-5" @click.prevent="relpyComment(node.id_feedback)">
                            Trả lời
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
import userApi from '../../Api/userApi'

export default {
    name: "node",
    mounted() {
            console.log(this.node)
    },
    props: {
        node: Array,
    },
    data() {
        const commentData = ref(null)
        return {
            user: [],
            commentData
        }
    },
    methods: {
        relpyComment(feedback_id){
            const commentData = document.getElementById(feedback_id)
            const avatar = this.user[0].avatar

            commentData.innerHTML += `<ul class="writeComment " >
                        <li class="d-flex align-items-center">
                            <div  class="user_writeComment">
                                <div class="avatar_comment">
                                    <img src="${avatar}" alt="" class="avatar">
                                </div>
                            </div>
                            <div class="content_writeComment" >
                                <form action="" class="fromSubmitComment"  @submit.prevent="AddComment(node.parent_id,$event)" >
                                    <input type="text" class="inputComment w-100" placeholder="Viết bình luận..." v-mode="commentData" ref="commentData">
                                    <button class="btn_send" type="submit">
                                            <i class="bi bi-send-fill" style="color:#ea4e27 "></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>`
        },

        AddComment(parent_id,event){
            event.preventDefault();

            console.log(this.commentData)
        }
    },
    created() {
        this.user = userApi.User()
    },
}
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

.content_feedback .reply{
    cursor: pointer;
}


</style>
