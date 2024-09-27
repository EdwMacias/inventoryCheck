<template>
  <div class="card bg-base-100 w-50 shadow-lg m-0 p-0">
    <div class="absolute top-0 right-0 cursor-pointer">
      <details class="dropdown dropdown-end ">
        <summary class="btn btn-neutral me-2 rounded-full mt-1">
          <i class="bi bi-three-dots-vertical text-lg"></i>
        </summary>
        <ul class="menu dropdown-content bg-base-200  rounded-box me-2 z-[1] w-52 p-2 shadow">
          <li v-if="category == '1'">
            <a v-if="category == '1'" @click="pushRoute(itemId, identificador)">
              Historial Observacion Equipo
            </a>
          </li>
          <li v-if="category == '1'"><a>Crear Observacion Equipo</a></li>
          <li v-if="category == '2'"> <a>Historial Item Oficina</a>
          </li>
        </ul>
      </details>
    </div>
    
    <div class="card-body p-0">
      <div @click="openModal(true)" class="cursor-pointer">
        <NuxtImg v-if="imagenValida" :src="image" style="width: 100%; height: 200px;object-fit: cover"
          @error="setDefaultImage" />
        <NuxtImg v-else src="/images/defaultimage.webp" ref="imagen"
          style="width: 100%; height: 200px; object-fit: cover" />
      </div>
    </div>
    <div class="divider m-0"></div>
    <p class="text-lg mx-2">{{ nombreItem }}</p>
    <div class="card-actions p-2">
      <span
        class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
        {{ category == '1' ? 'Equipo' : 'Oficina' }}
      </span>
    </div>

    <CardImagenFull v-if="imagenValida" :title="nombreItem" :idModal="itemId" :imagen="image" :isModalOpen="isModalOpen"
      @close="openModal" />
    <CardImagenFull v-else :title="nombreItem" :idModal="itemId" imagen="/images/defaultimage.webp"
      :isModalOpen="isModalOpen" @close="openModal" />
  </div>
</template>

<script setup lang="ts">

const imagenValida: Ref<boolean> = ref(true);
const isModalOpen = ref(false);
const imagen: Ref<HTMLImageElement | null> = ref(null);

function openModal(valor: boolean) {
  isModalOpen.value = valor;
}

defineProps<{
  nombreItem: string,
  image: string,
  // images: Array<{resource: string}>,
  serialNumber: string,
  itemId: string,
  category: string,
  identificador: number
}>();

// currentImage.value = props.image;

function setDefaultImage(event: Event | string) {
  if (typeof event == "string") {
    console.log(event);
    return;
  }
  imagenValida.value = false;
}

const pushRoute = (itemId: string, id: number) => {
  const router = useRouter();

  localStorage.setItem('item-select', JSON.stringify({
    itemId: itemId,
    identificador: id,
  }))

  return router.push(`/inventario/items/observaciones/equipo/${itemId}`)
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
