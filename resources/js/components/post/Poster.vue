<template>
    <div class="avatar_name d-flex align-items-center">
        <div class="avatar inline-block">
            <img  v-if="user.avatar != null" :src="user.avatar" alt="avatar" class="image_avatar_post">
             <img  v-else src="https://static.vecteezy.com/system/resources/thumbnails/005/129/844/small_2x/profile-user-icon-isolated-on-white-background-eps10-free-vector.jpg" alt="avatar" class="image_avatar_post">
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
