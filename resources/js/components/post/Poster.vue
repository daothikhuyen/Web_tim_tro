<template>
    <div class="avatar_name d-flex align-items-center">
        <div class="avatar inline-block">
            <img :src="user.avatar" alt="avatar" class="image_avatar_post">
        </div>
        <div class="name px-2">
            <span>{{ user.username }}</span>
        </div>
    </div>
</template>
<script>
import { defineComponent } from 'vue'
export default defineComponent({
    props: {
        user: Object,
    }
})
</script>
