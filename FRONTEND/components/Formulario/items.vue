<template>
  <div class="mx-2">
    <h2 class="font-semibold text-xl mt-2">Creación de artículos</h2>

    <VeeForm :validationSchema="formularioSchema" @submit="onSubmit" v-slot="{ meta, errors }">
      <div> <!-- Tipo de equipo -->
        <label class="label">
          <span class="block text-md font-medium leading-6 ">Tipo de equipo</span>
        </label>
        <VeeField name="equipment_type" v-model="formulario.equipment_type" :class="`select w-full mt-1 ${errors.equipment_type ? 'select-error' : 'select-bordered'}`" as="select">
          <option value="0">Seleccione</option>
          <option v-for="equipo in equipo.tipo" :key="equipo.value" :value="equipo.value">{{ equipo.text }}</option>
        </VeeField>
        <VeeErrorMessage name="equipment_type" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
      </div>
      <div v-if="formulario.equipment_type == 1 || formulario.equipment_type == 0" class="mt-1">
        <FormularioSuperFormEquipment @submit="handleSuperFormSubmit" />
      </div>
      <div id="simpleForm" v-else>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
          <div> <!-- Nombre del item -->
            <label class="label">
              <span class="block text-md font-medium leading-6 ">Nombre del Item</span>
            </label>
            <VeeField name="name" type="text" placeholder="Articulo" v-model="formulario.name" :class="`input w-full mt-1 ${errors.name ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="name" class="text-error animate__animated animate__fadeIn label block"></VeeErrorMessage>
          </div>
          <div> <!-- Serial del item -->
            <label class="label">
              <span class="block text-md font-medium leading-6 ">Serial de Item</span>
            </label>
            <VeeField name="serial_number" type="text" placeholder="AH1234" v-model="formulario.serial_number" :class="`input uppercase w-full mt-1 ${errors.serial_number ? 'input-error' : 'input-bordered'}`" />
            <VeeErrorMessage name="serial_number" class="text-error animate__animated animate__fadeIn label block"></VeeErrorMessage>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3  gap-2">
          <div > <!-- descripción del item -->
            <label class="label">
              <span class="block text-md font-medium leading-6 ">Descripción del Item</span>
            </label>
            <VeeField name="description" as="textarea" :class="`textarea textarea-bordered  w-full mt-1 ${errors.description ? 'textarea-error' : 'textarea-bordered'}`" placeholder="Descripción" v-model="formulario.description"></VeeField>
            <VeeErrorMessage name="description" class="text-error animate__animated animate__fadeIn label block"></VeeErrorMessage>
          </div>
          <div> <!-- Codigo de barras -->
            <label class="label">
              <span class="block text-md font-medium leading-6 ">codigo de barras</span>
            </label>
            <VueBarcode v-if="barcodeValue" :value="barcodeValue" format="EAN13" tag="svg" class="w-full block"/>
            <VueBarcode v-else value="1234567890" tag="svg" class="w-full block" ></VueBarcode>
          </div>
          <div> <!-- Imagen del item -->
            <label class="label">
              <span class="block text-md font-medium leading-6 ">Imagen del item</span>
            </label>
            <input type="file" ref="inputFile" class="file-input file-input-bordered w-full" name="resource" @change="handleFileChange" />
            <div class="card card-compact w-full">
              <div class="card-body">
                <figure class="mt-2">
                  <img ref="itemPhoto" @click="openModal(true)" src="https://www.shutterstock.com/image-vector/default-image-icon-vector-missing-600nw-2079504220.jpg" alt="Imagen del articulo" width="360" />
                </figure>
                <CardImagenFull idModal="modal-imagen" :isModalOpen="isModalOpen" :imagen="itemPhoto?.src" @close="openModal"></CardImagenFull>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex gap-2 grid grid-cols-2">
        <NuxtLink to="/inventario/items" class="btn btn-neutral mb-2">Cancelar</NuxtLink>
        <button type="submit" class="btn btn-primary" :disabled="!meta.valid">Guardar</button>
      </div>
    </VeeForm>
  </div>
</template>

<script lang="ts" setup>
import { ref, watch } from 'vue';
import * as yup from 'yup';
import type { ItemEntity } from '~/Domain/Models/Entities/item';




const emits = defineEmits(["enviar"]);
const inputFile = ref();
const { setImagen } = useImagen();
const itemPhoto = ref<HTMLImageElement | null>(null);
const isModalOpen = ref(false);
const barcodeValue = ref<string | null>(null);
const superFormData = ref({}); // Guardar datos del formulario secundario

function openModal(valor: boolean) {
  isModalOpen.value = valor;
}

yup.setLocale({
  mixed: {
    default: "*llenar campo"
  },
  number: {
    moreThan: "Seleccione una opcion valida"
  },
});

const equipo = ref({
  tipo: [
    {value: 1, text: 'Equipo de pista'},
    {value: 2, text: 'administrativo'},
    {value: 3, text: 'mantenimiento'}
  ]
});

const formularioSchema = yup.object({
  name: yup.string().required(),
  serial_number: yup.string().required(),
  description: yup.string().required(),
  equipment_type: yup.number().required().moreThan(0),
});

const formulario: Ref<ItemEntity> = ref({
  name: '',
  serial_number: '',
  description: '',
  equipment_type: 0,
});

watch(() => formulario.value.serial_number, (newSerialNumber) => {
  if (!newSerialNumber) {
    barcodeValue.value = null;
    return;
  }
  barcodeValue.value = newSerialNumber;
  return;
});

barcodeValue.value = formulario.value.serial_number;

const handleFileChange = (event: Event) => {
  const file = (event.target as HTMLInputElement).files?.[0];
  if (file != undefined) {
    formulario.value.resource = file;
    if (itemPhoto.value != undefined) {
      setImagen(file, itemPhoto);
    }
  }
};

const handleSuperFormSubmit = (data: any) => {
  superFormData.value = data;
};

const onSubmit = (values: any) => {
  const itemEntity: ItemEntity = values;
  if (formulario.value.resource == null) return console.error("falta imagen");
  itemEntity.resource = formulario.value.resource;
  const combinedData = { ...itemEntity, ...superFormData.value };
  console.log(combinedData);
  emits("enviar", combinedData);
};
</script>
