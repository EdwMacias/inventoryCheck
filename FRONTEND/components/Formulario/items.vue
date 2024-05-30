<template>
  <div class="mx-2 md:mx-6 lg:mx-2">
    <p class="bg-black text-white p-2 rounded-xl">{{ formulario }}</p>
    <VeeForm :validationSchema="formularioSchema" class="mt-5" @submit="onSubmit" v-slot="{ meta, errors }">
      <h2 class="text-center font-semibold text-xl mb-2">Creación de articulos</h2>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
        <div>
          <label class="label">
            <span class="block text-sm font-medium leading-6 ">Nombre</span>
          </label>
          <VeeField name="name" type="text" placeholder="Articulo" v-model="formulario.name"
            :class="`input w-full mt-1 ${errors.name ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="name" class="text-error animate__animated animate__fadeIn"></VeeErrorMessage>
        </div>
        <div>
          <label class="label">
            <span class="block text-sm font-medium leading-6 ">Serial:</span>
          </label>
          <VeeField name="serial_number" type="text" placeholder="AH1234" v-model="formulario.serial_number"
            :class="`input w-full mt-1 ${errors.serial_number ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="serial_number" class="text-error animate__animated animate__fadeIn"></VeeErrorMessage>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4" >
        <div>
          <label class="label">
            <span class="block text-sm font-medium leading-6 ">Descripción del articulo</span>
          </label>
          <VeeField name="description" v-slot="{ field }">
            <textarea class="textarea textarea-bordered  w-full" placeholder="Descripción" v-bind="field"></textarea>
          </VeeField>
          <VeeErrorMessage name="description" class="text-error animate__animated animate__fadeIn"></VeeErrorMessage>
        </div>
        <div>
          <div class="card  mt-2">
            <span class="block text-sm font-medium leading-6 ">Vista previa</span>
              <input type="file" class="mt-2 file-input file-input-bordered w-full mb-1" name="resource" />
              
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLEoaTsWQuPn6bW-_n6hqZvmy5Lh64qwETLg&s" class="rounded-xl  w-1/2 self-center" alt="Imagen del artículo" />
          </div>
        </div>
      </div>


      
      <div class="mt-4 flex items-center justify-end gap-x-6">
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
