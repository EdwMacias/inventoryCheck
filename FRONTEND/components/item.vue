<template>
  <!-- <div class="card bg-base-100 m-2 shadow-xl w-72 me-2">
    <figure>
      <img :src="foto" :alt="titulo" />
    </figure>
    <div class="card-body">
      <h2 class="card-title">{{ titulo }}</h2>
      <p>{{ observacion }}</p>
      <div class="card-actions justify-end">
        <button class="btn btn-primary" @click="agregarObservacion">Agregar observación</button>
      </div>
    </div>
  </div> 
  <div class="container mx-auto p-4">
    <div class="grid grid-cols-[200px_minmax(900px,_1fr)_100px] gap-4 m-4">
      
      <div v-for="item in items" :key="item.id" class="card bg-base-100 m-2 shadow-xl w-72">
        <figure>
          <img :src="item.foto" :alt="item.titulo" />
        </figure>
        <div class="card-body">
          <h2 class="card-title">{{ item.titulo }}</h2>
          <p>{{ item.observacion }}</p>
          <div class="card-actions justify-end">
            <button class="btn btn-primary" @click="agregarObservacion(item.id)">Agregar observación</button>
          </div>
        </div>
      </div>
    </div>
  </div> -->
   <div class="container mx-auto p-4">
    <div class="grid grid-cols-[200px_minmax(900px,_1fr)_100px] gap-4 m-4">
      <div class="card bg-base-100 m-2 shadow-xl w-72">
        <figure>
          <img :src="foto" :alt="titulo" />
        </figure>
        <div class="card-body">
          <h2 class="card-title">{{ titulo }}</h2>
          <p>{{ observacion }}</p>
          <div class="card-actions justify-end">
            <button class="btn btn-primary" @click="agregarObservacion">Agregar observación</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
  const props = defineProps({
    id: String,
    titulo: String,
    observacion: String,
    foto: String
  });

  const agregarObservacion = () => {
    console.log('Observacion agregada');
  };
</script>

<style scoped>
.container {
  @apply mx-auto p-4;
}

.grid {
  @apply grid-cols-[200px_minmax(900px,_1fr)_100px] gap-4 m-4;
}

.card {
  @apply bg-base-100 m-2 shadow-xl w-72;
}

.card-actions {
  @apply justify-end;
}
</style>