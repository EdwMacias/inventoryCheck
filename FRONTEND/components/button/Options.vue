<template>
  <!-- <div > -->
  <label @click="optionsDeploy" class="btn btn-neutral  rounded-full fixed-button text-2xl "> + </label>

  <div v-if="despliegue" class="button-container">
    <button type="submit" class="btn btn-success rounded-full option-button  tooltip" style="bottom: 50px;left: 10%;"
      @click="handleSave">
      <svg xmlns="http://www.w3.org/2000/svg" width="2em" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M17 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14c1.1 0 2-.9 2-2V7zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3s3 1.34 3 3s-1.34 3-3 3m3-10H5V5h10z">
        </path>
      </svg>

      <span class="tooltiptext">Guardar</span>

    </button>
    <button type="button" class="btn btn-error rounded-full option-button  tooltip" style="bottom: 110px;left: 10%;"
      @click="handleCancel">
      <svg xmlns="http://www.w3.org/2000/svg" class="" width="2em" viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2m0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m3.59-13L12 10.59L8.41 7L7 8.41L10.59 12L7 15.59L8.41 17L12 13.41L15.59 17L17 15.59L13.41 12L17 8.41z">
        </path>
      </svg>


      <span class="tooltiptext">Cancelar</span>

    </button>

    <!-- </nuxtlin> -->
    <!-- <button v-for="(option, index) in despliegue ? options : []" :key="option.id" :class="option.class" 
              :style="getButtonPosition(index)" @click="handleOptionClick(option.name)">
        <component :is="option.svg" />
        <span class="tooltiptext">{{ option.name }}</span>
      </button> -->
  </div>
  <!-- </div> -->
</template>

<script setup lang="ts">
import { ref } from 'vue'

// Importa los componentes manualmente desde la carpeta @components/svg/
import SvgSave from '@/components/svg/Save.vue'
import SvgCancel from '@/components/svg/Cancel.vue'

const emit = defineEmits(['save', 'cancel'])
const handleSave = () => {
  emit('save')
}
const handleCancel = () => {
  emit('cancel')
}

const options = [
  {
    id: 1,
    name: 'Guardar',
    svg: SvgSave,
    class: 'btn btn-success rounded-full option-button  tooltip',
  },
  {
    id: 2,
    name: 'Cancelar',
    svg: SvgCancel,
    class: 'btn btn-error rounded-full option-button  tooltip',
  }
]

// const readTheme = () => {
//   console.log(window.localStorage.getItem('theme'))
// }

const optionsDeploy = () => {
  despliegue.value = !despliegue.value;
  // readTheme()
}

const despliegue = ref(false)

const handleOptionClick = (action: string) => {
  if (action === 'Guardar') {
    handleSave()
  } else if (action === 'Cancelar') {
    handleCancel()
  }
}

// Función para calcular la posición de los botones, desplegándose hacia arriba
const getButtonPosition = (index: number) => {
  const offset = (index + 1) * 60; // Espacio entre los botones, ajustable
  return {
    bottom: `${offset}px`, // Posiciona los botones encima del botón principal
    left: '10%',
  }
}
</script>

<style scoped>
.fixed-button {
  position: fixed;
  right: 20px;
  bottom: 20px;
  z-index: 1000;
  height: 2em;
}

.button-container {
  position: fixed;
  right: 80px;
  bottom: 30px;
  z-index: 1000;

}

.option-button {
  position: absolute;
  z-index: 999;
}

.tooltip .tooltiptext {
  /* Si el tooltip debe estar a la izquierda, ajusta el left */
  left: -100px;
  /* Ajusta según la distancia que quieras respecto al botón */
  top: 50%;
  transform: translateY(-50%);
  visibility: hidden;
  width: 80px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1000;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>