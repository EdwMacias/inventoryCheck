<template>
    asdasdasds
</template>
<style scoped></style>

<script setup lang="ts">
import { http } from '~/infrastructure/http/http';


const { $echo } = useNuxtApp();

const listenSocket = () => {
    $echo.channel('creado')
        .listen('ServerCreated', (e: any) => {
            //   messages.value.push(event.message);
            console.log("hola");

        });
}

onMounted(async () => {
    console.log($echo.socketId());
 
    listenSocket();
    await http.get('item/create').then(() => {
        console.log("ejecuto");

    });
});

</script>