<template>
  <div class="breadcrumbs text-lg mx-5">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>Asignar Roles</li>
    </ul>
  </div>
  <div v-if="userRole = 'ADMINISTRADOR' || 'SUPERADMINISTRADOR'">
    <p>holi</p>
    <p>{{ datos }}</p>
    <form action="">
      <p v-for="datos in datos">Información de usuario: {{ datos.name }}</p>

      <input type="text">
    </form>
  </div>
</template>

<script lang="ts" setup>
definePageMeta({
  middleware: 'auth-middleware'
})
onMounted(async () => {
})
const datos = ref()
const userRole = ref('SUPERADMINISTRADOR')

</script>

<style></style>