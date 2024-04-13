<template>
  <VeeForm :validationSchema="formularioSchema" class="mt-5" @submit="onSubmit" v-slot="{ meta, errors }">
    <h2 class="text-center font-semibold text-xl text-gray-900 mb-2">Información Personal</h2>
    <p class="text-center text-sm text-gray-600 mb-4">Utiliza una dirección permanente donde puedas recibir correo.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
      <div>
        <label class="label">
          <span class='block text-sm font-medium leading-6 text-gray-900'>Nombre</span>
        </label>
        <VeeField name="first-name" type="text" placeholder="Carlos Mariano" v-model="formulario['first-name']"
          :class="`input w-full mt-1 ${errors['first-name'] ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="first-name" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
      </div>
      <div>
        <label class="label">
          <span class='block text-sm font-medium leading-6 text-gray-900'>Apellido</span>
        </label>
        <VeeField name="last-name" type="text" placeholder="Rodríguez López" v-model="formulario['last-name']"
        :class="`input w-full mt-1 ${errors['last-name'] ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="last-name" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-5">
      <div class="md:col-span-1 lg:col-span-1">
        <label class="label">
          <span class='block text-sm font-medium leading-6 text-gray-900'>Tipo Documento</span>
        </label>
        <!-- <label for="tipo_documento" class="block text-sm font-medium leading-6 text-gray-900">Tipo de Documento</label> -->
        <VeeField name="tipo_documento" v-model="formulario.tipo_documento" 
        :class="`select  w-full mt-1 ${errors.tipo_documento?'select-error':'select-bordered'}`"
          as="select">
          <option value="0">Seleccione</option>
          <option :value="1">Cédula de Ciudadania</option>
          <option :value="2">Tarjeta de Indentidad</option>
        </VeeField>
        <VeeErrorMessage name="tipo_documento" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>

      </div>

      <div class="md:col-span-1 lg:col-span-1">
        <label class="label">
          <span class='block text-sm font-medium leading-6 text-gray-900'>Número de Documento</span>
        </label>

        <VeeField name="numero_documento" type="text" placeholder="1093########"
        :class="`input w-full mt-1 ${errors.numero_documento ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="numero_documento" class="text-error animate__animated  animate__fadeIn">
        </VeeErrorMessage>

      </div>

      <div class="md:col-span-2 lg:col-span-1">
        <label class="label">
          <span class='block text-sm font-medium leading-6 text-gray-900'>Dirección</span>
        </label>
        <VeeField name="direccion" placeholder="Av 3ll #4mm" 
        :class="`input w-full mt-1 ${errors.direccion ? 'input-error' : 'input-bordered'}`">
        </VeeField>
        <VeeErrorMessage name="direccion" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>

      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-5">
      <div class="md:col-span-1 lg:col-span-1">
        <label class="label">
          <span class='block text-sm font-medium leading-6 text-gray-900'>Género</span>
        </label>
        <VeeField name="gender" 
        :class="`select  w-full mt-1 ${errors.gender?'select-error':'select-bordered'}`" v-model="formulario.gender" as="select">
          <option value="0">Seleccione</option>
          <option value="1">Masculino</option>
          <option value="2">Femenino</option>
          <option value="3">Helicóptero Apache</option>
        </VeeField>
        <VeeErrorMessage name="gender" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>

      </div>

      <div class="md:col-span-1 lg:col-span-1">
        <label class="label">
          <span class='block text-sm font-medium leading-6 text-gray-900'>Número de Celular</span>
        </label>
        <VeeField type="text" placeholder="+57312#######" 
        :class="`input w-full mt-1 ${errors.celular ? 'input-error' : 'input-bordered'}`"
        name="celular">
        </VeeField>
        <VeeErrorMessage name="celular" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>

      </div>

      <div class="md:col-span-2 lg:col-span-1">
        <label class="label">
          <span class='block text-sm font-medium leading-6 text-gray-900'>Correo Electrónico</span>
        </label>

        <VeeField name="correo" type="email" placeholder="example@gmail.com" 
        :class="`input w-full mt-1 ${errors.correo ? 'input-error' : 'input-bordered'}`" />
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


yup.setLocale({
  
  number: {
    moreThan: "Elija un opción valida"
  },
  mixed: {
    notType : 'Campo Requerido'
  }
  
})

const formularioSchema = yup.object({
  "first-name": yup.string().required(),
  "last-name": yup.string().required(),
  tipo_documento: yup.number().required().moreThan(0),
  numero_documento: yup.string().required(),
  direccion: yup.string().required(),
  gender: yup.number().required().moreThan(0),
  celular: yup.number().required(),
  correo: yup.string().required().email()
})

const formulario = ref({
  "first-name": '',
  "last-name": '',
  tipo_documento: 0,
  numero_documento: '',
  direccion: '',
  gender: 0,
  celular: undefined,
  correo: '',
});

const onSubmit = (values: any, { resetForm }: any) => {
  console.log(values);
  
}

</script>

<style></style>