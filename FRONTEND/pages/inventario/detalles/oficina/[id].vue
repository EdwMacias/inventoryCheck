<template>
  <div class="breadcrumbs text-lg  ">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink :to="INDEX_PAGE_INVENTARIO">Inventario</NuxtLink>
      </li>
      <li>
        Detalles
      </li>
      <li>
        Oficina
      </li>
    </ul>
  </div>

  <div class="bg-base-100 rounded-md px-5 p-1 ">
    <div class="card-actions justify-end">
      <div class="tooltip" data-tip="Descargar PDF">
        <button @click="" class="btn btn-neutral btn-md rounded-full">
          <i class="bi bi-filetype-pdf"></i>
        </button>
      </div>
    </div>

    <div class="card lg:card-side bg-base-100">
      <figure>
        <div class="w-96 skeleton h-56  rounded-md" v-if="!data"></div>
        <img v-else class="w-96 rounded-md" :src="data?.imagen" alt="Movie" />
      </figure>
      <div class="card-body">
        <h2 class="card-title skeleton  h-6 rounded w-1/2" v-if="!data"></h2>
        <h2 v-else class="card-title">{{ data.nombre }}</h2>
        <label class="input input-bordered flex items-center gap-2 ">
          Serial
          <p class="grow h-6 skeleton rounded" v-if="!data?.serial"></p>
          <p class="grow select-text" v-else>{{ data.serial }}</p>
        </label>
        <label class="input input-bordered flex items-center gap-2 mt-2">
          Valor
          <p class="grow h-6 skeleton rounded" v-if="!data?.valor"></p>
          <p class="grow select-text" v-else>{{ data.valor }}</p>
        </label>
        <label class="input input-bordered flex items-center gap-2 mt-2">
          Cantidad
          <p class="grow h-6 skeleton rounded" v-if="!data"></p>
          <p class="grow select-text" v-else>{{ data.cantidad + ' ' + data.unidad.codigo }}</p>
        </label>
      </div>
    </div>
  </div>

</template>

<script lang="ts" setup>
import { itemService } from '~/Domain/Client/Services/Items/item.service';
import type { OficinaDTO } from '~/Domain/DTOs/Items/Oficina/OficinaDTO';
import { INDEX_PAGE_INVENTARIO } from '~/Infrastructure/Paths/Paths';
const route = useRoute();
const data: Ref<OficinaDTO | undefined> = ref(undefined);
const router = useRouter();


onMounted(async () => {
  try {
    const result = await itemService.details(route.params.id as string);

    if (!result) {
      throw new Error("Datos no disponibles");
    }

    data.value = result;

  } catch (error) {
    return router.push(INDEX_PAGE_INVENTARIO); // Redirigir en caso de error
  }
});

</script>

<style></style>