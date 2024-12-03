<template>
  <div class="">
    <header>
      <Alertas></Alertas>
      <LoadingsSpinner :show-spinner="spinnerStore.status"></LoadingsSpinner>
    </header>
    <main class="min-h-screen bg-base-200">
      <slot v-if="!usuarioStore.conectado"></slot>
      <Navbar v-else>
        <div class="container mx-auto">
          <slot></slot>
        </div>
      </Navbar>
    </main>
  </div>
</template>

<script setup lang="ts">
const spinnerStore = SpinnerStore();
const usuarioStore = UsuarioStore();
</script>

<style scoped></style>