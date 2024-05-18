<template>
  <div class="card bg-base-100 shadow-xl border p-1 mx-2 mt-2">
    <figure>
      <img :src="image" :alt="descripcion" width="200" />
    </figure>
    <div class="card-body">
      <h2 class="card-title">{{ nombre_item }}</h2>
      <p>{{ descripcion }}</p>
      <div class="card-actions justify-end">
        <button class="btn btn-primary" @click="agregarObservacion">Agregar observación</button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">

const props = defineProps({
  nombre_item: String,
  image: String,
  descripcion: String
});


const agregarObservacion = () => {
  console.log('Observacion agregada');
};
</script>

<style scoped></style>