<template>
  <div class="">
    <div class="card-actions justify-end mx-2">
      <NuxtLink class="btn btn-active btn-neutral gap-2 m-2" to="/registros/inventario">Agregar articulo</NuxtLink>
      <label class="input input-bordered flex items-center gap-2 mt-2 w-96">
        <input type="text" class="grow" placeholder="Buscar" /> 
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
          <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
            clip-rule="evenodd" />
        </svg>
      </label>
    </div>
    <!-- barra de busqueda-->
    <div class="grid grid-cols-[200px_minmax(900px,_1fr)_100px] gap-4 m-4 container flex items-center">
      <Item/>
      <Item/>
    </div>

  </div>
  <!-- <div class="card-actions justify-end me-5">
    <div class="join">
      <button class="join-item btn btn-active">1</button>
      <button class="join-item btn ">2</button>
      <button class="join-item btn">3</button>
      <button class="join-item btn">4</button>
    </div>
  </div> -->

  <!-- espacio para datatable -->
</template>

<script lang="ts" setup>

</script>

<style></style>