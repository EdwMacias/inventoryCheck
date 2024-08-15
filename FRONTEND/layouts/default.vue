<template>
  <header>
    <Alertas></Alertas>
    <LoadingsSpinner v-if="spinnerStore.status"></LoadingsSpinner>

  </header>
  <main :class="{ 'logged-in': usuarioStore.conectado }" >
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
  margin-top: 0px; /* Ajusta este valor según la altura de tu Navbar */
}
main.logged-in {
  margin-top: 70px; /* Ajusta este valor según la altura de tu Navbar */
}
</style>