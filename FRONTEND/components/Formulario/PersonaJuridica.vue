<template>
  <VeeForm :validation-schema="formSchema" @submit="handleSubmit" v-slot="{ errors }">

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
        <VeeErrorMessage name="tipoIdentidad" class="text-error text-sm" />

      </label>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Fecha Registro Camara de Comerciod *</span>
        </div>
        <VeeField name="fechaRegistro" v-slot="{ field }">
          <input type="date" v-bind="field" class="input input-bordered w-full max-w-xs" />
        </VeeField>
        <VeeErrorMessage name="fechaRegistro" class="text-error text-sm" />

      </label>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Numero Registro Camara de Comercio *</span>
        </div>
        <VeeField name="numeroRegistro" v-slot="{ field }">
          <input type="text" placeholder="123456789" v-bind="field" class="input input-bordered w-full max-w-xs" />
        </VeeField>
        <VeeErrorMessage name="numeroRegistro" class="text-error text-sm" />

      </label>

      <div class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Pais de Origen *</span>
        </div>
        <ClientOnly>
          <Multiselect :options="countries" placeholder="pais" label="es_name" v-model="formulario.pais"
            track-by="es_name" />
          <VeeErrorMessage name="pais" class="text-error text-sm" />
        </ClientOnly>
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
        <VeeErrorMessage name="RepresentanteLegal" class="text-error text-sm" />

      </label>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Telefono *</span>
        </div>
        <VeeField name="telefonoRepresentanteLegal" v-slot="{ field }">
          <input type="text" v-bind="field" placeholder="320######" class="input input-bordered w-full max-w-xs" />
        </VeeField>
        <VeeErrorMessage name="telefonoRepresentanteLegal" class="text-error text-sm" />

      </label>

      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Correo Electronico *</span>
        </div>
        <VeeField name="emailRepresentanteLegal" v-slot="{ field }">
          <input type="email" v-bind="field" placeholder="you@gmail.com" class="input input-bordered w-full max-w-xs" />
        </VeeField>
        <VeeErrorMessage name="emailRepresentanteLegal" class="text-error text-sm" />

      </label>
    </div>

    <ButtonOptions @cancel="handleCancel">Registrar</ButtonOptions>
  </VeeForm>

</template>

<script lang="ts" setup>
import Multiselect from 'vue-multiselect';
const emits = defineEmits<{
  (event: 'cancel', payload: boolean): void;
}>();

const countries: Ref<any[]> = ref([]);
// Fetch de países
const { data, error } = await useFetch('/api/countries');
if (data) {
  // Validamos que `data.value` es un array antes de asignarlo
  countries.value = data.value;
} else if (error) {
  console.error('Error al cargar los países:', error);
}

const formSchema = yup.object({
  razonSocial: yup.string().required('La razón social es obligatoria'),
  nit: yup.string().required('El NIT es obligatorio'),
  tipoIdentidad: yup.string().required('El tipo de identidad es obligatorio'),
  fechaRegistro: yup.date().required('La fecha de registro es obligatoria'),
  numeroRegistro: yup
    .string()
    .matches(/^\d+$/, 'El número de registro debe ser numérico')
    .required('El número de registro es obligatorio'),
  pais: yup.object().nullable().required('Debe seleccionar un país'),
  RepresentanteLegal: yup.string().required('El representante legal es obligatorio'),
  telefonoRepresentanteLegal: yup
    .string()
    .matches(/^\d{10}$/, 'El teléfono debe tener 10 dígitos')
    .required('El teléfono es obligatorio'),
  emailRepresentanteLegal: yup
    .string()
    .email('El correo debe ser válido')
    .required('El correo electrónico es obligatorio'),
});



const formulario: Ref<any> = ref({
  pais: ''
});

const handleSubmit = (values: any) => console.log('Formulario enviado:', values);

const handleCancel = () => {
  return emits('cancel', true);
};
</script>

<style></style>