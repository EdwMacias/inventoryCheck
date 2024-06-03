<template>

    <div class="flex flex-col justify-center items-center">
        <kbd class="kbd mt-4">Trabajo en proceso</kbd>
        <Clock class="en-proceso" /></div>
</template>
<style scoped>
.en-proceso{
    height: 50%;
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}


.kbd{
    font-size: 3rem;
    padding: 1rem;
    border-radius: 1rem;
}
</style>

<script setup lang="ts">
const { $swal } = useNuxtApp();

// onMounted(() => {
//     $swal.fire('Hola','A veces te miro','question');
// })

</script>