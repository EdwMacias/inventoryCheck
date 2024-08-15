<template>
  <div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Observaciones del Item: {{ itemId }}</h1>
    <img src="/images/LogoEmpresa.webp" alt="Logo de la empresa" width="200">
    <div class="grid grid-cols-1 gap-4">
      <div v-for="observation in observations" :key="observation.item_observation_id"
        class="card shadow-lg compact bg-base-100">
        <div class="card-body">
          <h2 class="card-title">Observation ID: {{ observation.item_observation_id }}</h2>
          <p><strong>Observation:</strong> {{ observation.observation }}</p>
          <p v-show="user.type === 'admin'"><strong>Hecha por:</strong> {{ observation.user.name }}</p>
          <!-- Cambiado para mostrar el nombre del usuario y no el ID-->
          <p><strong>Tipo de observación:</strong> {{ observation.types_observation_id }}</p>
          <form action="">
            <button class="btn btn-primary">Agregar observación
            </button>
            <button class="btn btn-primary"> adjuntar archivos</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</template>

<script setup>


const route = useRoute();
const itemId = route.params.id;
const observations = ref([]);
const user = ref({});



</script>