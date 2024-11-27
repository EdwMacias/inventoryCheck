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
          <input v-bind="field" type="text" placeholder="Nombre" v-model="formulario.primerNombre"
            :class="`input input-bordered w-full ${errors.primerNombre ? 'input-error' : ''}`" />
        </VeeField>
        <VeeErrorMessage name="primerNombre" class="text-error text-sm" />
      </label>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Segundo Nombre</span>
        </div>
        <VeeField name="segundoNombre" v-slot="{ field }">
          <input type="text" placeholder="Nombre" v-bind="field" v-model="formulario.segundoNombre"
            class="input input-bordered w-full max-w-xs" />
        </VeeField>
        <VeeErrorMessage name="segundoNombre" class="text-error text-sm" />

      </label>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Primer Apellido *</span>
        </div>
        <VeeField name="primerApellido" v-slot="{ field }">
          <input type="text" placeholder="Apellido" v-model="formulario.primerApellido" v-bind="field"
            class="input input-bordered w-full max-w-xs" />
        </VeeField>
        <VeeErrorMessage name="primerApellido" class="text-error text-sm" />

      </label>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Segundo Apellido</span>
        </div>
        <VeeField name="segundoApellido" v-slot="{ field }">
          <input type="text" placeholder="Apellido" v-model="formulario.segundoApellido" v-bind="field"
            class="input input-bordered w-full max-w-xs" />
        </VeeField>
        <VeeErrorMessage name="segundoApellido" class="text-error text-sm" />

      </label>

    </div>
    <div class="grid lg:grid-cols-1 md:gap-2 mt-2 grid-cols-1 gap-1 xl:grid-cols-2">

      <div class="">
        <div class="label">
          <span class="label-text">Tipo Identificación *</span>
        </div>
        <div class="flex gap-10 ">
          <!-- Persona Natural -->
          <div class="form-control">
            <label class="label cursor-pointer">
              <VeeField type="radio" name="tipoIdentificacion" v-model="formulario.tipoIdenticacion"
                class="radio peer appearance-none rounded-full border border-gray-300 checked:border-blue-500 focus:outline-none transition"
                value="1" />
              <span class="label-text mx-2 text-gray-600 peer-checked:font-medium">Cedula Ciudadania</span>
            </label>
          </div>

          <!-- Persona Jurídica -->
          <div class="form-control">
            <label class="label cursor-pointer">
              <VeeField type="radio" v-model="formulario.tipoIdenticacion" name="tipoIdentificacion" class="radio peer appearance-none rounded-full 
                  border border-gray-300 checked:border-blue-500 focus:outline-none transition" value="2" />
              <span class="label-text mx-2 text-gray-600 peer-checked:font-medium">Cedula de Extranjería</span>
            </label>
          </div>

          <div class="form-control">
            <label class="label cursor-pointer">
              <VeeField type="radio" name="tipoIdentificacion" v-model="formulario.tipoIdenticacion"
                class="radio peer appearance-none rounded-full border border-gray-300 checked:border-blue-500 focus:outline-none transition"
                value="3" />
              <span class="label-text mx-2 text-gray-600 peer-checked:font-medium">Pasaporte</span>
            </label>
          </div>

          <div class="form-control">
            <label class="label cursor-pointer">
              <VeeField type="radio" name="tipoIdentificacion" v-model="formulario.tipoIdenticacion"
                class="radio peer appearance-none rounded-full border border-gray-300 checked:border-blue-500 focus:outline-none transition"
                value="4" />
              <span class="label-text mx-2 text-gray-600 peer-checked:font-medium">NIT</span>
            </label>
          </div>

        </div>
        <VeeErrorMessage name="tipoIdentificacion" class="text-error text-sm" />

      </div>
      <div class="grid lg:grid-cols-2 gap-1 md:grid-cols-2">
        <label class="form-control w-full max-w-xs">
          <div class="label">
            <span class="label-text">Número de Identificacion *</span>
          </div>
          <VeeField name="numeroIdentificacion" v-slot="{ field }">
            <input type="text" placeholder="108#####" v-model="formulario.numeroIdentificacion" v-bind="field"
              class="input input-bordered w-full " />
          </VeeField>
          <VeeErrorMessage name="numeroIdentificacion" class="text-error text-sm" />

        </label>

        <label class="form-control w-full max-w-xs">
          <div class="label">
            <span class="label-text">DV *</span>
          </div>
          <VeeField name="dv" v-slot="{ field }" v-model="formulario.dv">
            <input type="text" placeholder="1" v-bind="field" class="input input-bordered w-full "
              :disabled="formulario.tipoIdenticacion != '4'" />
          </VeeField>
          <VeeErrorMessage name="dv" class="text-error text-sm" />

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
        <VeeField name="telefono" v-slot="{ field }">
          <input type="text" v-model="formulario.telefono" placeholder="32######" v-bind="field"
            class="input input-bordered w-full max-w-xs" />
        </VeeField>
        <VeeErrorMessage name="telefono" class="text-error text-sm" />

      </label>
      <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Correo Electronico </span>
        </div>
        <VeeField name="correo" v-slot="{ field }">
          <input type="text" v-model="formulario.correo" placeholder="Correo" v-bind="field"
            class="input input-bordered w-full max-w-xs" />
        </VeeField>
        <VeeErrorMessage name="correo" class="text-error text-sm" />

      </label> <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Dirección *</span>
        </div>
        <VeeField name="direccion" v-slot="{ field }">
          <input type="text" v-model="formulario.direccion" placeholder="Direccion" v-bind="field"
            class="input input-bordered w-full max-w-xs" />
        </VeeField>
        <VeeErrorMessage name="direccion" class="text-error text-sm" />

      </label>
    </div>

    <div class="flex w-full flex-col">
      <div class="divider divider-center select-none">Datos de Ubicación</div>
    </div>
    <div class="grid grid-cols-3 gap-3">
      <div class="">
        <div class="label">
          <span class="label-text">Departamento *</span>
        </div>
        <ClientOnly>
          <VeeField name="departamento" v-slot="{ field }">
            <Multiselect :options="colombia ?? []" v-bind="field" placeholder="Departamento" label="departamento"
              v-model="departamentoSeleccionado" track-by="departamento" />
          </VeeField>
        </ClientOnly>
        <VeeErrorMessage name="departamento" class="text-error text-sm" />
      </div>
      <div class="">
        <div class="label">
          <span class="label-text">Ciudad o Municipio *</span>
        </div>
        <ClientOnly>
          <VeeField name="ciudad" v-slot="{ field }">
            <Multiselect :disabled="ciudades.length == 0" v-bind="field" :close-on-select="true" :options="ciudades"
              placeholder="Municipio" v-model="formulario.ciudad">
            </Multiselect>
          </VeeField>
        </ClientOnly>
        <VeeErrorMessage name="ciudad" class="text-error text-sm" />
      </div>
    </div>
    <ButtonOptions @cancel="handleCancel">Registrar</ButtonOptions>
  </VeeForm>
