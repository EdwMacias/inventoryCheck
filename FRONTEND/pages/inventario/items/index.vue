<template>
  <div class="mt-20">
    <div class="breadcrumbs text-lg mx-2">
      <ul>
        <li>
          <NuxtLink to="/">Inicio</NuxtLink>
        </li>
        <li>
          <NuxtLink to="/inventario/items/">Inventario</NuxtLink>
        </li>
      </ul>
    </div>
    <div class="flex flex-row bordered gap-2 mx-5">

      <NuxtLink class="btn btn-active btn-sm btn-neutral sm:inline-flex" to="registrar/crear">
        <span class="hidden sm:inline"> + Registrar Item</span>
        <span class="inline sm:hidden">+</span>
      </NuxtLink>

      <div class="join">
        <button v-for="link in pagination.links" :key="link.label" :disabled="!link.url" @click="changePage(link.url)"
          :class="{ 'btn-active': link.active }" class="join-item btn btn-sm">
          {{ link.label == "pagination.previous" ? '<' : link.label == 'pagination.next' ? '>' : link.label }} </button>
      </div>

      <div class="flex items-center bordered">
        <input type="text" v-model="pageInput" @keydown.enter="goToPage" placeholder="#"
          class="input input-sm input-bordered w-12 mx-1" />
        <button @click="goToPage" class="btn btn-sm btn-active"> > </button>
      </div>

      <div class="search-box flex-grow">
        <label class="input input-sm input-bordered flex items-center w-full">
          <input type="text" class="w-full" v-model="searchQuery" />
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
            <path fill-rule="evenodd"
              d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
              clip-rule="evenodd" />
          </svg>
        </label>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-2 p-5">
      <ClientOnly>
        <p v-if="pagination.data.length == 0">No Se Han Encontrado Registros</p>
        <Item v-for="item in pagination.data" :image="item.resource" :nombre-item="item.name"
          :serial-number="item.serie_lote" :item-id="item.item_id" :category="item.category_id"
          :identificador="item.id" />
      </ClientOnly>
    </div>

  </div>
</template>

<script lang="ts" setup>
import type { ItemResponse } from "~/Domain/Models/Api/Response/item.response";
import type { PaginationResponse } from "~/Domain/Models/Api/Response/pagination.response";
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository";

const isSearching = ref(false);
const searchQuery = ref('');
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

onMounted(async () => {
  localStorage.removeItem('item-select')

  await fetchItems();
});

const fetchItems = async (url: string | null = null) => {
  SpinnerStore().activeOrInactiveSpinner(true);
  const response = await ItemRepository.Pagination(url);
  pagination.value = response;
  // console.log(pagination.value.data);
  SpinnerStore().activeOrInactiveSpinner(false);
};

const changePage = async (url: string | null) => {
  await fetchItems(url);
};

const goToPage = async () => {
  if (pageInput.value !== null) {
    const page = pageInput.value;
    const url = `${pagination.value.path}?page=${page}`;
    await fetchItems(url);
  }
};

const busqueda = () => {
  isSearching.value = !isSearching.value;
};

</script>

<style scoped lang="css"></style>