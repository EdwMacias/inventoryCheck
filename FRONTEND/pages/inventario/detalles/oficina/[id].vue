<template>
  <div>
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
          <img class="w-96 rounded-md" :src="data.imagen" alt="Movie" />
        </figure>
        <div class="card-body">
          <h2 class="card-title">{{ data.nombre }}</h2>
          <label class="input input-bordered flex items-center gap-2 ">
            Serial
            <p class="grow">{{ data.serial }}</p>
          </label>
          <label class="input input-bordered flex items-center gap-2 mt-2">
            Valor
            <p class="grow">{{ data.valor }}</p>
          </label>
          <label class="input input-bordered flex items-center gap-2 mt-2">
            Cantidad
            <p class="grow">{{ data.cantidad + ' ' + data.unidad.codigo }}</p>
          </label>
        </div>
      </div>

    </div>
  </div>
</template>

<script lang="ts" setup>
import { itemService } from '~/Domain/Client/Services/Items/item.service';
import { INDEX_PAGE_INVENTARIO } from '~/Infrastructure/Paths/Paths';
const route = useRoute();
const data = await itemService.details(route.params.id as string);


</script>

<style></style>