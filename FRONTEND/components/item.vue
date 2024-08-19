<template>
  <div class="card bg-base-100 shadow-xl border overflow-hidden">
    <figure>
      <img ref="imagen" :src="image" @click="openModal(true)" @error="imageLoadError" class="w-full h-auto object-cover " />
    </figure>
    <div class="card-normal">
      <p class="mx-2 mt-1 font-bold flex justify-center">{{ nombre_item }}</p>
      <div class="card-actions justify-center flex p-2">
          <VueBarcode :value="serial_number" format="EAN13" tag="svg" class="" :options="{ height: 20, width: 1, fontSize: 0.1, textMargin: 0.1 }" >
            No serial
          </VueBarcode>
        <NuxtLink :to="`/inventario/items/observaciones/${itemId}`" class="btn btn-primary btn-sm">Observaciones</NuxtLink>
      </div>
    </div>
    <CardImagenFull :idModal="itemId" :imagen="imagen?.src" :isModalOpen="isModalOpen" @close="openModal" />
  </div>
</template>

<script setup lang="ts">
import defaultImage from '@/public/images/defaultimage.webp';

const isModalOpen = ref(false);
const imagen: Ref<HTMLImageElement | null> = ref(null);
function openModal(valor: boolean) {
  isModalOpen.value = valor;
}

defineProps<{
  nombre_item: string,
  image: string,
  serial_number: string,
  itemId: string
}>();

function imageLoadError(event: Event) {
  if (imagen.value) imagen.value.src = defaultImage;
}
</script>

<style scoped>
.preview {
  object-fit: cover;
  border-radius: 2ch;
  width: 100%;
}
</style>
