<template>
  <div class="container mx-auto p-4">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
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
        <button class="join-item btn btn-active">1</button>
        <button class="join-item btn">2</button>
        <button class="join-item btn">3</button>
        <button class="join-item btn">4</button>
      </div>
    </div>
    <!-- <div><p>{{ respuesta }}</p></div> -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      <ClientOnly>
        <Item v-for="(respuestas, index) in respuesta.data" :descripcion="respuestas.description" :image="respuestas.resource" :nombre_item="respuestas.name" :itemId="respuestas.item_id" :serial-number="respuestas.serial_number"  :key="index" />
      </ClientOnly>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository";
const respuesta = ref({
  data: []});

onMounted(async () => {
  try {
    const response = await ItemRepository.Pagination();
    respuesta.value = response.data;
    console.log(respuesta.value.data);
  } catch (error) {
    console.error(error);
  }
});


// const items = [
//   {
//     nombre_item: "ejemplo",
//     descripcion: "Este es un ejemplo",
//     image: "https://hogaruniversal.vtexassets.com/arquivos/ids/163480/L60810-TETERA-INOX-25L.jpg?v=637562810425800000"
//   }
// ]

</script>
