<template>
  
  <div class="breadcrumbs text-lg mx-5">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/terceros/">Terceros</NuxtLink>
      </li>
      <li>
        <a>Registrar</a>
      </li>
    </ul>
  </div>

  <div class="bg-base-100 container mx-auto rounded-lg p-3">
    <FormularioTerceros @cancel="pushBack"></FormularioTerceros>
  </div>

</template>

<script lang="ts" setup>
const router = useRouter();

function pushBack() {
  router.push('/terceros/')
}

</script>

<style></style>