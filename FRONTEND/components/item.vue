<template>
  <div class="card bg-base-100 shadow-lg rounded-lg  transition-transform duration-300 hover:scale-105 select-none ">
    <figure v-if="imagenValida" @click="openModal(true)" class="cursor-pointer ">
      <NuxtImg :src="image ?? '/images/defaultimage.webp'" style="width: 100%; height: 200px;object-fit: cover"
        @error="setDefaultImage" />
    </figure>
    <figure v-else>
      <NuxtImg src="/images/defaultimage.webp" ref="imagen" style="width: 100%; height: 200px; object-fit: cover" />
    </figure>
    <div class="absolute top-0 right-0 cursor-pointer">

      <button v-if="showDeleteButton"
        class="btn btn-warning me-2 text-lg rounded-full mt-1 cursor-pointer transition-transform duration-300 hover:scale-105 select-none"
        @click.prevent="clickButtonDelete(itemId)">
        <i class="bi bi-trash3"></i>
      </button>
      <details class="dropdown dropdown-end ">
        <summary
          class="btn btn-neutral me-2 rounded-full mt-1 cursor-pointer transition-transform duration-300 hover:scale-105 select-none">
          <i class="bi bi-three-dots-vertical text-lg"></i>
        </summary>
        <ul class="menu dropdown-content bg-base-200  rounded-box me-2 z-[1] w-52 p-2 shadow">
          <li><a @click="pushRoute({ itemId, identifier, category })">Observaciones</a>
          </li>
          <li v-if="category == '1'"><a @click="clickInComponentes({ itemId })">Componentes</a>
          </li>
          <li><a @click="clickDetails({ itemId, category })">Detalles</a></li>
        </ul>
      </details>
    </div>
    <div class="card-body">
      <h2 class="card-title">{{ itemName }}</h2>
      <div class="card-actions justify-end">
        <span
          class="bg-blue-100 text-blue-800 text-xs font-medium  px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
          {{ category == '1' ? 'Equipo' : 'Oficina' }}
        </span>
        <span
          class="bg-blue-100 text-blue-800 text-xs font-medium  px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
          {{ serial }}
        </span>
        <span
          class="bg-blue-100 text-blue-800 text-xs font-medium  px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{
            quantity }} {{ unit }}</span>
      </div>
    </div>
  </div>
  <CardImagenFull v-if="imagenValida" :title="itemName + ' - ' + serial" :idModal="itemId" :imagen="image"
    :isModalOpen="isModalOpen" @close="openModal" />
  <CardImagenFull v-else :title="itemName + ' - ' + serial" :idModal="itemId" imagen="/images/defaultimage.webp"
    :isModalOpen="isModalOpen" @close="openModal" />
</template>

<script setup lang="ts">
const imagenValida: Ref<boolean> = ref(true);
const isModalOpen = ref(false);
const isCvOpen = ref(false);
const imagen: Ref<HTMLImageElement | null> = ref(null);
const emits = defineEmits<{
  (event: "clickDeleteButton", payload: string): void,
  (event: "clickObservaciones", payload: { itemId: string, identifier: number, category: string }): void
  (event: "clickComponentes", payload: { itemId: string }): void
  (event: "clickDetails", payload: { itemId: string, category: string }): void
}>();

function openModal(valor: boolean) {
  isModalOpen.value = valor;
}

const props = defineProps<{
  itemName: string,            // nombreItem
  image: any,
  // imageList: Array<{resource: string}>,  // images (si se usa)
  serial: string,              // serialNumber
  itemId: string,
  category: string,
  identifier: number,          // identificador
  quantity: number,            // cantidad
  unit: string,                // unidad
  showDeleteButton?: boolean,   // btnDelete
  showAddRepair?: boolean
}>();

function setDefaultImage(event: Event | string) {
  if (typeof event == "string") {
    console.log(event);
    return;
  }
  imagenValida.value = false;
}

const pushRoute = (datos: { itemId: string, identifier: number, category: string }) => {
  return emits("clickObservaciones", datos)
}

const clickInComponentes = (datos: { itemId: string }) => {
  return emits("clickComponentes", datos)
}
function clickButtonDelete(itemId: string) {
  return emits("clickDeleteButton", itemId);
}

function clickDetails(datos: { itemId: string, category: string }) {
  return emits('clickDetails', datos);
}



</script>

<style scoped>
/* Estilo para las miniaturas (thumbnails) */
.thumbnails-container {
  display: flex;
  justify-content: flex-start;
}

.thumbnail-image {
  width: 50px;
  height: 50px;
  object-fit: cover;
  cursor: pointer;
  border-radius: 4px;
  transition: transform 0.2s ease-in-out;
}

.thumbnail-image:hover {
  transform: scale(1.1);
}

.preview {
  object-fit: cover;
  border-radius: 2ch;
  width: 100%;
}
</style>
