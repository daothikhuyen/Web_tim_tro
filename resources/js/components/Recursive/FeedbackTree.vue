<template>
    <div class="TreeFeedBack">
        <ul class="show_feedback">
            <node-tree v-for="comment in treeData" :key="comment" :node="comment" ></node-tree>
        </ul>
    </div>
</template>

<script>
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

    }
}
</script>

<style>

</style>
