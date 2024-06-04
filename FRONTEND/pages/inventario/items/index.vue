<template>
  <div class="mx-auto">
    <div 
      class="flex flex-row items-center justify-between mb-2 sticky top-0 rounded-xl z-10 p-4 bg-base-100 bordered shadow-xl gap-2 busqueda" >
      <!-- Botón de agregar artículo -->
      <NuxtLink v-if="!isSearching" class="btn btn-active btn-neutral hidden sm:inline-flex" to="registrar/crear">
        Agregar artículo
      </NuxtLink>
      <NuxtLink v-if="!isSearching" class="btn btn-active btn-neutral inline-flex sm:hidden" to="registrar/crear">
        +
      </NuxtLink>

      <!-- Paginación -->
      <div v-if="!isSearching" class="join">
        <button v-for="link in filteredLinks" :key="link.label" :disabled="!link.url" 
        @click="changePage(link.url)" 
        :class="{'btn-active': link.active}" 
        class="join-item btn">
        {{ link.label }}
      </button>
      </div>

      <!-- Input de página -->
      <div v-if="!isSearching" class="flex items-center bordered">
        <input type="text" v-model="pageInput" @keydown.enter="goToPage" placeholder="#" class="input input-bordered w-12 mx-1" />
        <button @click="goToPage" class="btn btn-active"> > </button>
      </div>

      <!-- Barra de búsqueda -->
      <div class="search-box flex-grow">
        <label class="input input-bordered flex items-center w-full">
          <input type="text" class="w-full" v-model="searchQuery" @click="busqueda()" />
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
            <path fill-rule="evenodd"
              d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
              clip-rule="evenodd" />
          </svg>
        </label>
      </div>
    </div>
  
    <!-- Listado de ítems -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-4">
      <ClientOnly>
        <Item v-for="respuestaItem in filteredItems" :key="respuestaItem.item_id" :descripcion="respuestaItem.description" :image="respuestaItem.resource" :nombre_item="respuestaItem.name" :itemId="respuestaItem.item_id" :serial-number="respuestaItem.serial_number" />
      </ClientOnly>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository";
const isSearching = ref(false);
const searchQuery = ref('');

const busqueda = () => {
  isSearching.value = !isSearching.value;
};
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

const filteredItems = computed(() => {
  if (!searchQuery.value) {
    return respuesta.value.data;
  }
  return respuesta.value.data.filter(item => 
    item.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    item.description.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    item.serial_number.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

onMounted(async () => {
  await fetchItems(respuesta.value.path);
});

</script>

<style scoped>
.busqueda:hover {
  opacity: 1;
  transition: all 0.5s ease-in-out;
}
.busqueda{
  opacity:0.5
}
.search-box:click {
    flex-grow: 1;
    width: 100%;
  }

</style>