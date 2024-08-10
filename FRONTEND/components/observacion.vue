<template>
  <button @click="openModal" class="btn btn-primary btn-sm">Crear</button>
  <div v-if="isModalOpen" class="modal modal-open">
    <div class="modal-box">
      <div>
        <h3>Tipo de observación</h3>
        <div class="form-control">
          <label class="cursor-pointer flex items-center space-x-2 my-1">
            <input type="radio" name="service" :value="1" v-model="observation" class="radio checked:bg-yellow-500" checked />
            <span class="label-text">Observación</span>
          </label>
          <label class="cursor-pointer flex items-center space-x-2 my-1">
            <input type="radio" name="service" :value="0" v-model="observation" class="radio checked:bg-yellow-500" />
            <span class="label-text">Historial</span>
          </label>
        </div>
      </div>
      <div v-if="observation === 1">
        <input type="text" v-model="formularioObservacion.id" disabled class="input">
        <p>Observación:</p>
        <VeeForm :validationSchema="formularioObservacionSchema" @submit="onSubmit" v-slot="{ meta, errors }">
          <VeeField name="observacion" v-model="formularioObservacion.observacion" type="text"
            :class="`input w-full ${errors.observacion ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="observacion" class="text-error" />
          <button type="submit" class="btn btn-primary" :disabled="!meta.valid">Agregar</button>
          <button @click="closeModal" class="btn btn-ghost">Cancelar</button>
        </VeeForm>
      </div>
      <div v-else>
        <h3 class="font-bold text-lg mb-4">Observaciones para el ítem ID: {{ formularioHistorial.id }}</h3>
        <VeeForm :validationSchema="formularioHistorialSchema" @submit="onSubmit" v-slot="{ meta, errors }">
          <div>
            <label class="label">Fecha de ejecución</label>
            <VeeField name="fecha" v-model="formularioHistorial.fecha" type="date"
              :class="`input w-full ${errors.fecha ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="fecha" class="text-error" />
          </div>
          <div class="form-control">
            <label class="cursor-pointer flex items-center space-x-2 my-1">
              <input type="radio" name="service" value="mantenimiento" v-model="formularioHistorial.asunto" class="radio checked:bg-yellow-500" checked />
              <span class="label-text">Mantenimiento</span>
            </label>
            <label class="cursor-pointer flex items-center space-x-2 my-1">
              <input type="radio" name="service" value="verificacion" v-model="formularioHistorial.asunto" class="radio checked:bg-green-500" />
              <span class="label-text">Verificación</span>
            </label>
            <label class="cursor-pointer flex items-center space-x-2 my-1">
              <input type="radio" name="service" value="calibracion" v-model="formularioHistorial.asunto" class="radio checked:bg-red-500" />
              <span class="label-text">Calibración</span>
            </label>
          </div>
          <div>
            <label class="label">Descripción</label>
            <VeeField name="descripcion" v-model="formularioHistorial.descripcion"
              :class="`input w-full ${errors.descripcion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="descripcion" class="text-error" />
          </div>
          <div>
            <label class="label">Estado</label>
            <VeeField name="estado" v-model="formularioHistorial.estado" as="select"
              :class="`select w-full ${errors.estado ? 'select-error' : 'select-bordered'}`" >
              <option value=""> </option>
              <option value="correcto">Correcto</option>
              <option value="suspendido">Suspendido</option>
              <option value="incorrecto">Incorrecto</option>
            </VeeField>
            <VeeErrorMessage name="estado" class="text-error" />
          </div>
          <div>
            <label class="label">Responsable</label>
            <VeeField name="responsable" v-model="formularioHistorial.responsable"
              :class="`input w-full ${errors.responsable ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="responsable" class="text-error" />
          </div>
          <div>
            <label class="label">Firma</label>
            <Signs />
          </div>
          <div>
            <label class="label">Próxima actividad</label>
            <VeeField name="proxAct" v-model="formularioHistorial.proxAct" type="date"
              :class="`input w-full ${errors.proxAct ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="proxAct" class="text-error" />
          </div>
          <div>
            <button type="submit" class="btn btn-primary" :disabled="!meta.valid">Agregar</button>
            <button @click="closeModal" class="btn btn-ghost">Cancelar</button>
          </div>
          <div v-if="errors">{{ errors }}</div>
        </VeeForm>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import * as yup from 'yup';

const props = defineProps({
  itemId: String
});

const observation = ref<number>(1);
const route = useRoute();
const router = useRouter();
const isModalOpen = ref(false);
const formularioHistorial = ref({
  id: route.params.id,
  fecha: '',
  asunto: '',
  observacion: '',
  descripcion: '',
  estado: '',
  responsable: '',
  firma: '',
  proxAct: '',
});

const formularioObservacion = ref({
  id: route.params.id,
  observacion: '',
  estado: '',
});


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

const formularioHistorialSchema = yup.object({
  fecha: yup.string().required('*Campo requerido'),
  descripcion: yup.string().required('*Campo requerido'),
  estado: yup.string().required('*Campo requerido'),
  responsable: yup.string().required('*Campo requerido'),
  proxAct: yup.string().required('*Campo requerido'),
});

const formularioObservacionSchema = yup.object({
  observacion: yup.string().required('*Campo requerido'),
  estado: yup.string().required('*Campo requerido'),
});

const onSubmit = (values: any) => {
  console.log(values);
  router.push({ path: '/' });
  return;
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
