<template>
    <!-- <div class="TreeFeedBack"> -->
        <ul class="show_feedback">
            <node-tree v-for="comment in treeData" :key="comment" :node="comment" @load-comment="handleLoadComment" ></node-tree>
        </ul>
    <!-- </div> -->
</template>

<script>
import { ref,onMounted,onUnmounted, defineComponent } from 'vue'
import { useDateFormat, useNow } from '@vueuse/core'

import userApi from '../../Api/userApi'
import feedbackApi from '../../Api/feedbackApi'

import NodeTree from './FeedBackNode.vue'

export default {
    name: "FeedBackTree",

    mounted() {
        console.log(this.treeData)

    },
    components: {
        NodeTree
    },
    props: {
        treeData: {
            type: Array,
        }

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
    created() {
        this.treeFeedback = feedbackApi.feedback()
    },
}
</script>

<style>

</style>
