<template>
  <div class="mx-auto">
    <div class="flex flex-row items-center justify-between mb-2 
      sticky top-0 rounded-xl z-10 p-4 bg-base-100 bordered shadow-xl gap-2 busqueda">
      <!-- Botón de agregar artículo -->
      <NuxtLink class="btn btn-active btn-neutral hidden sm:inline-flex" to="registrar/crear">
        Agregar artículo
      </NuxtLink>

      <div v-if="!isSearching" class="join">
        <button v-for="link in pagination.links" :key="link.label" :disabled="!link.url" @click="changePage(link.url)"
          :class="{ 'btn-active': link.active }" class="join-item btn">
          {{ link.label == "pagination.previous" ? 'Anterior' : link.label == 'pagination.next' ? 'Siguiente' :
            link.label }}
        </button>
      </div>

      <!-- Input de página -->
      <div v-if="!isSearching" class="flex items-center bordered">
        <input type="text" v-model="pageInput" @keydown.enter="goToPage" placeholder="#"
          class="input input-bordered w-12 mx-1" />
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
    <!-- </div> -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-2 p-5">
      <ClientOnly>
        <LazyItem v-for="item in pagination.data" :key="item.item_id" :descripcion="item.description"
          :image="item.resource" :nombre_item="item.name" :itemId="item.item_id" />
      </ClientOnly>
    </div>

  </div>
</template>

<script lang="ts" setup>
import type { ItemResponse } from "~/Domain/Models/Api/Response/item.response";
import type { PaginationResponse } from "~/Domain/Models/Api/Response/pagination.response";
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository";

const loading = ref(false);
const isSearching = ref(false);
const searchQuery = ref('');

const busqueda = () => {
  isSearching.value = !isSearching.value;
};

const pagination = ref<PaginationResponse<ItemResponse>>({
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

const fetchItems = async (url: string | null) => {
  try {
    const response = await ItemRepository.Pagination(url);
    pagination.value = response;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};

const changePage = async (url: string | null) => {
  pagination.value.data.length = 0;
  const response = await ItemRepository.Pagination(url);
  pagination.value = response;
};

const goToPage = () => {
  if (pageInput.value !== null) {
    const page = pageInput.value;
    const url = `${pagination.value.path}?page=${page}`;
    fetchItems(url);
  }
};


onMounted(async () => {
  const response = await ItemRepository.Pagination();
  pagination.value = response;
  
});

</script>

<style scoped>
.busqueda:hover {
  opacity: 1;
  transition: all 0.5s ease-in-out;
}

.busqueda {
  opacity: 0.5
}

.search-box:click {
  flex-grow: 1;
  width: 100%;
}
</style>