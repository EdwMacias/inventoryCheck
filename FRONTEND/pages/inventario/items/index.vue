<template>
  <div class="container mx-auto p-4">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-4 sticky top-0 bg-white z-10 p-4 shadow">
      <NuxtLink class="btn btn-active btn-neutral mb-2 md:mb-0" to="registrar/crear">Agregar artículo</NuxtLink>
      <label class="input input-bordered flex items-center gap-2 w-full md:w-96 mb-2 md:mb-0">
        <input type="text" class="grow" placeholder="Buscar" />
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
          <path fill-rule="evenodd"
            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
            clip-rule="evenodd" />
        </svg>
      </label>
      <div class="join flex mb-2 md:mb-0">
        <button v-for="link in filteredLinks" :key="link.label" :disabled="!link.url" 
                @click="changePage(link.url)" 
                :class="{'btn-active': link.active}" 
                class="join-item btn">
          {{ link.label }}
        </button>
      </div>
      <div class="flex items-center gap-2 mb-2 md:mb-0">
        <input type="number" v-model="pageInput" @keydown.enter="goToPage" class="input input-bordered w-24" placeholder="Page #" />
        <button @click="goToPage" class="btn">Go</button>
      </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
      <ClientOnly>
        <Item v-for="respuestaItem in respuesta.data" :key="respuestaItem.item_id"
          :descripcion="respuestaItem.description" :image="respuestaItem.resource"
          :nombre_item="respuestaItem.name" :itemId="respuestaItem.item_id"
          :serial-number="respuestaItem.serial_number" />
      </ClientOnly>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { ref, computed, onMounted } from 'vue';
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository";

interface RespuestaItem {
  item_id: string;
  name: string;
  description: string;
  serial_number: string;
  resource: string;
}

interface PaginationResponse {
  current_page: number;
  data: RespuestaItem[];
  first_page_url: string;
  from: number;
  last_page: number;
  last_page_url: string;
  links: { url: string | null; label: string; active: boolean }[];
  next_page_url: string | null;
  path: string;
  per_page: number;
  prev_page_url: string | null;
  to: number;
  total: number;
}

const respuesta = ref<PaginationResponse>({
  current_page: 0,
  data: [],
  first_page_url: '',
  from: 0,
  last_page: 0,
  last_page_url: '',
  links: [],
  next_page_url: null,
  path: '',
  per_page: 0,
  prev_page_url: null,
  to: 0,
  total: 0,
});

const pageInput = ref<number | null>(null);

const filteredLinks = computed(() => {
  return respuesta.value.links.filter(link => !['pagination.previous', 'pagination.next'].includes(link.label));
});

const fetchItems = async (url: string | null) => {
  try {
    const response = await ItemRepository.Pagination(url);
    respuesta.value = response.data;
    console.log(respuesta.value);
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};

const changePage = (url: string | null) => {
  fetchItems(url);
};

const goToPage = () => {
  if (pageInput.value !== null) {
    const page = pageInput.value;
    const url = `${respuesta.value.path}?page=${page}`;
    fetchItems(url);
  }
};

onMounted(async () => {
  await fetchItems(respuesta.value.path);
});

</script>
