<template>
  <VeeForm :validationSchema="formularioHistorialSchema" @submit="onSubmit" v-slot="{ meta, errors }">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-2">
      <div class="">
        <label class="label">Fecha de Ejecución *</label>
        <VeeField name="fecha" v-model="formularioHistorial.fecha" type="date"
          :class="`input w-full ${errors.fecha ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="fecha" class="text-error" />
      </div>
      <div>
        <label class="label">Fecha Próxima Actividad *</label>
        <VeeField name="proximaActividad" v-model="formularioHistorial.proximaActividad" type="date"
          :class="`input w-full ${errors.proxAct ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="proximaActividad" class="text-error" />
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-2">
      <div>
        <label class="label">Asunto *</label>
        <VeeField name="asunto" v-model="formularioHistorial.asunto" placeholder="MTTO"
          :class="`input w-full ${errors.descripcion ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="asunto" class="text-error" />
      </div>
      <div>
        <label class="label">Estado *</label>
        <VeeField name="estado" v-model="formularioHistorial.estado" as="select"
          :class="`select w-full ${errors.estado ? 'select-error' : 'select-bordered'}`">
          <option value="0">Selecciona una opción</option>
          <option value="correcto">Correcto</option>
          <option value="suspendido">Suspendido</option>
          <option value="incorrecto">Incorrecto</option>
        </VeeField>
        <VeeErrorMessage name="estado" class="text-error" />
      </div>
    </div>

    <div class="mb-2">
      <label class="label">Responsable *</label>
      <VeeField name="responsable" v-model="formularioHistorial.responsable" placeholder="SOLTEC"
        :class="`input w-full ${errors.responsable ? 'input-error' : 'input-bordered'}`" />
      <VeeErrorMessage name="responsable" class="text-error" />
    </div>

    <div class="mt-10 flex items-center justify-end gap-x-6">
      <button type="submit" class="btn btn-primary">Agregar</button>
      <NuxtLink :to="`/inventario/items/observaciones/equipo/${route.params.id}`" class="btn btn-neutral">Cancelar
      </NuxtLink>
    </div>

  </VeeForm>
</template>

<script lang="ts" setup>
import { EquipoObservacionCreateDTO } from '~/Domain/DTOs/Observaciones/Equipos/EquipoObservacionCreateDTO';

const emit = defineEmits<{
  (event: 'callback', payload: EquipoObservacionCreateDTO): void
}>()


const formularioHistorialSchema = yup.object({
  // actividad: yup.string().required('*Campo requerido'),
  asunto: yup.string().required('*Campo requerido'),
  estado: yup.string().required('*Campo requerido'),
  fecha: yup.string().required('*Campo requerido'),
  // firmaResponsable: yup.string().required('*Campo requerido'),
  proximaActividad: yup.string().required('*Campo requerido'),
  // resource: yup.string().required('*Campo requerido'),
  responsable: yup.string().required('*Campo requerido'),
});

const route = useRoute();

const onSubmit = (values: any): void => {
  // console.log(values);
  // console.log('Datos del formulario:', values);
  console.log(formularioHistorial.value);

  return emit("callback", formularioHistorial.value)
};


const formularioHistorial: Ref<EquipoObservacionCreateDTO> = ref(new EquipoObservacionCreateDTO(null));

</script>

<style></style>