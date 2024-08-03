<template>
  <div class="card bg-base-100 shadow-xl border overflow-hidden">
    <figure>
      <img ref="imagen" :src="image" :alt="nombre_item" @click="openModal(true)" @error="imageLoadError"
        class="w-full h-auto object-cover" />
    </figure>
    <div class="card-normal">
      <p class="mx-2 mt-1 font-bold">{{ nombre_item }}</p>
      <!-- <p class="mx-2">{{descripcion}}</p> -->
      <div class="card-actions justify-center flex p-2">
        <button class="btn btn-accent btn-sm w-full" @click="showModal">Codigo</button>
        <dialog ref="myModal" class="modal">
          <div class="modal-box">
            <div class="modal-action">
              <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                  @click="openModal(false)">x</button>
              </form>
            </div>
          </div>
        </dialog>
        <Observacion />
        <NuxtLink :to="`/inventario/items/observaciones/${itemId}`" class="btn btn-primary btn-sm">Observaciones
        </NuxtLink>
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
const myModal = ref(null);

const showModal = () => {
  if (myModal.value) {
    // myModal.value.showModal();
  }
};

defineProps<{
  nombre_item: string,
  image: string,
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
