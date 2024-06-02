<template>
    <header>
      <Alertas></Alertas>
      <Spinner v-if="spinnerStore.status"></Spinner>
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

<style scoped>
</style>