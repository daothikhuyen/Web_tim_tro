<template>
    <!-- <div class="TreeFeedBack"> -->
        <ul class="show_feedback">
            <FeedBackNode v-for="comment in treeData" :key="comment" :nodeData="comment" :add="add" ></FeedBackNode>
        </ul>
    <!-- </div> -->
</template>

<script>


import FeedBackNode from './childComment.vue'

export default {
    name: "FeedBackTree",

    mounted() {
        console.log("treeData",this.treeData)

    },
    components: {
        FeedBackNode
    },
    props: {
        add: Function,

        treeData: {
            type: Array,
        },

    },
    data() {
        return {
            treeFeedback: [],
        }
    },
    methods: {
        handleLoadComment : function(newComment) {
            console.log(newComment)
            this.treeFeedback.feedback.push(newComment);
        }
    },
}
</script>

<style>

</style>
