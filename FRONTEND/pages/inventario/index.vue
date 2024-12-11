<template>
  <div class="">
    <div class="breadcrumbs text-lg">
      <ul>
        <li>
          <NuxtLink to="/">Inicio</NuxtLink>
        </li>
        <li>
          <NuxtLink :to="INDEX_PAGE_INVENTARIO">Inventario</NuxtLink>
        </li>
      </ul>
    </div>
    <div class="lg:flex sm:grid sm:grid-cols-1">

      <div class="lg:flex lg:flex-grow">
        <NuxtLink class="btn btn-active btn-md btn-neutral sm:inline-flex" :to="INDEX_PAGE_INVENTARIO_REGISTRAR">
          <span class="hidden lg:inline"> + Registrar Item</span>
          <span class="inline sm:inline">+</span>
        </NuxtLink>
        <select class="select select-bordered w-full max-w-xs mx-1" v-model="isFilterCategory">
          <option value="null" selected>Filtro Categoria</option>
          <option value="2">Oficina</option>
          <option value="1">Equipo</option>
        </select>
        <form id="formsearch-item" class="join mx-1" @submit.prevent="busqueda">
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

      <div class="justify-end sm:mt-2 ">
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

    <!--Espacio de items-->
    <div v-if="loading" class="col-span-full flex flex-col items-center justify-center h-64">
      <p class="mb-4">Cargando...</p>
      <LoadingsLoader />
    </div>

    <p v-if="!loading && pagination.data.length == 0">No Se Han Encontrado Registros</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-5 mt-5 mb-5">
      <ClientOnly>
        <Item v-if="!loading" v-for="item in pagination.data" :image="item.resource" :item-name="item.name"
          :serial="item.serial" :item-id="item.item_id" :category="item.category_id" :identifier="item.id"
          :quantity="item.cantidad" :unit="item.unidad" :show-add-repair="item.category_id == '1'"
          :show-delete-button="usuarioStore.userRole === 'SUPERADMINISTRADOR'" @click-delete-button="deleteItem"
          @click-observaciones="pushRoute" @click-componentes="clickInComponentes" @click-details="pushDetailRoute" />
      </ClientOnly>
    </div>
  </div>
</template>

<style scoped lang="css">
.fixed-button {
  position: fixed;
  left: 10px;
  bottom: 50px;
  z-index: 200;
  height: 1em;
}
</style>

<script lang="ts" setup>
import type { ItemResponse } from "~/Domain/Models/Api/Response/item.response";
import type { PaginationResponse } from "~/Domain/Models/Api/Response/pagination.response";
import { INDEX_PAGE_COMPONENTES_EQUIPO, INDEX_PAGE_INVENTARIO, INDEX_PAGE_INVENTARIO_DETAILS_EQUIPO, INDEX_PAGE_INVENTARIO_DETAILS_OFICINA, INDEX_PAGE_INVENTARIO_OBSERVACION_EQUIPO, INDEX_PAGE_INVENTARIO_OBSERVACION_OFICINA, INDEX_PAGE_INVENTARIO_REGISTRAR } from "~/Infrastructure/Paths/Paths";
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository";
const usuarioStore = UsuarioStore();
const searchBefore: Ref<boolean> = ref(false);
const loading: Ref<boolean> = ref(true);
const searchQuery = ref('');
const pageInput = ref<number | null>(null);
const { $swal } = useNuxtApp()
const statusView = ref(true);
const isFilterCategory = ref('null');

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

const fetchItems = async (url: string | null = null) => {
  // Activamos el spinner
  if (!usuarioStore.conectado) return;
  try {


    const response = await ItemRepository.Pagination(url);
    console.log("Response data:", response); // Log de los datos recibidos

    let { links, prev_page_url, next_page_url } = response;

    pagination.value = response;
    // Eliminamos el primer y último enlace de paginación
    links = links.slice(1, -1);

    // if (isFilterCategory.value !== 'null') {

    // }
    // Si hay un valor en searchQuery, agregamos el parámetro de búsqueda
    // if (searchQuery.value) {
    const appendSearchQuery = (url: string) => `${url}${isFilterCategory.value != 'null' ? `&categoria=${isFilterCategory.value}` : ''}${searchQuery.value ? `&search=${searchQuery.value}` : ''}`;

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
    // }

    pagination.value.links = links;

  } catch (error) {
    console.error('Error fetching items:', error);
    // Aquí podrías manejar el error, mostrar mensajes de error, etc.
  } finally {
    // Desactivamos el spinner
  }
};
const changePage = async (url: string | null) => {
  loading.value = true;
  await fetchItems(url);
  loading.value = false;
};

watch(searchQuery, async (newSearch) => {
  const shouldResetSearch = newSearch === '' && searchBefore.value;

  if (!shouldResetSearch) return;

  const action = isFilterCategory.value != 'null' ? filtroCategoria : fetchItems;
  await action();

  searchBefore.value = false;
});

