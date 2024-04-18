//news posting interface

<template>
    <div class="WriteNewPost">
        <navbar-component/>

    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'

import NavbarComponent from "../NavbarComponent.vue"

export default defineComponent({
    name: "writePost",
    data() {
        return {

        }
    },
    components: {
        NavbarComponent
    }
})
</script>
