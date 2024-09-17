<template>
    <div class="flex flex-col  items-center m-2 p-2 mt-20">
        <NuxtLink to="/inventario/items/" class="kbd"><button>Inventario</button></NuxtLink>
        <NuxtLink to="/usuarios/" class="kbd"><button>Usuarios</button></NuxtLink>
      
    </div>
</template>
<style scoped>
.en-proceso {
    height: 50%;
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.kbd {
    font-size: 3rem;
    padding: 1rem;
    border-radius: 1rem;
}
</style>

<script setup lang="ts">
function handleFiles(files: File[]) {
    console.log(files);
    // Aquí puedes manejar los archivos, subirlos al servidor, etc.
}
</script>