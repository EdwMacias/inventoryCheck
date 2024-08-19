<template>
    <NuxtLink to="/" class="btn btn-outline btn-circle fixed-button" @click="handleCancel"><SvgCancel/></NuxtLink>
    <button type="submit" class="btn btn-outline btn-circle fixed-button" @click="handleSave"><SvgSave/></button>
</template>

<script lang="ts" setup>
const emit = defineEmits(['save', 'cancel'])
const handleSave = () => {
  emit('save')
}
const handleCancel = () => {
  emit('cancel')
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