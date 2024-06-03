<template>
  <div class="card bg-base-100 shadow-xl border mx-2 mt-2">
    <figure>
      <img :src="image" :alt="descripcion" class="preview">
    </figure>
    <div class="card-body">
      <h2 class="card-title">{{ nombre_item }}</h2>
      <p>{{ descripcion }}</p>
      <div class="card-actions justify-end">
        <Observacion />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">

defineProps({
  nombre_item: String,
  image: String,
  descripcion: String
});

const agregarObservacion = () => {
  console.log('Observacion agregada');
};
</script>

<style scoped>
.preview {
  object-fit: cover;
  border-radius: 2ch;
  width: 100%;
}
</style>