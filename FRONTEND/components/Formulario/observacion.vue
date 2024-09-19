<template>
  <div v-if="isOpen" class="modal modal-open">
    <div class="modal-box">
      <div>
        <h3>Tipo de observación</h3>
        <div class="form-control">
          <label class="cursor-pointer flex items-center space-x-2 my-1">
            <input type="radio" name="service" :value="1" v-model="observation" class="radio checked:bg-yellow-500"
              checked />
            <span class="label-text">Observación</span>
          </label>
          <label class="cursor-pointer flex items-center space-x-2 my-1">
            <input type="radio" name="service" :value="0" v-model="observation" class="radio checked:bg-yellow-500" />
            <span class="label-text">Historial</span>
          </label>
        </div>
      </div>
      <div v-if="observation === 1">
        
      </div>
      <div v-else>

      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import * as yup from 'yup';
const props = defineProps({
  itemId: String,
  openModal: Function,
  isOpen: Boolean
});

const observation = ref<number>(1);
const route = useRoute();
const router = useRouter();
const isModalOpen = ref(false);


const emit = defineEmits(['close']);

const emitClose = () => {
  emit('close');
};


const openModal = () => {
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



const formularioObservacionSchema = yup.object({
  observacion: yup.string().required('*Campo requerido'),
});

const onSubmit = (values: any): void => {
  // Validar el formulario y procesar los datos
  console.log('Datos del formulario:', values);

  // Redirigir o procesar los datos del formulario
  // router.push({ path: '/inventario/items' });
};


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
