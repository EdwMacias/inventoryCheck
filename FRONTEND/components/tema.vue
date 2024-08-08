<template>
    <select class="select" v-model="currentTheme" @change="applyTheme">
      <option disabled selected>Pick your theme</option>
      <option v-for="theme in themes" :key="theme" :value="theme">{{ theme }}</option>
    </select>
</template>

<script setup lang="ts">

const themes = [  "light", "dark", "cupcake", "bumblebee", "emerald", "corporate", "synthwave", "retro", "cyberpunk", "valentine",  "halloween", "garden", "forest", "aqua", "lofi", "pastel", "fantasy", "wireframe", "black", "luxury", "dracula","cmyk", "autumn", "business", "acid", "lemonade", "night", "coffee", "winter", "dim", "nord", "sunset"];
const currentTheme = ref(themes[0]);
const isDarkTheme = ref(false);

const applyTheme = () => {
  document.documentElement.setAttribute('data-theme', currentTheme.value);
  isDarkTheme.value = currentTheme.value === 'dark';

  if (typeof window !== 'undefined' && window.localStorage) {
    window.localStorage.setItem('theme', currentTheme.value);
  }
};

// Ejecutar al montar el componente
onMounted(() => {
  if (typeof window !== 'undefined' && window.localStorage) {
    const savedTheme = window.localStorage.getItem('theme');
    if (savedTheme && themes.includes(savedTheme)) {
      currentTheme.value = savedTheme;
      isDarkTheme.value = savedTheme === 'dark';
      document.documentElement.setAttribute('data-theme', savedTheme);
    }
  }
});
</script>
