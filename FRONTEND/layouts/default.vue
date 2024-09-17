<template>
  <div class="">
    <header>
      <Alertas></Alertas>
      <LoadingsSpinner v-if="spinnerStore.status"></LoadingsSpinner>
    </header>
    <main class="min-h-screen bg-base-200">

      <Navbar v-if="usuarioStore.conectado">
        <slot></slot>
      </Navbar>

      <slot v-else></slot>

    </main>
  </div>
</template>

<script setup lang="ts">
const spinnerStore = SpinnerStore();
const usuarioStore = UsuarioStore();
</script>

<style scoped>

</style>