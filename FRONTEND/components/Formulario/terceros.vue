<template>
  <VeeForm :validation-schema="formSchema" @submit="onSubmit" v-slot="{ errors }">
    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-1">
      <div class="border p-1">
        <label class="label">
          <span class="block text-md">Fecha *</span>
        </label>
        <VeeField name="fecha" type="date" v-model="formulario.fecha"
          :class="`input w-full ${errors.fecha ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="fecha" class="text-error text-sm animate__fadeIn" />
      </div>
      <div class="border p-1" >
        <label class="label">
          <span class="block text-md">Tipo de Documento *</span>
        </label>
        <div class="">
          <VeeField name="tipoDocumento" type="radio" value="CC" v-model="formulario.tipoDocumento"/> CC
          <VeeField name="tipoDocumento" type="radio" value="Pasaporte" v-model="formulario.tipoDocumento" /> Pasaporte
          <VeeField name="tipoDocumento" type="radio" value="CE" v-model="formulario.tipoDocumento" /> CE
          <VeeField name="tipoDocumento" type="radio" value="NIT" v-model="formulario.tipoDocumento" /> NIT

        </div>
        <!--<VeeField name="tipoDocumento" v-model="formulario.tipoDocumento" :class="`radio  w-full  ${errors.gender_id ? 'select-error' : 'select-bordered'}`" as="radio">
          <label class="flex items-center gap-2"><VeeField type="radio" value="CC" />CC </label>
          <VeeField type="radio" value="Pasaporte">Pasaporte </VeeField>        
          <VeeField type="radio" value="CE" > CE </VeeField>      
          <VeeField type="radio" value="NIT" > NIT </VeeField>
        </VeeField> -->
        <VeeErrorMessage name="tipoDocumento" class="text-error text-sm animate__fadeIn" />
      </div>
      <div class="border p-1">
        <label class="label">
          <span class="block text-md">Tipo de Persona *</span>
        </label>
        <VeeField name="tipoPersona" type="radio" value="N" v-model="formulario.tipoPersona" /> Natural
        <VeeField name="tipoPersona" type="radio" value="J" v-model="formulario.tipoPersona" /> Jurídica
        <VeeErrorMessage name="tipoPersona" class="text-error text-sm animate__fadeIn" />
      </div>
      <div class="border p-1">
        <label class="label">
          <span class="block text-md">Número de Documento *</span>
        </label>
        <VeeField name="numeroDocumento" type="text" placeholder="Ingrese el número" v-model="formulario.numeroDocumento"
          :class="`input w-full ${errors.numeroDocumento ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="numeroDocumento" class="text-error text-sm animate__fadeIn" />
      </div>
      <div class="border p-1">
        <label class="label">
          <span class="block text-md">Nombre Completo / Razón Social *</span>
        </label>
        <VeeField name="nombreCompleto" type="text" placeholder="Ej. Juan Pérez" v-model="formulario.nombreCompleto"
          :class="`input w-full ${errors.nombreCompleto ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="nombreCompleto" class="text-error text-sm animate__fadeIn" />
      </div>
      <div class="border p-1">
        <label class="label">
          <span class="block text-md">Correo Electrónico *</span>
        </label>
        <VeeField name="correo" type="email" placeholder="ejemplo@correo.com" v-model="formulario.correo"
          :class="`input w-full ${errors.correo ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="correo" class="text-error text-sm animate__fadeIn" />
      </div>
      <div class="border p-1">
        <label class="label">
          <span class="block text-md">Dirección *</span>
        </label>
        <VeeField name="direccion" type="text" placeholder="Ej. Calle 123" v-model="formulario.direccion"
          :class="`input w-full ${errors.direccion ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="direccion" class="text-error text-sm animate__fadeIn" />
      </div>
      <div class="border p-1">
        <label class="label">
          <span class="block text-md">Ciudad *</span>
        </label>
        <VeeField name="ciudad" type="text" placeholder="Ingrese la ciudad" v-model="formulario.ciudad"
          :class="`input w-full ${errors.ciudad ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="ciudad" class="text-error text-sm animate__fadeIn" />
      </div>
      <div class="border p-1">
        <label class="label">
          <span class="block text-md">Teléfono *</span>
        </label>
        <VeeField name="telefono" type="text" placeholder="Ej. 123456789" v-model="formulario.telefono"
          :class="`input w-full ${errors.telefono ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="telefono" class="text-error text-sm animate__fadeIn" />
      </div>
    </div>
    <div class="mt-6">
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">Enviar</button>
    </div>
  </VeeForm>
</template>

<script lang="ts" setup>
import * as yup from 'yup';
import { ref } from 'vue';

const formulario = ref({
  fecha: '',
  tipoDocumento: '',
  tipoPersona: '',
  numeroDocumento: '',
  nombreCompleto: '',
  correo: '',
  direccion: '',
  ciudad: '',
  telefono: '',
});

const formSchema = yup.object({
  fecha: yup.date().required('La fecha es obligatoria'),
  tipoDocumento: yup.string().required('Debe seleccionar un tipo de documento'),
  tipoPersona: yup.string().required('Debe seleccionar un tipo de persona'),
  numeroDocumento: yup.string().required('El número de documento es obligatorio'),
  nombreCompleto: yup.string().required('El nombre completo es obligatorio'),
  correo: yup.string().email('El correo debe ser válido').required('El correo es obligatorio'),
  direccion: yup.string().required('La dirección es obligatoria'),
  ciudad: yup.string().required('La ciudad es obligatoria'),
  telefono: yup.string().required('El teléfono es obligatorio'),
});

const onSubmit = (values: any) => {
  console.log('Formulario enviado:', values);
};
</script>

<style scoped></style>
