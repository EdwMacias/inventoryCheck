<template>
  <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-4 rounded shadow-lg max-w-lg w-full">
      <button @click="close" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
      <img :src="image" alt="Imagen del artículo" class="w-full h-auto"/>
    </div>
  </div>
</template>

<script setup lang="ts">
const props = defineProps({
  isOpen: Boolean,
  image: String
});

const emit = defineEmits(['close']);

const close = () => {
  emit('close');
};
</script>

<style scoped>
/* Puedes añadir estilos adicionales aquí */
</style>