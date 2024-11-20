<template>
  <VeeForm :validation-schema="formSchema" @submit="handleSubmit" v-slot="{ errors }">
    <div class="flex w-full flex-col">
      <div class="divider divider-center select-none">Datos Basicos</div>
    </div>
    <div class="grid grid-cols-4 gap-4">
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Primer Nombre *</span>
        </div>
        <VeeField name="primerNombre" v-slot="{ field }">
          <input v-bind="field" type="text" placeholder="Nombre"
            :class="`input input-bordered w-full ${errors.primerNombre ? 'input-error' : ''}`" />
        </VeeField>
        <VeeErrorMessage name="primerNombre" class="text-error text-sm" />
      </label>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Segundo Nombre</span>
        </div>
        <input type="text" placeholder="Nombre" class="input input-bordered w-full max-w-xs" />
      </label>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Primer Apellido *</span>
        </div>
        <input type="text" placeholder="Apellido" class="input input-bordered w-full max-w-xs" />
      </label>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Segundo Apellido</span>
        </div>
        <input type="text" placeholder="Apellido" class="input input-bordered w-full max-w-xs" />
      </label>

    </div>
    <div class="grid grid-cols-2 gap-2 mt-2">

      <div class="">
        <div class="label">
          <span class="label-text">Tipo Identificación *</span>
        </div>
        <div class="flex gap-10 ">
          <!-- Persona Natural -->
          <div class="form-control">
            <label class="label cursor-pointer">
              <input type="radio" name="tipoIdentificacion"
                class="radio peer appearance-none rounded-full border border-gray-300 checked:border-blue-500 focus:outline-none transition"
                value="CC" />
              <span class="label-text mx-2 text-gray-600 peer-checked:font-medium">Cedula Ciudadania</span>
            </label>
          </div>

          <!-- Persona Jurídica -->
          <div class="form-control">
            <label class="label cursor-pointer">
              <VeeField type="radio" name="tipoIdentificacion" class="radio peer appearance-none rounded-full 
                  border border-gray-300 checked:border-blue-500 focus:outline-none transition" value="CE" />
              <span class="label-text mx-2 text-gray-600 peer-checked:font-medium">Cedula de Extranjería</span>
            </label>
          </div>

          <div class="form-control">
            <label class="label cursor-pointer">
              <VeeField type="radio" name="tipoIdentificacion"
                class="radio peer appearance-none rounded-full border border-gray-300 checked:border-blue-500 focus:outline-none transition"
                value="PASAPORTE" />
              <span class="label-text mx-2 text-gray-600 peer-checked:font-medium">Pasaporte</span>
            </label>
          </div>

        </div>

      </div>
      <div>
        <label class="form-control w-full max-w-xs">
          <div class="label">
            <span class="label-text">Número de Identificacion *</span>
          </div>
          <input type="text" placeholder="108#####" class="input input-bordered w-full " />
        </label>
      </div>

    </div>

    <div class="flex w-full flex-col">
      <div class="divider divider-center select-none">Datos de Contacto</div>
    </div>
    <div class="grid grid-cols-3 gap-3">
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Teléfono *</span>
        </div>
        <input type="text" placeholder="Nombre" class="input input-bordered w-full max-w-xs" />
      </label>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Correo Electronico *</span>
        </div>
        <input type="text" placeholder="Nombre" class="input input-bordered w-full max-w-xs" />
      </label> <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Dirección *</span>
        </div>
        <input type="text" placeholder="Nombre" class="input input-bordered w-full max-w-xs" />
      </label>
    </div>

    <div class="flex w-full flex-col">
      <div class="divider divider-center select-none">Datos de Ubicación</div>
    </div>
    <div class="grid grid-cols-3 gap-3">
      <div class="">
        <div class="label">
          <span class="label-text">Departamento</span>
        </div>
        <Multiselect :options="articles.data.value" placeholder="Departamento" label="departamento"
          v-model="formulario.departamento" track-by="departamento">
        </Multiselect>
      </div>
      <div class="">
        <div class="label">
          <span class="label-text">Ciudad o Municipio</span>
        </div>
        <Multiselect :disabled="ciudades.length == 0" :close-on-select="true" :options="ciudades"
          placeholder="Municipio" v-model="formulario.ciudad">
        </Multiselect>
      </div>
    </div>
    <ButtonOptions @cancel="handleCancel">Registrar</ButtonOptions>
  </VeeForm>
</template>

