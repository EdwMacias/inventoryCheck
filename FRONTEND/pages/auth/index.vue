<template>
  <div class="hero bg-base-200 min-h-screen">
    <div class=" hero-content flex flex-col-reverse lg:flex-row items-center justify-center">
      <div class="w-full lg:min-w-[500px]">
        <div class="text-center">
          <button class="btn btn-ghost mb-1">
            <Tema />
          </button>
        </div>
        <div class="card bg-base-100 shadow-2xl">
          <div class="stats shadow">
            <div class="stat">
              <label for="buzon" class="stat-title">Buzón PQRS</label>
            </div>
            <button class="btn btn-secondary btn-circle fixed-button stat-figure mr-2 " id="buzon"
              name="buzon de sugerencias" @click="openModal">
              <SvgInbox />
            </button>
          </div>
          <FormularioLogin />
        </div>
      </div>
      <div>
        <p class="pt-8">
          <img src="/images/LogoEmpresa.webp" alt="Logo Cedac" class="rounded-xl w-full"></img>
        </p>
      </div>
    </div>
  </div>
  <FormularioPqrs :is-open="isModalOpen" @close="isModalOpen = false" @callback="PqrsService.create" />
</template>
<script setup lang="ts">
import { PqrsService } from '~/Domain/Client/Services/pqrs/pqrs.service';
definePageMeta({
  path: '/login',
})

const isModalOpen = ref(false);
const openModal = () => {
  isModalOpen.value = true;
};
onMounted(()=>{
  // UsuarioStore().clearStore();
})


</script>
<style></style>