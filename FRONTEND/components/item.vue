<template>
  <div class="card bg-base-100 shadow-xl border-xl ">
    <figure>
      <img ref="imagen" :src="image" :alt="descripcion" @click="openModal(true)" @error="imageLoadError" />
    </figure>
    <div class="card-body">
      <h2 class="card-title" style="word-wrap: break-word;">{{ nombre_item }}</h2>
      <p style="word-wrap: break-word;">{{descripcion}}</p>
      <div class="card-actions justify-end">
        <Observacion />
      </div>
    </div>
    <CardImagenFull :idModal="itemId" :imagen="imagen?.src" :isModalOpen="isModalOpen" @close="openModal" />
  </div>
</template>

<script setup lang="ts">

const isModalOpen = ref(false);
const imagen: Ref<HTMLImageElement | null> = ref(null);
function openModal(valor: boolean) {
  isModalOpen.value = valor;
}


const props = defineProps<{
  nombre_item: string,
  image: string,
  descripcion: string,
  // serialNumber: string,
  itemId: string
}>();

const agregarObservacion = () => {
  console.log('Observacion agregada');
};

function imageLoadError(event: Event) {
  if (imagen.value) {
    imagen.value.src = "https://www.shutterstock.com/image-vector/default-image-icon-vector-missing-600nw-2079504220.jpg";
  }
}
</script>

<style scoped>
.preview {
  object-fit: cover;
  border-radius: 2ch;
  width: 100%;
}
</style>