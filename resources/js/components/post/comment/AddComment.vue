<template>
    <div class="content_writeComment">
        <form action="" class="fromSubmitComment" @submit.prevent="onAddComment">
            <input type="text" class="inputComment w-100" placeholder="Viết bình luận..." ref="input" v-model="commentContent">
            <button class="btn_send" type="submit" >
                <i class="bi bi-send-fill" style="color:#ea4e27 "></i>
            </button>
        </form>
    </div>
</template>
<script>
import { ref, defineComponent } from 'vue'
export default defineComponent({
    name: "AddComment",
    props:{
        add: Function,
        postId: Number,
        nodeData: Object,
        showReply: Boolean,

    },
    data(){
        const commentContent = ref(null)
        return{
            commentContent
        }
    },
    methods:{
        onAddComment(){
            console.log("onAddComment" +this.postId, this.nodeData,this.showReply)
            this.add(this.postId, this.nodeData, this.commentContent,this.showReply)
            this.commentContent = ""
        }
    }
})
</script>
<style scoped>
.writeComment {
    border: none;
    box-shadow: none;
    padding-top: 10px;
    margin: 0 0 20px 0px;
}

.writeComment .content_writeComment {
    width: 95%;
    height: auto;
    max-height: 70px;
    overflow-y: auto;
}

.writeComment .content_writeComment .fromSubmitComment {
    display: flex;
    align-items: center;
    margin-left: 15px;
    background-color: rgb(119, 119, 119, 0.20);
    padding: 10px 5px 10px 20px;
    border-radius: 10px;

}

.TimeAndReply .reply {
    cursor: pointer;
}
</style>
