<template>
  <VeeForm :validationSchema="formularioSchema" class="mt-5">
    <h2 class="text-center font-semibold text-xl text-gray-900 mb-2">Información Personal</h2>
    <p class="text-center text-sm text-gray-600 mb-4">Utiliza una dirección permanente donde puedas recibir correo.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
      <div>
        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Nombre</label>
        <VeeField name="first-name" type="text" placeholder="Carlos Mariano" class="input input-bordered w-full mt-1" />
        <VeeErrorMessage name="first-name" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
      </div>
      <div>
        <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Apellido</label>
        <VeeField name="last-name" type="text" placeholder="Rodríguez López" class="input input-bordered w-full mt-1" />
        <VeeErrorMessage name="last-name" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-5">
      <div class="md:col-span-1 lg:col-span-1">
        <label for="tipo_documento" class="block text-sm font-medium leading-6 text-gray-900">Tipo de Documento</label>
        <VeeField name="tipo_documento" class="select select-bordered w-full mt-1" :value="0" as="select">
          <option :value="0" disabled selected>Seleccione</option>
          <option :value="1">Cédula de Ciudadania</option>
          <option :value="2">Tarjeta de Indentidad</option>
        </VeeField>
        <VeeErrorMessage name="tipo_documento" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>

      </div>

      <div class="md:col-span-1 lg:col-span-1">
        <label for="numero_documento" class="block text-sm font-medium leading-6 text-gray-900">Número de
          Documento</label>
        <VeeField name="numero_documento" type="text" placeholder="1093########"
          class="input input-bordered w-full mt-1" />
        <VeeErrorMessage name="numero_documento" class="text-error animate__animated  animate__fadeIn">
        </VeeErrorMessage>

      </div>

      <div class="md:col-span-2 lg:col-span-1">
        <label for="direccion" class="block text-sm font-medium leading-6 text-gray-900">Dirección</label>
        <VeeField name="direccion" placeholder="Av 3ll #4mm" class="input input-bordered w-full mt-1">
        </VeeField>
        <VeeErrorMessage name="direccion" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>

      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-5">
      <div class="md:col-span-1 lg:col-span-1">
        <label class="block text-sm font-medium leading-6 text-gray-900">Género</label>
        <VeeField name="gender" class="select select-bordered w-full mt-1" value="0" as="select">
          <option value="0" disabled selected>Seleccione</option>
          <option value="1">Masculino</option>
          <option value="2">Femenino</option>
          <option value="3">Helicóptero Apache</option>
        </VeeField>
        <VeeErrorMessage name="gender" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>

      </div>

      <div class="md:col-span-1 lg:col-span-1">
        <label for="celular" class="block text-sm font-medium leading-6 text-gray-900">Número de Celular</label>
        <VeeField type="text" placeholder="+57312#######" class="input input-bordered w-full mt-1" name="celular">
        </VeeField>
        <VeeErrorMessage name="celular" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>

      </div>

      <div class="md:col-span-2 lg:col-span-1">
        <label for="correo" class="block text-sm font-medium leading-6 text-gray-900">Correo Electrónico</label>
        <VeeField name="correo" type="email" placeholder="example@gmail.com" class="input input-bordered w-full mt-1" />
        <VeeErrorMessage name="correo" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>

      </div>
    </div>

    <div class="mt-24 flex items-center justify-end gap-x-6">
      <button type="button" class="btn btn-neutral">Cancelar</button>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
  </VeeForm>
</template>

<script lang="ts" setup>

const formularioSchema = yup.object({
  "first-name": yup.string().required(),
  "last-name": yup.string().required(),
  tipo_documento: yup.number().required().min(1),
  numero_documento: yup.number().required(),
  direccion: yup.string().required(),
  gender: yup.number().required().min(1),
  celular: yup.number().required().max(18),
  correo: yup.string().required().email()
})


</script>

<style></style>