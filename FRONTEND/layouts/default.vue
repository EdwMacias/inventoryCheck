<template>
  <header>
  </header>
  <main>
    <Alertas></Alertas>
    <Spinner v-if="spinnerStore.status"></Spinner>
    <slot />
  </main>
</template>

<script setup lang="ts">
const spinnerStore = SpinnerStore();
</script>

<style scoped></style>