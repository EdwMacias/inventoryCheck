<template>
  <!-- <div> -->
  <VeeForm :validationSchema="formularioObservacionSchema" @submit="onSubmit" v-slot="{ meta, errors }">

    <div class="grid lg:grid-cols-2 grid-cols-1  gap-1 lg:gap-2">

      <div class="mb-2 mt-4 ">
        <label for="label">
          <span class="block">Fecha Creación *</span>
        </label>
        <VeeField name="fecha" v-model="formularioObservacion.fecha" type="date"
          :class="`input w-full ${errors.fecha ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="fecha" class="text-error animate__animated  animate__fadeIn" />
      </div>


      <div class="mb-2">
        <label class="label">
          <span class='block'>Tipo de Observación *</span>
        </label>
        <VeeField name="tipoObservacionId" v-model="formularioObservacion.tipoObservacionId" as="select"
          :class="`select  w-full ${errors.tipoObservacionId ? 'select-error' : 'select-bordered'}`">
          <option value="0" disabled>Seleccione</option>
          <option value="1">Masculino</option>
          <option value="2">Femenino</option>
        </VeeField>
        <VeeErrorMessage name="tipoObservacionId" class="text-error animate__animated  animate__fadeIn">
        </VeeErrorMessage>

      </div>


    </div>
    <div class="mb-2">
      <label for="label">
        <span class="block">Observacion *</span>
      </label>
      <VeeField name="observacion" placeholder="Observacion" v-model="formularioObservacion.observacion" type="text"
        :class="`textarea w-full text-lg  ${errors.observacion ? 'textarea-error' : 'textarea-bordered'}`"
        as="textarea" />
      <VeeErrorMessage name="observacion" class="text-error animate__animated  animate__fadeIn" />
    </div>
    <div class="mb-2">
      <label class="label">
        <span class="block text-md">Fotos Observación *</span>
      </label>
      <ImageUploader @files-selected="" />
    </div>


    <ButtonOptions @cancel="true" />

  </VeeForm>



  <!-- </div> -->
</template>

<script lang="ts" setup>
import { ItemOficinaObservacionDTO } from '~/Domain/DTOs/Observaciones/Oficina/ItemOficinaObservacionDTO';

const emits = defineEmits<{
  (event: 'callback', payload: ItemOficinaObservacionDTO): void
}>();
const formularioObservacion = ref(new ItemOficinaObservacionDTO(null));

const formularioObservacionSchema = yup.object({
  observacion: yup.string().required('*Campo requerido'),
  fecha: yup.string().required('*Campo requerido'),
  tipoObservacionId: yup.string().required('*Campo requerido').notOneOf(['0'], 'Seleccione una opcion valida*'), // Validación para que no sea "0"
});

const onSubmit = (values: any) => {
  return emits('callback', formularioObservacion.value);
};

</script>

<style></style>