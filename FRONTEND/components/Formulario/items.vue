<template>
  <div class="mx-2 md:mx-6 lg:mx-2">
    <VeeForm :validationSchema="formularioSchema" class="mt-5" @submit="onSubmit" v-slot="{ meta, errors }">
      <h2 class="text-center font-semibold text-xl text-gray-900 mb-2">Creación de articulos</h2>
      {{ formulario }}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
        <div>
          <label class="label">
            <span class='block text-sm font-medium leading-6 text-gray-900'>Nombre</span>
          </label>
          <VeeField name="first-name" type="text" placeholder="" v-model="formulario['name']"
            :class="`input w-full mt-1 ${errors['name'] ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="first-name" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
        </div>
        <div>
          <label class="label">
            <span class='block text-sm font-medium leading-6 text-gray-900'>Serial</span>
          </label>
          <VeeField name="Serial" type="text" placeholder="" v-model="formulario['serial_number']"
          :class="`input w-full mt-1 ${errors['serial_number'] ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="last-name" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
        </div>
      </div>
  
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
        <div class="md:col-span-2 lg:col-span-1">
          <label class="label">
            <span class='block text-sm font-medium leading-6 text-gray-900'>Categoria (opcional)</span>
          </label>
          <VeeField name="Serial" type="select" placeholder="hola" v-model="formulario['category_id']"
          :class="`input w-full mt-1 ${errors['category_id'] ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="category" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
          <select class="select w-full ">
            <option value="0" >Ninguna</option>
            <option value="1">Opcion 2</option>
          </select>
        </div>
        <!-- <div class="md:col-span-1 lg:col-span-1">
          <label class="label">
            <span class='block text-sm font-medium leading-6 text-gray-900'>Tipo Documento</span>
          </label>
          <VeeField name="tipo_documento" v-model="formulario.tipo_documento" 
          :class="`select  w-full mt-1 ${errors.tipo_documento?'select-error':'select-bordered'}`"
            as="select">
            <option value="0">Seleccione</option>
            <option :value="1">Cédula de Ciudadania</option>
            <option :value="2">Tarjeta de Indentidad</option>
          </VeeField>
          <VeeErrorMessage name="tipo_documento" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
  
        </div> -->
  
        <!-- <div class="md:col-span-1 lg:col-span-1">
          <label class="label">
            <span class='block text-sm font-medium leading-6 text-gray-900'>Número de Documento</span>
          </label>
  
          <VeeField name="numero_documento" type="text" placeholder="1093########"
          :class="`input w-full mt-1 ${errors.numero_documento ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="numero_documento" class="text-error animate__animated  animate__fadeIn">
          </VeeErrorMessage>
  
        </div> -->
  
        <div class="md:col-span-2 lg:col-span-1">
          <label class="label">
            <span class='block text-sm font-medium leading-6 text-gray-900'>Descripcion</span>
          </label>
          <!-- <select class="select w-full" >
            <option>Buen estado</option>
            <option>Dañado</option>
            <option>otro...</option>
          </select> -->
          <VeeField name="description" :class="`select  w-full mt-1 ${errors.description?'select-error':'select-bordered'}`" v-model="formulario.description" as="select">
            <option value="0">Buen estado</option>
            <option value="1">Dañado</option>
            <option value="2">otro</option>
          </VeeField>
          <VeeErrorMessage name="gender" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
  
        </div>

        <!-- <div class="md:col-span-1 lg:col-span-1">
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
  
        </div> -->

        <div class="md:col-span-2 lg:col-span-1" >
          <label class="label">
            <span class='block text-sm font-medium leading-6 text-gray-900'>observaciones</span>
          </label>
          <VeeField name="observations" placeholder="" 
          :class="`input w-full mt-1 ${errors.description ? 'input-error' : 'input-bordered'}`">
          </VeeField>
          <VeeErrorMessage name="observations" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
  
        </div>
      </div>
  
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-5">
        <!-- <div class="md:col-span-1 lg:col-span-1">
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
  
        </div> -->
  
        <div class="md:col-span-1 lg:col-span-1">
          <label class="label">
            <span class='block text-sm font-medium leading-6 text-gray-900'>Imagen</span>
          </label>
              <VeeField type="file" placeholder="Escoge una imagen de referencia" 
              :class="`input w-full mt-1 ${errors.image ? 'input-error' : 'input-bordered'}`"
              name="image">
              </VeeField>
              <VeeErrorMessage name="image" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
            
        </div>  
  
        <div class="md:col-span-2 lg:col-span-1">
          <label class="label">
            <span class='block text-sm font-medium leading-6 text-gray-900'>Categoría</span>
          </label>
  
          <VeeField name="category_id" type="text" placeholder="Varios" 
          :class="`input w-full mt-1 ${errors.category_id ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="correo" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
  
        </div>
      </div>
  
      <div class="mt-24 flex items-center justify-end gap-x-6">
        <NuxtLink to="/" class="btn btn-neutral">Cancelar</NuxtLink>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </VeeForm>
  </div>
</template>

<script lang="ts" setup>

yup.setLocale({
  mixed:{
    default: "*llenar campo"
  },
  number: {
    moreThan: "*Debe haber valores dentro del formulario"
  },
  // string:{
  //   default: "rellene los campos, por favor"
  // },
})

// const schema = {
//   category_id: (value) => {
//     if (value) {
//       return true;
//     }

//     return 'Debe escoger una categoría';
//   },
// };

const formularioSchema = yup.object({
  name: yup.string().required(),
  serial_number: yup.string().required(),
  description: yup.string(),
  observation: yup.string(),
  image: yup.string().required(),
  category_id: yup.string().required(),
  statu_id: yup.number().required().lessThan(10),
})

const formulario = ref({
  name: '',
  serial_number: '',
  description: '',
  observation: "",
  image: '',
  category_id: '',
  statu_id: 0,
});

const onSubmit = (values: any, { resetForm }: any) => {
  console.log(values);
  
}

</script>

<style>

</style>