<template>
  <!-- <div class=""> -->
  <VeeForm :validationSchema="formularioItemBasicoSchema" @submit="onSubmit" v-slot="{ meta, errors }">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
      <div>
        <label class="label">
          <span class="block text-md">Nombre del Item *</span>
        </label>
        <VeeField name="name" type="text" placeholder="Lapicero" v-model="formulario.name"
          :class="`input w-full  ${errors.name ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="name" class="text-error animate__animated animate__fadeIn label block">
        </VeeErrorMessage>
      </div>
      <div>
        <label class="label">
          <span class="block text-md ">Sección:</span>
        </label>
        <VeeField name="seccion" as="select" type="select" placeholder="Seccion" v-model="formulario.seccion"
          :class="`select w-full  ${errors.serie_lote ? 'select-error' : 'select-bordered'}  select-bordered`" >
          <option value="" default></option>
          <option value="SGSS">SG-SST</option>
          <option value="SECR">Recepción</option>
          <option value="ARCH">Archivo</option>
          <option value="GERE">Gerencia</option>
          <option value="PORT">Porteria</option>
          <option value="CONT">Contratista</option>
          <option value="CAFT">Cafeteria</option>
          <option value="ACCO">Contabilidad</option>
          <option value="SIST">Sistemas</option>
          <option value="OPT">Operativo</option>
        </VeeField>
        <VeeErrorMessage name="seccion" class="select-error animate__animated animate__fadeIn label block">
        </VeeErrorMessage>
      </div>

      <div class="mb-2">
        <label class="label">
          <span class="block text-md">Precio Adquirido *</span>
        </label>
        <VeeField name="valor_adquisicion" placeholder="$1.000.000,50" v-model="formulario.valor_adquisicion"
          :class="`input w-full ${errors.valor_adquisicion ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="valor_adquisicion" class="text-error" />
        <p class="text-sm text-gray-500 mt-2">*Vista previa del valor: {{ formattedValorAdquisicion }}</p>
      </div>
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

const router = useRouter();
const props = defineProps({
  link: {
    type: String,
    default: '/inventario/items',
  },
});

const formularioItemBasicoSchema = yup.object({
  name: yup.string().required('Campo requerido *'),
  seccion: yup.string().required('Campo requerido *'),
  valor_adquisicion: yup.string().required('Campo requerido *'),
});

const formulario = ref<FormularioItemBasicoDTO>({
  name: '',
  seccion: '',
  valor_adquisicion: '',
  images: [],
});

const handleSave = () => { };

const handleCancel = () => {
  router.push(props.link);
};

const handleFilesSelected = (files: any) => {
  formulario.value.images = files;
};

const formattedValorAdquisicion = computed(() => {
  const value = formulario.value.valor_adquisicion;
  if (value) {
    const numericValue = typeof value === 'string' ? parseFloat(value.replace(/[^\d.-]/g, '')) : value;
    if (!isNaN(numericValue)) {
      return numericValue.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
    }
  }
  return '';
});



const onSubmit = async (values: any) => {
  if (!formulario.value.images) {
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
console.log(values)
  const formularioCreateItemBasicoDTO = new FormularioCreateItemBasicoDTO(values);
  formularioCreateItemBasicoDTO.images = formulario.value.images.map(file => file);

  return emits('callback', formularioCreateItemBasicoDTO);

};
</script>
