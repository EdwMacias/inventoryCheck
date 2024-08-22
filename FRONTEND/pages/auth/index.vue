<template>
  <div class="hero bg-base-200 min-h-screen">
    <div class=" hero-content flex flex-col-reverse sm:flex-row ">
      <div class="">
        <button class="btn btn-ghost mb-1"> 
          <Tema  />
        </button>
        <div class="card bg-base-100 max-w-md shrink-0 shadow-2xl">
          <div class="stats shadow">
            <div class="stat">
            <label for= "buzon" class="stat-title">Buzón PQRS</label>
          </div>
            <button class="btn btn-secondary btn-circle fixed-button stat-figure mr-2 " id="buzon" name="buzon de sugerencias" @click="openModal"><SvgInbox /></button>
          </div>
          <FormularioLogin />
        </div>
      </div>
      <div> 
        <p class="py-6">
          <img src="/images/LogoEmpresa.webp" alt="Logo Cedac" class="rounded-xl"></img>
        </p>
      </div>
    </div>
  </div>
  <FormularioPqrs :is-open="isModalOpen" @close="isModalOpen = false" />
</template>
<script setup lang="ts">
definePageMeta({
  path: '/login',
})

const isModalOpen = ref(false);
const openModal = () => {
  isModalOpen.value = true;
};


</script>
<style>

</style>