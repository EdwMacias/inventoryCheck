<template>
  <VeeForm :validation-schema="formSchema" @submit="handleSubmit" v-slot="{ errors }">

    <div class="flex w-full flex-col">
      <div class="divider divider-center select-none">Datos de Identificación</div>
    </div>
    <div class="grid grid-cols-3 gap-3">
      <label class="form-control ">
        <div class="label">
          <span class="label-text">Razón Social *</span>
        </div>
        <VeeField name="razonSocial" v-slot="{ field }">
          <input v-bind="field" type="text" placeholder="Razon Social *" v-model="formulario.razonSocial"
            :class="`input input-bordered w-full ${errors.razonSocial ? 'input-error' : ''}`" />
        </VeeField>
        <VeeErrorMessage name="razonSocial" class="text-error text-sm" />
      </label>

      <label class="form-control ">
        <div class="label">
          <span class="label-text">NIT *</span>
        </div>
        <VeeField name="nit" v-slot="{ field }">
          <input type="text" placeholder="NIT" v-model="formulario.nit" v-bind="field"
            class="input input-bordered " />
        </VeeField>
        <VeeErrorMessage name="nit" class="text-error text-sm" />
      </label>


      <label class="form-control ">
        <div class="label">
          <span class="label-text">Tipo de Entidad</span>
        </div>
        <VeeField name="tipoEntidad" v-slot="{ field }">
          <input v-model="formulario.tipoEntidad" type="text" v-bind="field" placeholder="S.A.S"
            class="input input-bordered " />
        </VeeField>
        <VeeErrorMessage name="tipoEntidad" class="text-error text-sm" />

      </label>

      <label class="form-control ">
        <div class="label">
          <span class="label-text">Fecha Registro Camara Comercio</span>
        </div>
        <VeeField name="fechaRegistroCamara" v-slot="{ field }">
          <input type="date" v-model="formulario.fechaRegistroCamara" v-bind="field"
            class="input input-bordered " />
        </VeeField>
        <VeeErrorMessage name="fechaRegistroCamara" class="text-error text-sm" />

      </label>

      <label class="form-control ">
        <div class="label">
          <span class="label-text">Numero Comercio </span>
        </div>
        <VeeField name="numeroRegistro" v-slot="{ field }">
          <input type="text" placeholder="123456789" v-model="formulario.numeroRegistro" v-bind="field"
            class="input input-bordered " />
        </VeeField>
        <VeeErrorMessage name="numeroRegistro" class="text-error text-sm" />

      </label>

      <div class="form-control ">
        <div class="label">
          <span class="label-text">Pais de Origen </span>
        </div>
        <ClientOnly>
          <VeeField name="pais" v-slot="{ field }">
            <Multiselect :options="countries" class="" v-bind="field" 
            v-model="formulario.pais" placeholder="pais"
             />
          </VeeField>
          <VeeErrorMessage name="pais" class="text-error text-sm" />

        </ClientOnly>
      </div>
    </div>

    <div class="flex w-full flex-col">
      <div class="divider divider-center select-none">Datos de Contacto</div>
    </div>

    <div class="grid grid-cols-3 gap-3">
      <label class="form-control ">
        <div class="label">
          <span class="label-text">Representante Legal </span>
        </div>
        <VeeField name="representanteLegal" v-slot="{ field }">
          <input type="text" v-bind="field" v-model="formulario.representanteLegal" placeholder="Nombre"
            class="input input-bordered " />
        </VeeField>
        <VeeErrorMessage name="representanteLegal" class="text-error text-sm" />

      </label>

      <label class="form-control ">
        <div class="label">
          <span class="label-text">Telefono *</span>
        </div>
        <VeeField name="telefono" v-slot="{ field }">
          <input type="text" v-bind="field" v-model="formulario.telefono" placeholder="320######"
            class="input input-bordered " />
        </VeeField>
        <VeeErrorMessage name="telefono" class="text-error text-sm" />

      </label>

      <label class="form-control ">
        <div class="label">
          <span class="label-text">Correo Electronico *</span>
        </div>
        <VeeField name="email" v-slot="{ field }">
          <input type="email" v-model="formulario.email" v-bind="field" placeholder="you@gmail.com"
            class="input input-bordered " />
        </VeeField>
        <VeeErrorMessage name="email" class="text-error text-sm" />

      </label>
    </div>

    <ButtonOptions @cancel="handleCancel">Registrar</ButtonOptions>
  </VeeForm>

</template>

<script lang="ts" setup>
import Multiselect from 'vue-multiselect';
import { PersonaJuridicaCreateDTO } from '~/Domain/DTOs/Terceros/PersonaJuridica/PersonaJuridicaCreateDTO';
const emits = defineEmits<{
  (event: 'cancel', payload: boolean): void;
  (event: 'callback', payload: PersonaJuridicaCreateDTO): void
}>();
const formulario: Ref<PersonaJuridicaCreateDTO> = ref(new PersonaJuridicaCreateDTO());

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
  tipoEntidad: yup.string(),
  fechaRegistroCamara: yup.date(),
  numeroRegistro: yup
    .string()
    .matches(/^\d+$/, 'El número de registro debe ser numérico'),
  pais: yup.string(),
  representanteLegal: yup.string(),
  telefono: yup
    .string()
    .matches(/^\d{10}$/, 'El teléfono debe tener 10 dígitos')
    .required('El teléfono es obligatorio'),
  email: yup
    .string()
    .email('El correo debe ser válido')
    .required('El correo electrónico es obligatorio'),
});

const handleSubmit = (values: any) => {
  // if (formulario.value.pais) {
  //   formulario.value.pais = formulario.value.pais.name;
  // }

  const personaJuridicaCreateDTO = new PersonaJuridicaCreateDTO(formulario.value);
  return emits('callback', personaJuridicaCreateDTO);
};

const handleCancel = () => {
  return emits('cancel', true);
};
</script>

<style></style>