</template>

<script lang="ts" setup>
import Multiselect from 'vue-multiselect';
import { PersonaNaturalCreateDTO } from '~/Domain/DTOs/Terceros/PersonaNatural/PersonaNaturalCreateDTO';

const emits = defineEmits<{
  (event: 'cancel', payload: boolean): void;
  (event: 'callback', payload: PersonaNaturalCreateDTO): void;
}>();


const formulario: Ref<Partial<PersonaNaturalCreateDTO>> = ref(new PersonaNaturalCreateDTO({
  departamento: '',
  ciudad: ''
}));
const departamentoSeleccionado = ref();

// const articles = await useFetch('/api/colombia')
const colombia: Ref<any[]> = ref([]);
const { data, error } = await useFetch('/api/colombia');

if (data) {
  // Validamos que `data.value` es un array antes de asignarlo
  colombia.value = data.value;
} else if (error) {
  console.error('Error al cargar los países:', error);
}
const ciudades: Ref<any[]> = ref([]);

watch(
  () => departamentoSeleccionado.value,
  (newDepartamento: any) => {
    if (newDepartamento) {
      // Find the department and update the cities
      const selectedDepartment = colombia.value.find(
        (item: any) => item.departamento === newDepartamento.departamento
      );
      formulario.value.departamento = selectedDepartment.departamento;
      formulario.value.ciudad = '';
      ciudades.value = selectedDepartment ? selectedDepartment.ciudades : [];
    } else {
      // Clear the cities if no department is selected
      ciudades.value = [];
    }
  }
);

watch(
  () => formulario.value.tipoIdenticacion,
  (newSelectIdentificacion: any) => {
    if (newSelectIdentificacion != '4') formulario.value.dv = null;
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
  correo: yup.string().email('El correo debe ser válido'),
  direccion: yup.string().required('La dirección es obligatoria'),
  departamento: yup.object().nullable().required('Debe seleccionar un departamento'),
  ciudad: yup.string().required('Debe seleccionar una ciudad o municipio'),
  dv: yup
  .string()
  .nullable()
  .typeError('El dígito de verificación debe ser un número')
  .when('tipoIdentificacion', (tipoIdentificacion , schema) => {
    if (tipoIdentificacion[0] === '4') {
      return schema
        .matches(/^\d+$/, 'El dígito de verificación debe ser un número')
        .required('El dígito de verificación es obligatorio para este caso');
    }
    return schema;
  }),
});


const handleCancel = () => emits('cancel', true);
const handleSubmit = (values: any) => {
  const personaNaturalCreateDTO = new PersonaNaturalCreateDTO(formulario.value);
  return emits("callback", personaNaturalCreateDTO);
};

</script>

<style></style>