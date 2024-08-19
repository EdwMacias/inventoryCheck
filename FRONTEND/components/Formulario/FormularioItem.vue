<template>
  <VeeForm :validationSchema="formularioItemBasicoSchema" @submit="onSubmit" v-slot="{ meta, errors }">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
      <div> <!-- Nombre del item -->
        <label class="label">
          <span class="block text-md font-medium leading-6 ">Nombre del Item</span>
        </label>
        <VeeField name="name" type="text" placeholder="Articulo" v-model="formulario.name"
          :class="`input w-full mt-1 ${errors.name ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="name" class="text-error animate__animated animate__fadeIn label block">
        </VeeErrorMessage>
      </div>
      <div>
        <label class="label">
          <span class="block text-md font-medium leading-6 ">Serial de Item</span>
        </label>
        <VeeField name="serie_lote" type="text" placeholder="AH1234" v-model="formulario.serie_lote"
          :class="`input uppercase w-full mt-1 ${errors.serie_lote ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="serie_lote" class="text-error animate__animated animate__fadeIn label block">
        </VeeErrorMessage>
      </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2  gap-2">
      <div>
        <label class="label">
          <span class="block text-md font-medium leading-6">Valor de compra</span>
        </label>
        <VeeField name="valor_adquisicion" placeholder="$1.000.000,50" v-model="formulario.valor_adquisicion"
          :class="`input w-full ${errors.valor_adquisicion ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="valor_adquisicion" class="text-error" />
        <p class="text-sm text-gray-500 mt-2">*Vista previa del valor: {{ formattedValorAdquisicion}}</p>
      </div>
      <div>
        <label class="label">
          <span class="block text-md font-medium leading-6 ">Imagen del item</span>
        </label>
        <input type="file" ref="inputFile" class="file-input file-input-bordered w-full" name="resource"
          @change="handleFileChange" />
        <div class="card card-compact w-full">
          <div class="card-body">
            <figure class="mt-2">
              <img ref="itemPhoto" @click="openModal(true)"
                src="https://www.shutterstock.com/image-vector/default-image-icon-vector-missing-600nw-2079504220.jpg"
                alt="Imagen del articulo" class="object-scale-down h-72 w-96 " />
            </figure>
            <CardImagenFull idModal="modal-imagen" :isModalOpen="isModalOpen" :imagen="itemPhoto?.src"
              @close="openModal">
            </CardImagenFull>
          </div>
        </div>
      </div>
    </div>
    <ButtonOptions @save="handleSave" @cancel="handleCancel" >Registrar</ButtonOptions>
  </VeeForm>

</template>

<script lang="ts" setup>
import { useRouter} from 'vue-router';

import swal from 'sweetalert2';

const emits = defineEmits(["callback"]);
const inputFile = ref();
const { setImagen } = useImagen();
const itemPhoto = ref<HTMLImageElement | null>(null);
const isModalOpen = ref(false);
const barcodeValue = ref<string | null>(null);
const router = useRouter();

const props = defineProps({
  link: {
    type: String,
    default: '/inventario/items'
  }
})

const handleSave = () => {
  onSubmit(formulario.value);
}
const handleCancel = () => {
  router.push(props.link);
}

function openModal(valor: boolean) {
  isModalOpen.value = valor;
}

const formularioItemBasicoSchema = yup.object({
  name: yup.string().required('*Campo requerido'),
  serie_lote: yup.string().required('*Campo requerido'),
  valor_adquisicion: yup.string().required('*Campo requerido'),
});

const handleFileChange = (event: Event) => {
  const file = (event.target as HTMLInputElement).files?.[0];
  if (file != undefined) {
    formulario.value.resource = file;
    if (itemPhoto.value != undefined) {
      setImagen(file, itemPhoto);
    }
  }
};

const formatCurrency = (value: number): string => {
  if (!value || isNaN(value)) {
    return '$0';
  }
  return value.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
}

const formattedValorAdquisicion = computed(() => {
  return formatCurrency(parseFloat(formulario.value.valor_adquisicion.toString().replace(/,/g, '')));
});

interface itemBasico { name: string, serie_lote: string, valor_adquisicion: number, resource: any };

const formulario: Ref<itemBasico> = ref({
  name: '',
  serie_lote: '',
  valor_adquisicion: 0,
  resource: null
});

watch(() => formulario.value.serie_lote, (newSerialNumber) => {
  if (!newSerialNumber) {
    barcodeValue.value = null;
    return;
  }
  barcodeValue.value = newSerialNumber;
  return;
});

// barcodeValue.value = formulario.value.serie_lote;


const onSubmit = (values: any) => {
  const itemBasicoEntity = values;
  if (formulario.value.resource == null) {
    swal.fire({
      icon: 'error',
      title: "Falta recurso imagen",
      text: "Hubo un error por favor incluya la imagen.",
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      reverseButtons: true
    });
    return;
  }
  itemBasicoEntity.resource = formulario.value.resource;
  const itemBasicoFormulario = { ...itemBasicoEntity, ...formulario.value };
  emits("callback", itemBasicoFormulario);
  router.push('/inventario/items');
}

</script>