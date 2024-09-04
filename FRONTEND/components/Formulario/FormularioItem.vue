<template>
  <div class="card border shadow-lg p-4 mt-2 ">
    <VeeForm :validationSchema="formularioItemBasicoSchema" @submit="onSubmit" v-slot="{ meta, errors }">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <div>
          <label class="label">
            <span class="block text-sm">Nombre del Item</span>
          </label>
          <VeeField name="name" type="text" placeholder="Articulo" v-model="formulario.name"
            :class="`input input-sm w-full mt-1 ${errors.name ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="name" class="text-error animate__animated animate__fadeIn label block">
          </VeeErrorMessage>
        </div>
        <div>
          <label class="label">
            <span class="block text-sm ">Serial de Item</span>
          </label>
          <VeeField name="serie_lote" type="text" placeholder="AH1234" v-model="formulario.serie_lote"
            :class="`input input-sm uppercase w-full mt-1 ${errors.serie_lote ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="serie_lote" class="text-error animate__animated animate__fadeIn label block">
          </VeeErrorMessage>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <div>
          <label class="label">
            <span class="block text-sm">Valor de compra</span>
          </label>
          <VeeField name="valor_adquisicion" placeholder="$1.000.000,50" v-model="formulario.valor_adquisicion"
            :class="`input w-full ${errors.valor_adquisicion ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="valor_adquisicion" class="text-error" />
          <p class="text-sm text-gray-500 mt-2">*Vista previa del valor: {{ formattedValorAdquisicion }}</p>
        </div>
        <div class="">
          <label class="label">
            <span class="block text-sm">Imagen del item</span>
          </label>
          <ImageUploader @files-selected="handleFilesSelected" />
        </div>
      </div>
      <ButtonOptions @save="handleSave" @cancel="handleCancel">Registrar</ButtonOptions>
    </VeeForm>
  </div>
</template>

<script lang="ts" setup>
import { useRouter } from 'vue-router';
import swal from 'sweetalert2';
import { ref, computed } from 'vue';
import * as yup from 'yup';
import { FormularioCreateItemBasicoDTO, type FormularioItemBasicoDTO } from '~/Domain/DTOs/Request/Items/FormularioCreateItemBasicoDTO';

// const emits = defineEmits(['callback']);

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
  name: yup.string().required('*Campo requerido'),
  serie_lote: yup.string().required('*Campo requerido'),
  valor_adquisicion: yup.string().required('*Campo requerido'),
});

const formulario = ref<FormularioItemBasicoDTO>({
  name: '',
  serie_lote: '',
  valor_adquisicion: 0,
  images: [], // Para almacenar las imágenes seleccionadas
});

const handleSave = () => { };

const handleCancel = () => {
  router.push(props.link);
};

// Función que maneja la selección de archivos desde el componente ImageUploader
const handleFilesSelected = (files: any) => {
  // files[0];
  formulario.value.images = files;
  console.log(formulario.value.images);

};

const formatCurrency = (value: number): string => {
  if (!value || isNaN(value)) {
    return '$0';
  }
  return value.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
};

const formattedValorAdquisicion = computed(() => {
  return formatCurrency(parseFloat(formulario.value.valor_adquisicion.toString().replace(/,/g, '')));
});

const onSubmit = (values: any) => {

  if (!formulario.value.images) {
    swal.fire({
      icon: 'error',
      title: 'Falta recurso imagen',
      text: 'Hubo un error por favor incluya la imagen.',
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      reverseButtons: true,
    });
    return;
  }

  const formularioCreateItemBasicoDTO = new FormularioCreateItemBasicoDTO(values);
  formularioCreateItemBasicoDTO.images = formulario.value.images.map(file => file);

  console.log(formularioCreateItemBasicoDTO);

  // Emitir el evento de callback con la entidad combinada
  emits('callback', formularioCreateItemBasicoDTO);

};
</script>
