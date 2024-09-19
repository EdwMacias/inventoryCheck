<template>
  <div>
    <VeeForm :validationSchema="formularioObservacionSchema" @submit="onSubmit" v-slot="{ meta, errors }">
      <VeeField name="observacion" v-model="formularioObservacion.observacion" type="text"
        :class="`input w-full ${errors.observacion ? 'input-error' : 'input-bordered'}`" />
      <VeeErrorMessage name="observacion" class="text-error" />
      <button type="submit" class="btn btn-primary" :disabled="!meta.valid">Agregar</button>
      <button class="btn btn-ghost">Cancelar</button>
    </VeeForm>
  </div>
</template>

<script lang="ts" setup>
const formularioObservacion = ref({
  // id: route.params.id,
  observacion: '',
});

const formularioObservacionSchema = yup.object({
  observacion: yup.string().required('*Campo requerido'),
});

const onSubmit = (values: any): void => {
  // Validar el formulario y procesar los datos
  console.log('Datos del formulario:', values);

  // Redirigir o procesar los datos del formulario
  // router.push({ path: '/inventario/items' });
};

</script>

<style></style>