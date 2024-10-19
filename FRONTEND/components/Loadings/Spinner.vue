<template>
  <div :class="{ 'hidden': !mostrarSpinner }" class="relative" style="z-index: 10000;">
    <div class="absolute inset-0 flex justify-center items-center">
      <div class="fixed z-50 flex justify-center items-center inset-0 bg-black opacity-50">
        <span class="loading loading-ball loading-xs bg-white h-16"></span>
        <span class="loading loading-ball loading-sm bg-white h-16"></span>
        <span class="loading loading-ball loading-md bg-white h-16"></span>
        <span class="loading loading-ball loading-lg bg-white h-16"></span>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>

// Propiedad reactiva para controlar la visibilidad del spinner
const mostrarSpinner = ref(false);
const props = defineProps<{
  showSpinner: boolean
}>();
// Función para mostrar o esconder el spinner (ejemplo)
const toggleSpinner = () => {
  mostrarSpinner.value = !mostrarSpinner.value;
}

watch(() => props.showSpinner, (newValue) => {
  mostrarSpinner.value = newValue;
});


</script>

<style scoped>
.hidden {
  display: none;
}
</style>
