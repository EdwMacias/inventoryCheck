<template>
  <header>
    <Alertas></Alertas>
    <LoadingsSpinner v-if="spinnerStore.status"></LoadingsSpinner>

  </header>
  <main>
    <Navbar v-if="usuarioStore.conectado" >
      <slot></slot>
    </Navbar>
    <div v-else>
      <slot></slot>
    </div>
  </main>
</template>

<script setup lang="ts">
const spinnerStore = SpinnerStore();
const usuarioStore = UsuarioStore();
</script>

<style scoped>
main {
  margin-top: 65px; /* Ajusta este valor según la altura de tu Navbar */
}
</style>