<template>
  <div class="card bg-base-100 w-50 shadow-xl">
    <div class="absolute top-0 right-0 cursor-pointer">
      <details class="dropdown dropdown-end ">
        <summary class="btn btn-neutral me-2 rounded-full mt-1">
          <i class="bi bi-three-dots-vertical text-lg"></i>
        </summary>
        <ul class="menu dropdown-content bg-base-200  rounded-box me-2 z-[1] w-52 p-2 shadow">
          <li v-if="category == '1'">
            <a v-if="category == '1'" @click="pushRoute(itemId, identificador)" class="">
              >Historial Observacion Equipo
            </a>
          </li>
          <li v-if="category == '1'"><a>>Crear Observacion Equipo</a></li>
          <li v-if="category == '2'"> <a>>Historial Item Oficina</a>
          </li>
        </ul>
      </details>
    </div>
    <figure>
      <img ref="imagen" :src="image" @click="openModal(true)" @error="imageLoadError"
        style="width: 300px; height: 200px" />
    </figure>
    <div class="divider m-0"></div>
    <!-- <div class=""> -->
    <!-- <div class="card-actions justify-center"> -->
    <!-- <VueBarcode :value="serialNumber" format="EAN13" tag="svg" class="" -->
    <!-- :options="{ height: 20, width: 1, fontSize: 0.1, textMargin: 0.1 }"> -->
    <!-- No serial -->
    <!-- </VueBarcode> -->

    <!-- </div> -->
    <p class=" mb-1 text-lg mx-4 ">{{ nombreItem }}</p>
    <div class="card-actions mx-2 p-1">
      <span
        class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
        {{ category == '1' ? 'Equipo' : 'Oficina' }}
      </span>
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
  nombreItem: string,
  image: string,
  serialNumber: string,
  itemId: string,
  category: string,
  identificador: number
}>();

function imageLoadError(event: Event) {
  if (imagen.value) imagen.value.src = defaultImage;
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
.preview {
  object-fit: cover;
  border-radius: 2ch;
  width: 100%;
}
</style>
