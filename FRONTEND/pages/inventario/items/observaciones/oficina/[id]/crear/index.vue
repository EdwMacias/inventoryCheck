<template>
  <div class="breadcrumbs text-lg mx-5 mt-20">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/inventario/items/">Inventario</NuxtLink>
      </li>
      <li>
        <NuxtLink :to="`/inventario/items/observaciones/oficina/${route.params.id}`"> Observación Item Oficina
        </NuxtLink>
      </li>
      <li>
        Crear
      </li>
    </ul>
  </div>
  <div class="mt-2">
    <div class="container  mx-auto bg-base-100 p-5 rounded-lg">
      <p>Formulario Observación Item Oficina</p>
      <FormularioFormObservacionItemBasico></FormularioFormObservacionItemBasico>
    </div>
  </div>
</template>

<script lang="ts" setup>
const route = useRoute();
const router = useRouter();

</script>

<style></style>