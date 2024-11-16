<template>
  <!-- navegacion estatica-->
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
    <!-- contenido de la pagina-->
    <div class="container mt-10 mx-auto bg-base-100 rounded p-2">
      <TableTerceros></TableTerceros>
    </div>
    <div class="container mx-auto bg-base-100 rounded p-2">
      <button type="button" class="btn btn-outline"  @click="statusModal"> Agregar tercero</button>
      <dialog class="modal" :open="modalValue">
        <div class="modal-box">
          <FormularioTerceros></FormularioTerceros>
          <form method="dialog" class="modal-backdrop">
            <button class="btn btn-sm absolute right-2 top-2" @click="statusModal" >x</button>
          </form>
        </div>
        <form method="dialog" class="modal-backdrop">
          <button @click="statusModal">close</button>
        </form>
      </dialog>
    </div>
  </div>
</template>

<script lang="ts" setup>
const modalValue = ref(false);

function statusModal() {
  modalValue.value = !modalValue.value
}
</script>

<style>

</style>