<script lang="ts" setup>
import { TerceroCreate } from '~/Domain/DTOs/Terceros/Tercero/TerceroCreateDTO';
import Multiselect from 'vue-multiselect';

const emits = defineEmits<{
  (event: 'cancel', payload: boolean): void;
}>();
const articles = await useFetch('/api/colombia')
const ciudades: Ref<[]> = ref([]);
const formulario: Ref<TerceroCreate> = ref(new TerceroCreate({
  departamento: '',
  ciudad: ''
}));

watch(
  () => formulario.value.departamento,
  (newDepartamento: any) => {
    if (newDepartamento) {
      // Find the department and update the cities
      const selectedDepartment = articles.data.value.find(
        (item: any) => item.departamento === newDepartamento.departamento
      );
      ciudades.value = selectedDepartment ? selectedDepartment.ciudades : [];
    } else {
      // Clear the cities if no department is selected
      ciudades.value = [];
    }
  }
);

const formSchema = yup.object({
  primerNombre: yup.string().required('El primer nombre es obligatorio'),
  segundoNombre: yup.string(),
  primerApellido: yup.string().required('El primer apellido es obligatorio'),
  segundoApellido: yup.string(),
  tipoIdentificacion: yup.string().required('Debe seleccionar un tipo de identificación'),
  numeroIdentificacion: yup.string().required('El número de identificación es obligatorio'),
  telefono: yup.string().required('El teléfono es obligatorio'),
  correo: yup.string().email('El correo debe ser válido').required('El correo es obligatorio'),
  direccion: yup.string().required('La dirección es obligatoria'),
  departamento: yup.object().nullable().required('Debe seleccionar un departamento'),
  ciudad: yup.object().nullable().required('Debe seleccionar una ciudad o municipio'),
});

const handleCancel = () => emits('cancel', true);
const handleSubmit = (values: any) => console.log('Formulario enviado:', values);
</script>

<style></style>

