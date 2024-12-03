<template>
  <!-- navegacion estatica-->
  <div class="">
    <div class="breadcrumbs text-lg">
      <ul>
        <li>
          <NuxtLink to="/">Inicio</NuxtLink>
        </li>
        <li>
          <a>Terceros</a>
        </li>
      </ul>
    </div>

    <div class="container mx-auto mx-5 bg-base-100 rounded-lg p-3">
      <div class="tooltip tooltip-right transition-transform duration-300 hover:scale-105" data-tip="Registrar Tercero">
        <NuxtLink class="btn btn-neutral hover:bg-success-content rounded-full shadow-xl transition-transform duration-300 hover:scale-105 select-none" to="registrar">
          <i class="bi bi-person-plus-fill"></i>
        </NuxtLink>
      </div>
    </div>


  </div>
</template>

<script lang="ts" setup>
const modalValue = ref(false);

function statusModal() {
  modalValue.value = !modalValue.value
}
</script>

<style></style>