<template>
    <div >
        <p>bienvenido</p>
    </div>
</template>

<script setup lang="ts">
definePageMeta({
  middleware : ["auth-middleware"]
})
onMounted(async () => {

})

</script>