<template>
  <label class="flex cursor-pointer gap-2 items-center">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
      stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <circle cx="12" cy="12" r="5" />
      <path d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" />
    </svg>
    <input type="checkbox" :checked="isDarkTheme" @change="toggleTheme" class="toggle theme-controller" />
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
      stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
    </svg>
  </label>
</template>

<script setup lang="ts">

const themes = ['emerald', 'dracula']; // Temas disponibles
const currentTheme = ref(themes[0]);
const isDarkTheme = ref(false);

// Función para cambiar el tema
const toggleTheme = () => {
  const nextTheme = themes[(themes.indexOf(currentTheme.value) + 1) % themes.length];
  currentTheme.value = nextTheme;
  isDarkTheme.value = nextTheme === 'dracula';
  document.documentElement.setAttribute('data-theme', nextTheme);

  if (typeof window !== 'undefined' && window.localStorage) {
    window.localStorage.setItem('theme', nextTheme);
  }
};

// Ejecutar al montar el componente
onMounted(() => {
  if (typeof window !== 'undefined' && window.localStorage) {
    const savedTheme = window.localStorage.getItem('theme');
    if (savedTheme && themes.includes(savedTheme)) {
      currentTheme.value = savedTheme;
      isDarkTheme.value = savedTheme === 'dracula';
      document.documentElement.setAttribute('data-theme', savedTheme);
    }
  }
});
</script>
