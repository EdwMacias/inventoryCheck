<template>
      <button @click="openModal" class="btn btn-outline btn-primary btn-sm"> abrir</button>
      <div v-if="isModalOpen" class="modal modal-open">
        <div class="modal-box">
          <h3 class="font-bold text-lg mb-4">Observaciones para el ítem ID: {{ itemId }}</h3>
          <p class="mb-2">Nueva observación:</p>
          <textarea class="textarea textarea-bordered w-full" placeholder="Escribe una observación" v-model="newObservation"></textarea>
          <div v-if="observations.length === 0">
            <p>No hay observaciones disponibles.</p>
          </div>
          <div v-else class="grid grid-cols-1 gap-4">
            <div v-for="observation in observations" :key="observation.itemId" class="card shadow-lg compact bg-base-100">
              <div class="card-body">
                <h2 class="card-title">Observación ID:</h2>
                <p><strong>Observación:</strong></p>
                <p><strong>Realizada por:</strong> </p>
                <p><strong>Tipo de Observación:</strong> </p>
                <p><strong>Fecha de Creación:</strong></p>
                <p><strong>Fecha de Actualización:</strong> </p>
              </div>
            </div>
          </div>
          <div class="modal-action">
            <button @click="" class="btn btn-primary">Agregar</button>
            <button @click="closeModal" class="btn btn-ghost">Cancelar</button>
          </div>
        </div>
      </div>
  </template>

<script setup lang="ts">
import type { ObservationResponse } from '~/Domain/Models/Api/Response/observation.response';
  const route = useRoute();
  const itemId = route.params.id;
  const observations = ref<ObservationResponse[]>([]);
  const isModalOpen = ref(false);
  const newObservation = ref('');
  const openModal = () => {
  isModalOpen.value = true;
  };
  // const openModal = async () => {
  // try {
  //   const response = await observationsService.getObservationsByItemId(itemId);
  //   observations.value = response.data;
  // } catch (error) {
  //   console.error(error);
  // }
  // isModalOpen.value = true;
  // };

  const observation = ref('Observación');


  const closeModal = () => {
  isModalOpen.value = false;
  };

  const handleEscKey = (event: KeyboardEvent) => {
  if (event.key === 'Escape') {
    closeModal();
  }
  };

  onMounted(() => {
  window.addEventListener('keydown', handleEscKey);
  });

  onBeforeUnmount(() => {
  window.removeEventListener('keydown', handleEscKey);
  });
</script>
  
  <style scoped>
  .modal-open {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 50;
  }
  </style>
  