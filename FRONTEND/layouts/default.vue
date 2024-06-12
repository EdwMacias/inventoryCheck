<template>
  <header>
    <Alertas></Alertas>
    <LoadingsSpinner v-if="spinnerStore.status"></LoadingsSpinner>
    <Navbar v-if="usuarioStore.conectado"></Navbar>
  </header>
  <main class="">
    <slot></slot>
  </main>

</template>

<script setup lang="ts">
const spinnerStore = SpinnerStore();
const usuarioStore = UsuarioStore();
</script>

<style scoped></style>