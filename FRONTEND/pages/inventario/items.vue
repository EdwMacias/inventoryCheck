<template>
  <div class="m-2">
    <p class="">inventario operativo</p>
    <button class="btn" @click="crearItem" > Crear</button> 
    <button class="btn">observación</button>
    <!-- espacio para datatable, muestra de inventario-->
  </div>


<!-- espacio para datatable -->
</template>

<script lang="ts" setup>
const crearItem = () => {
  return navigateTo('../CreateItems')
}

</script>

<style>

</style>