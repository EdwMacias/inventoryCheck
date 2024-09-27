<template>
  <div class="mt-20">
    <div class="breadcrumbs text-lg mx-5">
      <ul>
        <li>
          <NuxtLink to="/">Inicio</NuxtLink>
        </li>
        <li>
          <NuxtLink to="/inventario/items/">Inventario</NuxtLink>
        </li>
      </ul>
    </div>
    <div class="flex">
      <!-- <div class="sm:flex"> -->
      <div class="flex flex-grow mx-4 ">
        <NuxtLink class="btn btn-active btn-md btn-neutral sm:inline-flex" to="/inventario/items/registrar/crear">
          <span class="hidden lg:inline"> + Registrar Item</span>
          <span class="inline sm:inline">+</span>
        </NuxtLink>
        <label class="input input-md input-bordered flex items-center mx-1">
          <input type="text" class="w-full" placeholder="Serial/Nombre Item" v-model="searchQuery" />
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
            <path fill-rule="evenodd"
              d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
              clip-rule="evenodd" />
          </svg>
        </label>
        <button class="btn btn-neutral btn-md mx-1" @click="busqueda">
          Buscar
        </button>
      </div>

      <!-- </div> -->

      <div class="justify-end mx-5 ">
        <div class="join space-x-2">
          <button class="join-item btn btn-outline btn-md" @click="changePage(pagination.prev_page_url)"
            :disabled="!pagination.prev_page_url">
            Anterior
          </button>

          <button v-if="pagination.data.length === 0"
            class="lg:inline hidden join-item btn btn-outline btn-md">1</button>

          <button v-else v-for="link in pagination.links" :key="link.label"
            class=" lg:inline md:inline  hidden  join-item btn btn-outline btn-md" :disabled="link.active"
            @click="changePage(link.url)">
            {{ link.label }}
          </button>

          <button class="join-item btn btn-outline btn-md" @click="changePage(pagination.next_page_url)"
            :disabled="!pagination.next_page_url">
            Siguiente
          </button>
        </div>
      </div>

    </div>


    <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-2 p-5">
      <!-- <LoadingsLoader v-if="loading"></LoadingsLoader> -->
      <div v-if="loading" class="col-span-full flex flex-col items-center justify-center h-64">
        <p class="mb-4">Cargando...</p>
        <LoadingsLoader />
      </div>

      <p v-if="!loading && pagination.data.length == 0">No Se Han Encontrado Registros</p>
      <Item v-if="!loading" v-for="item in pagination.data" :image="item.resource" :nombre-item="item.name"
        :serial-number="item.serie_lote" :item-id="item.item_id" :category="item.category_id"
        :identificador="item.id" />
    </div>

  </div>
</template>

<script lang="ts" setup>
import type { ItemResponse } from "~/Domain/Models/Api/Response/item.response";
import type { PaginationResponse } from "~/Domain/Models/Api/Response/pagination.response";
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository";

const loading: Ref<boolean> = ref(true);
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
  // SpinnerStore().activeOrInactiveSpinner(true);
  const response = await ItemRepository.Pagination();
  pagination.value = response;
  pagination.value.links = pagination.value.links.slice(1, -1);
  loading.value = false;
  await nextTick();
  // SpinnerStore().activeOrInactiveSpinner(false);

});

const fetchItems = async (url: string | null = null) => {
  // SpinnerStore().activeOrInactiveSpinner(true);
  loading.value = true;
  const response = await ItemRepository.Pagination(url);
  pagination.value = response;
  pagination.value.links = pagination.value.links.slice(1, -1);
  loading.value = false;
  // SpinnerStore().activeOrInactiveSpinner(false);
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

const busqueda = async () => {
  SpinnerStore().activeOrInactiveSpinner(true);
  loading.value = true;
  const response = await ItemRepository.PaginationBySearch(searchQuery.value);
  pagination.value = response;
  pagination.value.links = pagination.value.links.slice(1, -1);
  loading.value = false;
  SpinnerStore().activeOrInactiveSpinner(false);
  // isSearching.value = !isSearching.value;
};

</script>

<style scoped lang="css"></style>