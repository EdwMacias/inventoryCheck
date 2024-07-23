<template>
  <button @click="openModal" class="btn btn-primary btn-sm"> Crear</button>
  <div v-if="isModalOpen" class="modal modal-open">
    <div class="modal-box">
      <h3 class="font-bold text-lg mb-4">Observaciones para el ítem ID: {{ route.params.id }}</h3>
        <VeeForm :validationSchema="formularioObservacionSchema" @submit="onSubmit" v-slot="{ meta, errors }">
          <div>
            <label class="label">Fecha de ejecucion</label>
            <VeeField name="fecha" v-model="formulario.fecha" type="date"
              :class="`input w-full ${errors.fecha ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="fecha" class="text-error" />
          </div>
          <div class="form-control">
            <label class="cursor-pointer flex items-center space-x-2 my-1">
              <input type="radio" name="service" value="mantenimiento" v-model="formulario.asunto" class="radio checked:bg-yellow-500" checked/>
              <span class="label-text">Mantenimiento</span>
            </label>
            <label class="cursor-pointer flex items-center space-x-2 my-1">
              <input type="radio" name="service" value="verificacion" v-model="formulario.asunto" class="radio checked:bg-green-500" />
              <span class="label-text">Verificación</span>
            </label>
            <label class="cursor-pointer flex items-center space-x-2 my-1">
              <input type="radio" name="service" value="calibracion" v-model="formulario.asunto" class="radio checked:bg-red-500" />
              <span class="label-text">Calibración</span>
            </label>
          </div>
          <div>
            <label class="label">Descripción</label>
            <VeeField name="descripcion" v-model="formulario.descripcion"
              :class="`input w-full ${errors.descripcion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="descripcion" class="text-error" />
          </div>
          <div>
            <label class="label">Estado</label>
            <VeeField name="estado" v-model="formulario.estado"
              :class="`input w-full ${errors.estado ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="estado" class="text-error" />
          </div>
          <div>
            <label class="label">Responsable</label>
            <VeeField name="responsable" v-model="formulario.responsable"
              :class="`input w-full ${errors.responsable ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="responsable" class="text-error" />
          </div>
          <div>
            <label class="label">Próxima Acción</label>
            <VeeField name="proxAct" v-model="formulario.proxAct"
              :class="`input w-full ${errors.proxAct ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="proxAct" class="text-error" />
          </div>
          <div>
            <label class="label">Procedimiento de verificación</label>
            <VeeField name="procedimiento_verificacion" v-model="formulario.procedimiento_verificacion" type="date"
              :class="`input w-full ${errors.procedimiento_verificacion ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="procedimiento_verificacion" class="text-error" />
          </div>
          <div>
            <label class="label">Firma</label>
            <canvas ref="canvasRef" width="400" height="200" style="border:1px solid #000000; border-radius: 10px;"></canvas>
          </div>
          <div>
            <button type="button" class="btn btn-primary" @click="clearSignature">Limpiar Firma</button>
          </div>
          <div>
            <button type="submit" class="btn btn-primary" :disabled="!meta.valid">Agregar</button>
            <button @click="closeModal" class="btn btn-ghost">Cancelar</button>
          </div>
          <div v-if="errors">{{ errors }}</div>
        </VeeForm>
      </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { useRoute } from 'vue-router';
import * as yup from 'yup';
import { useSignaturePad } from '~/composables/useSignaturePad';

const route = useRoute();
const isModalOpen = ref(false);
const formulario = ref({
  id: route.params.id,
  fecha: '',
  asunto: '',
  descripcion: '',
  estado: '',
  responsable: '',
  firma: '',
  proxAct: '',
  procedimiento_verificacion: '',
});

const { canvasRef, clearSignature, getSignatureDataURL } = useSignaturePad();

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
  fecha: yup.string().required('*Campo requerido'),
  descripcion: yup.string().required('*Campo requerido'),
  estado: yup.string().required('*Campo requerido'),
  responsable: yup.string().required('*Campo requerido'),
  proxAct: yup.string().required('*Campo requerido'),
  procedimiento_verificacion: yup.string().required('*Campo requerido'),
});

const onSubmit = (values: any) => {
  formulario.value.firma = getSignatureDataURL() || '';
  console.log(values);
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
