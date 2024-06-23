<template>
  <div class="breadcrumbs text-sm mx-5">
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
// import { GET_USUARIOS_ALL } from '~/Infrastructure/Connections/endpoints.connection';
// import { http } from '~/Infrastructure/http/http';
onMounted(async () => {

  // const { data } = await http.get<>(GET_USUARIOS_ALL)
  // datos.value = data;
})
const datos = ref()
const userRole = ref('SUPERADMINISTRADOR')

</script>

<style></style>