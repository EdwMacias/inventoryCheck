<template>
  
  <div class="mx-2 md:mx-6 lg:mx-2">
    <p class="bg-black text-white p-2 rounded-xl">{{ formulario }}</p>
    <VeeForm :validationSchema="formularioSchema" class="mt-5" @submit="onSubmit" v-slot="{ meta, errors }">
      <h2 class="text-center font-semibold text-xl text-gray-900 mb-2">Creación de articulos</h2>
      
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
  
        <div class="" >
          <label class="label">
            <span class='block text-sm font-medium leading-6 text-gray-900'>Descripcion</span>
          </label>
          <VeeField name="description" v-slot="{field}">
            <textarea class="textarea textarea-bordered textarea-lg w-full " placeholder="descripcion del articulo" v-bind="field"></textarea>
          </VeeField>
          <VeeErrorMessage name="description" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
        </div>
        <div id="imagen" >
          <input type="file" class="file-input file-input-bordered w-full mb-1" name="resource" />
        </div>
    <div class="card bg-base-100 shadow-md">
      <span class="card-title">Vista previa</span>
      <figure class="mt-2 rounded-md"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLEoaTsWQuPn6bW-_n6hqZvmy5Lh64qwETLg&s " alt="Imagen del articulo"/></figure>

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


const formularioSchema = yup.object({
  name: yup.string().required(),
  serial_number: yup.string().required(),
  description: yup.string(),
})

const formulario = ref({
  name: '',
  serial_number: '',
  description: '',
  resource: '',
});
 //poner watcher para cuando se haya elegido la imagen

const onSubmit = (values: any, { resetForm }: any) => {
  console.log(values);
  
}

</script>

<style>

</style>