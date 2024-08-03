<template>
  <div class="breadcrumbs text-lg mx-5">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        Usuarios
      </li>
      <li>
        <NuxtLink to="/usuarios">Gestion Usuarios</NuxtLink>
      </li>
      <li>
        {{ capitalizarPrimeraLetra(path) }}
      </li>
    </ul>
  </div>
  <div class="lg:container lg:mx-auto p-5">
    <FormularioRegistro></FormularioRegistro>
  </div>
</template>

<script lang="ts" setup>
const route = useRoute();

definePageMeta({
  middleware: ['actions-middleware']
})
const path: Ref<string> = ref('');

onMounted(() => {
  if (typeof route.params.id == 'string') path.value = route.params.id
})

</script>

<style></style>