<template>
  <div class="">
    <div class="breadcrumbs text-lg">
      <ul>
        <li>
          <NuxtLink to="/">Inicio</NuxtLink>
        </li>
        <li>
          <NuxtLink to="/inventario/">Inventario</NuxtLink>
        </li>
      </ul>
    </div>
    <div class="lg:flex sm:grid sm:grid-cols-1">
      <div class="lg:flex lg:flex-grow">
        <NuxtLink class="btn btn-active btn-md btn-neutral sm:inline-flex" to="/inventario/registrar">
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
        <Item v-if="!loading" v-for="item in pagination.data" :image="item.resource"
          :item-name="item.name" :serial="item.serial" :item-id="item.item_id" :category="item.category_id"
          :identifier="item.id" :quantity="item.cantidad" :unit="item.unidad" :show-add-repair="item.category_id == '1'"
          :show-delete-button="usuarioStore.userRole === 'SUPERADMINISTRADOR'" @click-delete-button="deleteItem"
          @click-observaciones="pushRoute" @click-add-repair="pushRepair" />

        <!-- <ListItem v-if="!loading && !statusView" :data="pagination.data"
          :show-delete-button="usuarioStore.userRole === 'SUPERADMINISTRADOR'" @click-delete-button="deleteItem">
        </ListItem> -->

      </ClientOnly>
      <!--Boton flotante para cambiar estilo de vista-->
      <!-- <div class="fixed-button">
        <label class="btn btn-outline btn-circle swap swap-rotate ">
          <input type="checkbox" @change="statusView = !statusView">
          <svg class="swap-off fill-current" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
            viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M4.616 20q-.691 0-1.153-.462T3 18.384V7.616q0-.691.463-1.153T4.615 6h2.958l1.366-1.485q.217-.242.527-.379Q9.777 4 10.125 4h3.75q.348 0 .659.137q.31.136.527.379L16.428 6h2.958q.69 0 1.153.463T21 7.616v10.769q0 .69-.462 1.153T19.385 20zm0-1h14.769q.269 0 .442-.173t.173-.442V7.615q0-.269-.173-.442T19.385 7h-3.397l-1.844-2H9.856L8.012 7H4.615q-.269 0-.442.173T4 7.616v10.769q0 .269.173.442t.443.173m3.692-2.385h7.538q.243 0 .354-.217q.112-.217-.03-.429l-2.02-2.713q-.13-.162-.323-.162q-.192 0-.323.162l-2.292 2.898l-1.427-1.725q-.131-.142-.314-.142q-.182 0-.313.161l-1.154 1.521q-.162.212-.05.429q.112.218.354.218" />
          </svg>
          <svg class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
            viewBox="0 0 24 24">
            <path fill="currentColor" d="M5 13h14v-2H5m-2 6h14v-2H3m4-8v2h14V7" />
          </svg>
        </label>
      </div> -->

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
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository";
const usuarioStore = UsuarioStore();
const searchBefore: Ref<boolean> = ref(false);
const loading: Ref<boolean> = ref(true);
const searchQuery = ref('');
const pageInput = ref<number | null>(null);
const { $swal } = useNuxtApp()
const statusView = ref(true);

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
  }
};

const changePage = async (url: string | null) => {
  loading.value = true;
  await fetchItems(url);
  loading.value = false;
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
  let path = "/inventario/observaciones";
  const { itemId, identifier, category } = datos;
  const router = useRouter();

  localStorage.setItem('item-select', JSON.stringify({
    itemId: itemId,
    identificador: identifier,
  }))

  path += category == '1' ? `/equipo/${itemId}/` : `/oficina/${itemId}/`;

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
