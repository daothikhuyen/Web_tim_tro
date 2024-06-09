// App.vue

<template>
  <div class="App" :class="{'fix_body' : isScroll}">
    <transition name="fade">
      <router-view></router-view>
    </transition>
  </div>
</template>

<script>
import { ref,onMounted,onUnmounted, defineComponent } from 'vue'

export default {
  setup() {
    const isScroll = ref(false)

    const handleScroll = () => {
        isScroll.value = window.scrollY > 0
    }

    onMounted(() => {
        window.addEventListener('scroll', handleScroll)
    })

    onUnmounted(() => {
        window.removeEventListener('scroll', handleScroll)
    })

    return {
      isScroll
    }
  }
}
</script>
