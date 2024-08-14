<template>
  <div>
    <button 
      v-if="y > 0" 
      class="btn btn-outline btn-circle fixed-button" 
      @click="scrollUp"> ↑ 
    </button>
    <button 
      v-if="!isAtBottom" 
      class="btn btn-outline btn-circle fixed-button" 
      style="bottom: 80px" 
      @click="scrollDown"> ↓ 
    </button>
  </div>
</template>

<script setup lang="ts">
import { useWindowScroll } from '@vueuse/core'

const { y } = useWindowScroll()

const isAtBottom = computed(() => {
  if (typeof window === 'undefined' || typeof document === 'undefined') {
    return false
  }
  const maxScroll = document.documentElement.scrollHeight - window.innerHeight
  return y.value >= maxScroll
})

const scrollUp = () => {
  window.scrollTo({
    top: y.value - 750,
    behavior: 'smooth'
  })
}

const scrollDown = () => {
  window.scrollTo({
    top: y.value + 750,
    behavior: 'smooth'
  })
}
</script>

<style scoped>
.fixed-button {
  position: fixed;
  right: 20px;
  z-index: 1000;
}

button:first-of-type {
  bottom: 140px;
}
</style>

