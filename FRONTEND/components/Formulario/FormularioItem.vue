<template>
  <VeeForm :validationSchema="formularioItemBasicoSchema" @submit="onSubmit" v-slot="{ meta, errors }">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">

      <div>
        <label class="label">
          <span class="block text-md">Nombre del Item *</span>
        </label>
        <VeeField name="name" autocomplete="off" type="text" placeholder="Lapicero" v-model="formulario.name"
          :class="`input w-full  ${errors.name ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="name" class="text-error text-sm animate__animated animate__fadeIn label block">
        </VeeErrorMessage>
      </div>
      <div>
        <label class="label">
          <span class="block text-md ">Categoria Item *</span>
        </label>
        <VeeField name="categoriaItem" v-model="formulario.serie_lote"
          :class="`select  w-full  ${errors.gender_id ? 'select-error' : 'select-bordered'}`" as="select">
          <option value="0" disabled>Seleccione</option>
          <option value="1">SST</option>
          <option value="2">SECRETARÍA</option>
          <option value="3">RECEPCION</option>
          <option value="4">ARCHIVO</option>
          <option value="5">GERENCIA</option>
          <option value="6">PORTERIA</option>
          <option value="7">CONTRATISTA</option>
          <option value="8">CAFETERIA</option>
          <option value="9">CONTABILIDAD</option>
        </VeeField>
        <VeeErrorMessage name="categoriaItem" class="text-error text-sm animate__animated  animate__fadeIn">
        </VeeErrorMessage>
      </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">

      <div>
        <label class="label">
          <span class="block text-md">Cantidad *</span>
        </label>
        <VeeField name="cantidad" autocomplete="off" type="text" placeholder="0" v-model="formulario.cantidad"
          :class="`input w-full  ${errors.cantidad ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="cantidad" class="text-error text-sm animate__animated animate__fadeIn label block">
        </VeeErrorMessage>
      </div>
      <div>
        <label class="label">
          <span class="block text-md ">Unidad *</span>
        </label>
        <VeeField name="unidad" v-model="formulario.unidadId"
          :class="`select  w-full ${errors.gender_id ? 'select-error' : 'select-bordered'}`" as="select">
          <option value="0" disabled>Seleccione</option>
          <option value="1">Metros</option>
          <option value="2">Galón</option>
          <option value="3">Pulgadas</option>
          <option value="4">Unidades</option>
        </VeeField>
        <VeeErrorMessage name="unidad" class="text-error text-sm animate__animated  animate__fadeIn">
        </VeeErrorMessage>
      </div>
    </div>


    <div class="mb-2">
      <label class="label">
        <span class="block text-md">Precio Adquirido *</span>
      </label>
      <VeeField name="valor_adquisicion" autocomplete="off" placeholder="$1.000.000,50"
        v-model="formulario.valor_adquisicion"
        :class="`input w-full ${errors.valor_adquisicion ? 'input-error' : 'input-bordered'}`" />
      <p class="text-sm mx-2 text-gray-500 mt-2">{{ formattedValorAdquisicion }}</p>
      <VeeErrorMessage name="valor_adquisicion"
        class="text-error text-sm animate__animated animate__fadeIn label block" />
    </div>

    <div class="mb-2">
      <label class="label">
        <span class="block text-md">Fotos Item *</span>
      </label>
      <ImageUploader @files-selected="handleFilesSelected" />
    </div>
    <!-- </div> -->
    <ButtonOptions @save="handleSave" @cancel="handleCancel">Registrar</ButtonOptions>
  </VeeForm>
  <!-- </div> -->
</template>
<script lang="ts" setup>


import { useRouter } from 'vue-router';
import swal from 'sweetalert2';
import { ref, computed } from 'vue';
import * as yup from 'yup';
import { FormularioCreateItemBasicoDTO, type FormularioItemBasicoDTO } from '~/Domain/DTOs/Request/Items/FormularioCreateItemBasicoDTO';
const spinnerStore = SpinnerStore();
spinnerStore.activeOrInactiveSpinner(false);

const emits = defineEmits<{
  (event: 'callback', payload: FormularioCreateItemBasicoDTO): void;
}>();
const formulario = ref(new FormularioCreateItemBasicoDTO(null));

const router = useRouter();
const props = defineProps({
  link: {
    type: String,
    default: '/inventario',
  },
});

const formularioItemBasicoSchema = yup.object({
  name: yup.string().required('Este campo es obligatorio *'),
  // serie_lote: yup.string().required('Campo requerido *'),
  categoriaItem: yup
    .mixed()
    .oneOf(['1', '2', '3', '4', '5', '6', '7', '8', '9'], 'Debe seleccionar una opción valida')
    .required('Este campo es obligatorio *'),
  unidad: yup
    .mixed()
    .oneOf(['1', '2', '3', '4'], 'Debe seleccionar una opción valida')
    .required('Este campo es obligatorio *'),
  valor_adquisicion: yup
    .string()
    .required('Este campo es obligatorio *')
    .matches(/^(?![.,])[\d.,]*$/, 'Debe ser un número válido') // No debe comenzar con punto o coma
    .test('is-numeric', 'Debe ser un número', (value: any) => {
      // Verifica que el valor no sea undefined
      if (value === undefined) return false;

      // Reemplaza las comas por puntos para tratar el valor como número
      const normalizedValue = value.replace(/,/g, '.');

      // Verifica si el valor normalizado es un número y no es negativo
      return !isNaN(normalizedValue) && !isNaN(parseFloat(normalizedValue)) && parseFloat(normalizedValue) >= 0;
    }),
  cantidad: yup
    .string()
    .required('Este campo es obligatorio *')
    .matches(/^\d+$/, 'Debe ser un número entero válido') // Solo permite dígitos, no puntos ni comas
    .test('is-integer', 'Debe ser un número entero positivo', (value: any) => {
      // Verifica que el valor no sea undefined
      if (value === undefined) return false;

      // Convierte el valor a número
      const numberValue = parseInt(value, 10);

      // Verifica si es un número entero positivo
      return Number.isInteger(numberValue) && numberValue >= 0;
    }),
});


const handleSave = () => { };

const handleCancel = () => {
  router.push(props.link);
};

const handleFilesSelected = (files: File[]) => {
  formulario.value.images = files;
};

// const formatCurrency = (value: number): string => {
//   if (!value) {
//     return '$0';
//   }
//   return value.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
// };

const formattedValorAdquisicion = computed(() => {
  const value = formulario.value.valor_adquisicion;
  if (value) {
    const numericValue = typeof value === 'string' ? parseFloat(value.replace(/[^\d.-]/g, '')) : value;
    if (!isNaN(numericValue)) {
      return numericValue.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
    }
  }
  return '$ 0';
});



const onSubmit = async (values: any) => {
  if (formulario.value.images.length == 0) {
    swal.fire({
      icon: 'warning',
      title: 'Falta Cargar Imagenes',
      text: 'No se ha cargado ninguna imagen',
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      reverseButtons: true,
    });
    return;
  }
  return emits('callback', formulario.value);

};
</script>
