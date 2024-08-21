<template>
  <div >
    <label @click="optionsDeploy" class="btn btn-outline rounded-xl fixed-button text-2xl "> + </label>
    <div v-if="despliegue" class="button-container">
      <button v-for="(option, index) in despliegue ? options : []" :key="option.id" :class="option.class" 
              :style="getButtonPosition(index)" @click="handleOptionClick(option.name)">
        <component :is="option.svg" />
        <span class="tooltiptext">{{ option.name }}</span>
      </button>
    </div>
  </div>
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
    class: 'btn btn-outline btn-success rounded-xl option-button  tooltip',
  },
  {
    id: 2,
    name: 'Cancelar',
    svg: SvgCancel,
    class: 'btn btn-outline btn-error rounded-xl option-button  tooltip',
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
  height:2em;
}

.button-container{
  position: fixed;
  right: 68px;
  bottom: 30px;
  z-index: 999;
}

.option-button {
  position: absolute;
  z-index: 999;
}
.tooltip .tooltiptext {
  /* Si el tooltip debe estar a la izquierda, ajusta el left */
  left: -100px; /* Ajusta según la distancia que quieras respecto al botón */
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