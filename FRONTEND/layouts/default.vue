<template>
  <div class="h-screen bg-gray-50">
    <header>
      <Alertas></Alertas>
      <Navbar v-if="usuarioStore.conectado"></Navbar>
    </header>
    <main class="justify-center space-y-12">
      <Spinner v-if="spinnerStore.status"></Spinner>
      <slot />
    </main>
  </div>
</template>

<script setup lang="ts">
const spinnerStore = SpinnerStore();
const usuarioStore = UsuarioStore();
</script>

<style></style>