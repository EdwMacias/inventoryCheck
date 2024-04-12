<template>
  <div class="min-h-screen bg-base-200">
    <header>
      <Navbar v-if="usuarioStore.conectado"/>
    </header>
    <main>
      <Alertas></Alertas>
      <Spinner v-if="spinnerStore.status"></Spinner>
      <slot />
    </main>
  </div>
</template>

<script setup lang="ts">
const spinnerStore = SpinnerStore();
const usuarioStore = UsuarioStore();
</script>

<style scoped></style>