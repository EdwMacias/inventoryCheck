<template>
  <Spinner v-if="spinnerStore.status"></Spinner>
  <div class="h-screen bg-gray-50">
    <header>
      <Alertas></Alertas>
      <Navbar v-if="usuarioStore.conectado"></Navbar>
    </header>
    <main class="justify-center space-y-12">
      <slot />
    </main>
  </div>
  
</template>

<script setup lang="ts">
const spinnerStore = SpinnerStore();
const usuarioStore = UsuarioStore();
</script>

<style scoped></style>