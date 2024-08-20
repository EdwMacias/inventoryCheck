<template>
  <FormularioPqrs :is-open="isModalOpen" @close="isModalOpen = false" />
  <div class="hero bg-base-200 min-h-screen">
    <div class="hero-content flex-col lg:flex-row-reverse">
      <div class="text-center lg:text-left">
        <label for= "buzon">Buzón</label>
        <button class="btn btn-primary btn-circle fixed-button" id="buzon" name="buzon de sugerencias" @click="openModal"><SvgInbox /></button>
      </div>
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

const isModalOpen = ref(false);
const openModal = () => {
  isModalOpen.value = true;
};
const closeModal = () => {
  isModalOpen.value = false;
};

</script>
<style>

</style>