watch(isFilterCategory, async (newSearch) => {
  loading.value = true;

  if (searchQuery.value) {
    await busqueda();
  } else {
    const action = newSearch === 'null' ? fetchItems : filtroCategoria;
    await action();
  }
  if (newSearch === 'null') {
    loading.value = false;
  }
});

const busqueda = async () => {
  // Si la búsqueda está vacía, salimos inmediatamente
  if (!searchQuery.value) return;

  // Activamos el spinner y el estado de carga
  // SpinnerStore().activeOrInactiveSpinner(true);
  loading.value = true;

  try {
    let response;
    if (isFilterCategory.value != 'null') {
      response = await ItemRepository.paginationByFilterAndSearch(isFilterCategory.value, searchQuery.value);
    } else {
      response = await ItemRepository.PaginationBySearch(searchQuery.value);
    }
    // Realizamos la búsqueda
    // const response = await ItemRepository.PaginationBySearch(searchQuery.value);
    let { links, prev_page_url, next_page_url } = response;

    // Actualizamos la paginación
    pagination.value = response;

    // Eliminamos el primer y último enlace de la paginación
    links = links.slice(1, -1);

    // Función auxiliar para agregar el parámetro de búsqueda a las URLs
    const appendSearchQuery = (url: string) => `${url}&search=${searchQuery.value}${isFilterCategory.value != 'null' ? `&categoria=${isFilterCategory.value}` : ''}`;

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
    // SpinnerStore().activeOrInactiveSpinner(false);
  }
};

const filtroCategoria = async () => {
  if (!isFilterCategory.value) return;

  loading.value = true;

  try {
    // Realizamos la búsqueda
    let response;
    if (searchQuery.value) {
      response = await ItemRepository.paginationByFilterAndSearch(isFilterCategory.value, searchQuery.value);
    } else {
      response = await ItemRepository.paginationByFilter(isFilterCategory.value);
    }

    let { links, prev_page_url, next_page_url } = response;

    // Actualizamos la paginación
    pagination.value = response;

    // Eliminamos el primer y último enlace de la paginación
    links = links.slice(1, -1);

    // Función auxiliar para agregar el parámetro de búsqueda a las URLs
    const appendSearchQuery = (url: string) => `${url}&categoria=${isFilterCategory.value}${searchQuery.value ? `&search=${searchQuery.value}` : ''}`;

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
    // console.log(pagination.value);

  } catch (error) {
    // Manejamos cualquier error que ocurra durante la búsqueda
    console.error('Error en la búsqueda:', error);
  } finally {
    // Desactivamos el estado de carga y el spinner siempre al final
    loading.value = false;
    // SpinnerStore().activeOrInactiveSpinner(false);
  }
}

async function deleteItem(itemId: string) {
  // Mostrar un cuadro de diálogo de confirmación usando SweetAlert2
  const response = await $swal.fire({
    title: '¿Estás seguro?',
    text: 'No podrás revertir esta acción.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminarlo',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    return result.isConfirmed
  });

  if (!response) return;


  loading.value = true;
  try {
    await ItemRepository.Delete(itemId);
    await fetchItems();

    $swal.fire(
      'Eliminado',
      'El ítem ha sido eliminado.',
      'success'
    );
  } catch (e) {
    console.error('Error eliminando item', e);
  }
  loading.value = false;

}

const pushRoute = (datos: { itemId: string, identifier: number, category: string }) => {
  const { itemId, identifier, category } = datos;
  const router = useRouter();

  localStorage.setItem('item-select', JSON.stringify({
    itemId: itemId,
    identificador: identifier,
  }))

  const path = category == '1' ? `${INDEX_PAGE_INVENTARIO_OBSERVACION_EQUIPO}${itemId}/` : `${INDEX_PAGE_INVENTARIO_OBSERVACION_OFICINA}${itemId}/`;

  return router.push(path)
}

const pushDetailRoute = (datos: { itemId: string, category: string }) => {
  const { itemId, category } = datos;
  const router = useRouter();
  let path = category == '1' ? INDEX_PAGE_INVENTARIO_DETAILS_EQUIPO : INDEX_PAGE_INVENTARIO_DETAILS_OFICINA
  path += itemId;

  return router.push(path)

}

const clickInComponentes = (datos: { itemId: string }) => {
  const router = useRouter();

  const path = INDEX_PAGE_COMPONENTES_EQUIPO + datos.itemId;

  return router.push(path)

}

const pushRepair = (itemId: string) => {
  let path = "/inventario/registrar/equipo/refaccion/" + itemId;
  const router = useRouter();
  return router.push(path)
}

onMounted(async () => {
  loading.value = true;
  localStorage.removeItem('item-select')
  await fetchItems(null);
  await nextTick();
  loading.value = false;
});
</script>
