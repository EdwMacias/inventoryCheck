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
        <form id="formsearch-item" class="join mx-3" @submit.prevent="busqueda">
          <label class="input input-md input-bordered flex join-item items-center ">
            <input type="text" class="w-full" placeholder="Serial/Nombre Item" v-model="searchQuery" />
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
              <path fill-rule="evenodd"
                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                clip-rule="evenodd" />
            </svg>

          </label>
          <button class="btn btn-neutral btn-md join-item" type="submit">
            Buscar
          </button>
        </form>

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
        :serial-number="item.serial" :item-id="item.item_id" :category="item.category_id" :identificador="item.id"
        :cantidad="item.cantidad"  :unidad="item.unidad" />
    </div>

  </div>
</template>

<script lang="ts" setup>
import type { ItemResponse } from "~/Domain/Models/Api/Response/item.response";
import type { PaginationResponse } from "~/Domain/Models/Api/Response/pagination.response";
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository";

const searchBefore: Ref<boolean> = ref(false);
const loading: Ref<boolean> = ref(true);
const searchQuery = ref('');
const pageInput = ref<number | null>(null);
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


const usuarioStore = UsuarioStore();

const fetchItems = async (url: string | null = null) => {
  // Activamos el spinner
  loading.value = true;
  if (!usuarioStore.conectado)  return;
  try {
    const response = await ItemRepository.Pagination(url);
    let { links, prev_page_url, next_page_url } = response;

    pagination.value = response;

    // Eliminamos el primer y último enlace de paginación
    links = links.slice(1, -1);

    // Si hay un valor en searchQuery, agregamos el parámetro de búsqueda
    if (searchQuery.value) {
      const appendSearchQuery = (url: string) => `${url}&search=${searchQuery.value}`;

      // Modificamos los links de paginación
      links = links.map(link => {
        if (link.url) link.url = appendSearchQuery(link.url);
        return link;
      });

      // Modificamos prev y next page URL si existen
      if (prev_page_url) {
        pagination.value.prev_page_url = appendSearchQuery(prev_page_url);
      }
      if (next_page_url) {
        pagination.value.next_page_url = appendSearchQuery(next_page_url);
      }
    }

    pagination.value.links = links;

  } catch (error) {
    console.error('Error fetching items:', error);
    // Aquí podrías manejar el error, mostrar mensajes de error, etc.
  } finally {
    // Desactivamos el spinner
    loading.value = false;
  }
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

watch(searchQuery, async (newSearch, oldSearch) => {
  if (newSearch == '' && searchBefore.value) {
    await fetchItems();
    searchBefore.value = false;
  }
});

const busqueda = async () => {
  // Si la búsqueda está vacía, salimos inmediatamente
  if (!searchQuery.value) return;

  // Activamos el spinner y el estado de carga
  SpinnerStore().activeOrInactiveSpinner(true);
  loading.value = true;

  try {
    // Realizamos la búsqueda
    const response = await ItemRepository.PaginationBySearch(searchQuery.value);
    let { links, prev_page_url, next_page_url } = response;

    // Actualizamos la paginación
    pagination.value = response;

    // Eliminamos el primer y último enlace de la paginación
    links = links.slice(1, -1);

    // Función auxiliar para agregar el parámetro de búsqueda a las URLs
    const appendSearchQuery = (url: string) => `${url}&search=${searchQuery.value}`;

    // Modificamos los links de paginación con el parámetro de búsqueda
    links = links.map(link => {
      if (link.url) link.url = appendSearchQuery(link.url);
      return link;
    });

    // Modificamos prev y next page URL si existen
    if (prev_page_url) {
      pagination.value.prev_page_url = appendSearchQuery(prev_page_url);
    }
    if (next_page_url) {
      pagination.value.next_page_url = appendSearchQuery(next_page_url);
    }

    // Marcamos que la búsqueda ha sido realizada
    searchBefore.value = true;

    pagination.value.links = links;
    // Log para depuración
    console.log(pagination.value);

  } catch (error) {
    // Manejamos cualquier error que ocurra durante la búsqueda
    console.error('Error en la búsqueda:', error);
  } finally {
    // Desactivamos el estado de carga y el spinner siempre al final
    loading.value = false;
    SpinnerStore().activeOrInactiveSpinner(false);
  }
};

onMounted(async () => {
  localStorage.removeItem('item-select')
  await fetchItems(null);
  await nextTick();
});
</script>

<style scoped lang="css"></style>