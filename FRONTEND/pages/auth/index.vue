<template>
  <div class="hero bg-base-200 min-h-screen">
    <div class="hero-content flex-col lg:flex-row-reverse">
      <div class="text-center lg:text-left">
        <p class="py-6">
          <img src="/images/LogoEmpresa.webp" alt="Dashwind Admin Template" class="w-100 inline-block rounded-xl"></img>
        </p>
      </div>
      <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
        <FormularioLogin />
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
definePageMeta({
  path: '/login',
})
</script>
<style>

</style>