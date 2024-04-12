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
import { SpinnerStore } from '~/stores/SpinnerStore';
const spinnerStore = SpinnerStore();
// const active: Ref<boolean> = ref(false);
</script>
