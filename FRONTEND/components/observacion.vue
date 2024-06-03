<template>
    <div>
      <button @click="openModal" class="btn btn-primary">Mostrar Observaciones</button>
  
      <div v-if="isModalOpen" class="modal modal-open">
        <div class="modal-box">
          <h3 class="font-bold text-lg mb-4">Observaciones para el ítem ID: {{ itemId }}</h3>
          <p class="mb-2">Nueva observación:</p>
          <textarea class="textarea textarea-bordered w-full" placeholder="Escribe una observación" v-model="newObservation"></textarea>
          <div v-if="observations.length === 0">
            <p>No hay observaciones disponibles.</p>
          </div>
          <div v-else class="grid grid-cols-1 gap-4">
            <div v-for="observation in observations" :key="observation.item_observation_id" class="card shadow-lg compact bg-base-100">
              <div class="card-body">
                <h2 class="card-title">Observación ID: {{ observation.item_observation_id }}</h2>
                <p><strong>Observación:</strong> {{ observation.observation }}</p>
                <p><strong>Realizada por:</strong> {{ observation.user.name }}</p>
                <p><strong>Tipo de Observación:</strong> {{ observation.types_observation_id }}</p>
                <p><strong>Fecha de Creación:</strong> {{ observation.created_at }}</p>
                <p><strong>Fecha de Actualización:</strong> {{ observation.updated_at }}</p>
              </div>
            </div>
          </div>
          <div class="modal-action">
            <button @click="addObservation" class="btn btn-primary">Agregar</button>
            <button @click="closeModal" class="btn btn-ghost">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">

const route = useRoute();
const itemId = route.params.id;
const observations = ref([]);
const isModalOpen = ref(false);
const newObservation = ref('');

const openModal = async () => {
  try {
    const response = await observationsService.getObservationsByItemId(itemId);
    observations.value = response.data;
  } catch (error) {
    console.error(error);
  }
  isModalOpen.value = true;
};

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
  