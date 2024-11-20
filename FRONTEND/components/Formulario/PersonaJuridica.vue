<template>
  <VeeForm v-slot="{ errors }">

    <div class="flex w-full flex-col">
      <div class="divider divider-center select-none">Datos de Identificación</div>
    </div>
    <div class="grid grid-cols-4 gap-4">

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Razón Social *</span>
        </div>
        <VeeField name="razonSocial" v-slot="{ field }">
          <input v-bind="field" type="text" placeholder="Razon Social *"
            :class="`input input-bordered w-full ${errors.razonSocial ? 'input-error' : ''}`" />
        </VeeField>
        <VeeErrorMessage name="razonSocial" class="text-error text-sm" />
      </label>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">NIT *</span>
        </div>
        <VeeField name="nit" v-slot="{ field }">
          <input type="text" placeholder="NIT" v-bind="field" class="input input-bordered w-full max-w-xs" />
        </VeeField>
        <VeeErrorMessage name="nit" class="text-error text-sm" />
      </label>


      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Tipo de Identidad</span>
        </div>
        <VeeField name="tipoIdentidad" v-slot="{ field }">
          <input type="text" v-bind="field" placeholder="S.A.S" class="input input-bordered w-full max-w-xs" />
        </VeeField>
      </label>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Fecha Registro Camara de Comercio *</span>
        </div>
        <VeeField name="fechaRegistro" v-slot="{ field }">
          <input type="date" v-bind="field" class="input input-bordered w-full max-w-xs" />
        </VeeField>
      </label>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Numero Registro Camara de Comercio *</span>
        </div>
        <VeeField name="numeroRegistro" v-slot="{ field }">
          <input type="text" placeholder="123456789" v-bind="field" class="input input-bordered w-full max-w-xs" />
        </VeeField>
      </label>

      <div class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Pais de Origen *</span>
        </div>
        <Multiselect :options="countries.data.value.countries" placeholder="Departamento" label="es_name"
          v-model="formulario.pais" track-by="es_name">
        </Multiselect>
      </div>
    </div>

    <div class="flex w-full flex-col">
      <div class="divider divider-center select-none">Datos de Contacto</div>
    </div>

    <div class="grid grid-cols-4 gap-4">
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Representante Legal *</span>
        </div>
        <VeeField name="RepresentanteLegal" v-slot="{ field }">
          <input type="text" v-bind="field" placeholder="Nombre" class="input input-bordered w-full max-w-xs" />
        </VeeField>
      </label>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Telefono *</span>
        </div>
        <VeeField name="telefonoRepresentanteLegal" v-slot="{ field }">
          <input type="text" v-bind="field" placeholder="320######" class="input input-bordered w-full max-w-xs" />
        </VeeField>
      </label>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Correo Electronico *</span>
        </div>
        <VeeField name="emailRepresentanteLegal" v-slot="{ field }">
          <input type="email" v-bind="field" placeholder="you@gmail.com" class="input input-bordered w-full max-w-xs" />
        </VeeField>
      </label>
    </div>


  </VeeForm>
  <ButtonOptions @cancel="handleCancel">Registrar</ButtonOptions>

</template>

<script lang="ts" setup>
const emits = defineEmits<{
  (event: 'cancel', payload: boolean): void;
}>();

import Multiselect from 'vue-multiselect';



const countries = await useFetch('/api/countries')
// const ciudades: Ref<[]> = ref([]);

const formulario: Ref<any> = ref({
  pais: ''
});

// watch(
//   () => formulario.value.departamento,
//   (newDepartamento: any) => {
//     if (newDepartamento) {
//       // Find the department and update the cities
//       const selectedDepartment = articles.data.value.find(
//         (item: any) => item.departamento === newDepartamento.departamento
//       );
//       ciudades.value = selectedDepartment ? selectedDepartment.ciudades : [];
//     } else {
//       // Clear the cities if no department is selected
//       ciudades.value = [];
//     }
//   }
// );


const handleCancel = () => {
  return emits('cancel', true);
};
</script>

<style></style>