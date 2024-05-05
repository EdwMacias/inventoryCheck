<template>
<h1>¿Olvidaste tu contraseña?</h1>

</template>

<script lang="ts" setup>
definePageMeta({
  path: '/forgot-password',
  middleware: ["login-middleware"]
})
</script>