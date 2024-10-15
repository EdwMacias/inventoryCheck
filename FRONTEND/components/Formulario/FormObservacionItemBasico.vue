<template>

  <VeeForm :validationSchema="formularioObservacionSchema" @submit="onSubmit" v-slot="{ meta, errors }">


    <div class="mb-2">
      <span class="block mb-2">Fecha Creación *</span>
      <VeeField name="fecha" v-model="formularioObservacion.fecha" type="date"
        :class="`input w-full ${errors.fecha ? 'input-error' : 'input-bordered'}`" />
      <VeeErrorMessage name="fecha" class="text-error animate__animated  animate__fadeIn" />
    </div>

    <div class="mb-2">
      <span class="block mb-2">Observacion *</span>
      <VeeField name="observacion" placeholder="Observacion" v-model="formularioObservacion.observacion" type="text"
        :class="`textarea w-full text-lg  ${errors.observacion ? 'textarea-error' : 'textarea-bordered'}`"
        as="textarea" />
      <VeeErrorMessage name="observacion" class="text-error animate__animated  animate__fadeIn" />
    </div>
    
    <div class="mb-2">
      <span class="mb-2 block">Fotos Observación *</span>
      <ImageUploader @files-selected="handleFilesSelected" />
    </div>


    <ButtonOptions @cancel="navigate" />

  </VeeForm>

</template>

<script lang="ts" setup>
import { ItemOficinaObservacionDTO } from '~/Domain/DTOs/Observaciones/Oficina/ItemOficinaObservacionDTO';

const emits = defineEmits<{
  (event: 'callback', payload: ItemOficinaObservacionDTO): void,
  (event: 'buttonCancel', payload: boolean): void
}>();

const formularioObservacion = ref(new ItemOficinaObservacionDTO(null));

const formularioObservacionSchema = yup.object({
  observacion: yup.string().required('*Campo requerido'),
  fecha: yup.string().required('*Campo requerido'),
});

const handleFilesSelected = (files: File[]) => {
  formularioObservacion.value.resources = files;
};

const onSubmit = (values: any) => {
  const formulario = formularioObservacion.value;
  return emits('callback', formulario);
};

const navigate = () => {
  return emits('buttonCancel', true);
}

</script>

<style></style>