<!-- <template>
  <VeeForm :validation-schema="formSchema" @submit="handleSubmit" v-slot="{ errors }">
    <div class="flex w-full flex-col">
      <div class="divider divider-center select-none">Datos Básicos</div>
    </div>
    <div class="grid grid-cols-4 gap-4">
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Primer Nombre *</span>
        </div>
        <VeeField name="primerNombre" v-slot="{ field }">
          <input v-bind="field" type="text" placeholder="Nombre" :class="`input input-bordered w-full ${errors.primerNombre ? 'input-error' : ''}`" />
        </VeeField>
        <VeeErrorMessage name="primerNombre" class="text-error text-sm" />
      </label>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Segundo Nombre</span>
        </div>
        <VeeField name="segundoNombre" v-slot="{ field }">
          <input v-bind="field" type="text" placeholder="Nombre" class="input input-bordered w-full" />
        </VeeField>
        <VeeErrorMessage name="segundoNombre" class="text-error text-sm" />
      </label>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Primer Apellido *</span>
        </div>
        <VeeField name="primerApellido" v-slot="{ field }">
          <input v-bind="field" type="text" placeholder="Apellido" :class="`input input-bordered w-full ${errors.primerApellido ? 'input-error' : ''}`" />
        </VeeField>
        <VeeErrorMessage name="primerApellido" class="text-error text-sm" />
      </label>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Segundo Apellido</span>
        </div>
        <VeeField name="segundoApellido" v-slot="{ field }">
          <input v-bind="field" type="text" placeholder="Apellido" class="input input-bordered w-full" />
        </VeeField>
        <VeeErrorMessage name="segundoApellido" class="text-error text-sm" />
      </label>
    </div>
    <div class="grid grid-cols-2 gap-2 mt-2">
      <div>
        <div class="label">
          <span class="label-text">Tipo Identificación *</span>
        </div>
        <div class="flex gap-10">
          <label class="form-control">
            <VeeField name="tipoIdentificacion" type="radio" value="CC" v-slot="{ field }">
              <input v-bind="field" class="radio peer" />
            </VeeField>
            <span class="label-text mx-2">Cédula Ciudadanía</span>
          </label>
          <label class="form-control">
            <VeeField name="tipoIdentificacion" type="radio" value="CE" v-slot="{ field }">
              <input v-bind="field" class="radio peer" />
            </VeeField>
            <span class="label-text mx-2">Cédula de Extranjería</span>
          </label>
          <label class="form-control">
            <VeeField name="tipoIdentificacion" type="radio" value="PASAPORTE" v-slot="{ field }">
              <input v-bind="field" class="radio peer" />
            </VeeField>
            <span class="label-text mx-2">Pasaporte</span>
          </label>
        </div>
        <VeeErrorMessage name="tipoIdentificacion" class="text-error text-sm" />
      </div>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Número de Identificación *</span>
        </div>
        <VeeField name="numeroIdentificacion" v-slot="{ field }">
          <input v-bind="field" type="text" placeholder="108#####" :class="`input input-bordered w-full ${errors.numeroIdentificacion ? 'input-error' : ''}`" />
        </VeeField>
        <VeeErrorMessage name="numeroIdentificacion" class="text-error text-sm" />
      </label>
    </div>
    <div class="flex w-full flex-col">
      <div class="divider divider-center select-none">Datos de Contacto</div>
    </div>
    <div class="grid grid-cols-3 gap-3">
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Teléfono *</span>
        </div>
        <VeeField name="telefono" v-slot="{ field }">
          <input v-bind="field" type="text" placeholder="Teléfono" :class="`input input-bordered w-full ${errors.telefono ? 'input-error' : ''}`" />
        </VeeField>
        <VeeErrorMessage name="telefono" class="text-error text-sm" />
      </label>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Correo Electrónico *</span>
        </div>
        <VeeField name="correo" v-slot="{ field }">
          <input v-bind="field" type="email" placeholder="ejemplo@correo.com" :class="`input input-bordered w-full ${errors.correo ? 'input-error' : ''}`" />
        </VeeField>
        <VeeErrorMessage name="correo" class="text-error text-sm" />
      </label>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Dirección *</span>
        </div>
        <VeeField name="direccion" v-slot="{ field }">
          <input v-bind="field" type="text" placeholder="Dirección" :class="`input input-bordered w-full ${errors.direccion ? 'input-error' : ''}`" />
        </VeeField>
        <VeeErrorMessage name="direccion" class="text-error text-sm" />
      </label>
    </div>
    <div class="grid grid-cols-2 gap-2">
      <div>
        <div class="label">
          <span class="label-text">Departamento *</span>
        </div>
        <Multiselect :options="articles.data.value" label="departamento" v-model="formulario.departamento" track-by="departamento" placeholder="Seleccione un departamento" />
      </div>
      <div>
        <div class="label">
          <span class="label-text">Ciudad o Municipio *</span>
        </div>
        <Multiselect :options="ciudades" label="ciudad" v-model="formulario.ciudad" placeholder="Seleccione una ciudad" :disabled="!ciudades.length" />
      </div>
    </div>
    <ButtonOptions @cancel="handleCancel">Registrar</ButtonOptions>
  </VeeForm>
</template> -->

<!-- <script lang="ts" setup>
import { ref, watch } from 'vue';
import * as yup from 'yup';
import Multiselect from 'vue-multiselect';
import { TerceroCreate } from '~/Domain/DTOs/Terceros/Tercero/TerceroCreateDTO';

const emits = defineEmits(['cancel']);
const formulario = ref(new TerceroCreate({ departamento: '', ciudad: '' }));
const articles = await useFetch('/api/colombia');
const ciudades = ref([]);

watch(
  () => formulario.value.departamento,
  (newDepartamento) => {
    if (newDepartamento) {
      const selected = articles.data.value.find((item: any) => item.departamento === newDepartamento.departamento);
      ciudades.value = selected ? selected.ciudades : [];
    } else {
      ciudades.value = [];
    }
  }
);

const formSchema = yup.object({
  primerNombre: yup.string().required('El primer nombre es obligatorio'),
  segundoNombre: yup.string(),
  primerApellido: yup.string().required('El primer apellido es obligatorio'),
  segundoApellido: yup.string(),
  tipoIdentificacion: yup.string().required('Debe seleccionar un tipo de identificación'),
  numeroIdentificacion: yup.string().required('El número de identificación es obligatorio'),
  telefono: yup.string().required('El teléfono es obligatorio'),
  correo: yup.string().email('El correo debe ser válido').required('El correo es obligatorio'),
  direccion: yup.string().required('La dirección es obligatoria'),
  departamento: yup.object().nullable().required('Debe seleccionar un departamento'),
  ciudad: yup.object().nullable().required('Debe seleccionar una ciudad o municipio'),
});

const handleCancel = () => emits('cancel', true);
const handleSubmit = (values: any) => console.log('Formulario enviado:', values);
</script> -->

<!-- <style scoped></style> -->
