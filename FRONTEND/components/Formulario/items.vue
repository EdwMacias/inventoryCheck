<template>
  <div class="mx-2">
    <h2 class="font-semibold text-xl mt-2">Creación de artículos</h2>

    <VeeForm :validationSchema="formularioSchema" @submit="onSubmit" v-slot="{ meta, errors }">

      <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <div>
          <label class="label">
            <span class="block text-md font-medium leading-6 ">Nombre</span>
          </label>
          <VeeField name="name" type="text" placeholder="Articulo" v-model="formulario.name"
            :class="`input w-full mt-1 ${errors.name ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="name" class="text-error animate__animated animate__fadeIn"></VeeErrorMessage>
        </div>
        <div>
          <label class="label">
            <span class="block text-md font-medium leading-6 ">Serial:</span>
          </label>
          <VeeField name="serial_number" type="text" placeholder="AH1234" v-model="formulario.serial_number"
            :class="`input w-full mt-1 ${errors.serial_number ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="serial_number" class="text-error animate__animated animate__fadeIn"></VeeErrorMessage>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2  gap-2">
        <div>
          <label class="label">
            <span class="block text-md font-medium leading-6 ">Descripción del articulo</span>
          </label>
          <VeeField name="description" as="textarea"
            :class="`textarea textarea-bordered  w-full mt-1 ${errors.description ? 'textarea-error' : 'textarea-bordered'}`"
            placeholder="Descripción" v-model="formulario.description">
          </VeeField>
          <VeeErrorMessage name="description" class="text-error animate__animated animate__fadeIn"></VeeErrorMessage>
        </div>
        <div>
          <div class="card card-compact w-full">
            <div class="card-body">
                <input type="file" class="file-input file-input-bordered w-full" name="resource" @change="handleFileChange" />
              <figure class="mt-2">
                <img ref="itemPhoto" @click="openModal(true)"
                  src="https://www.shutterstock.com/image-vector/default-image-icon-vector-missing-600nw-2079504220.jpg"
                  alt="Imagen del articulo" width="360"  />
              </figure>
              <CardImagenFull :isModalOpen="isModalOpen" :imagen="itemPhoto?.src" @close="openModal" ></CardImagenFull>
            </div>
          </div>
        </div>
      </div>
      <div class=" flex gap-2 w-full grid grid-cols-1 md:grid-cols-2">
        <NuxtLink to="/inventario/items" class="btn btn-neutral w-50">Cancelar</NuxtLink>
        <button type="submit" class="btn btn-primary" :disabled="!meta.valid">Guardar</button>
      </div>
    </VeeForm>
  </div>
</template>

<script lang="ts" setup>
import type { ItemEntity } from '~/Domain/Models/Entities/item';
const emits = defineEmits(["enviar"]);

const { setImagen } = useImagen();
const itemPhoto = ref<HTMLImageElement | null>(null);
const isModalOpen = ref(false);

function openModal(valor : boolean) {
  isModalOpen.value = valor;
}



yup.setLocale({
  mixed: {
    default: "*llenar campo"
  },
  number: {
    moreThan: "*Debe haber valores dentro del formulario"
  },
})

const formularioSchema = yup.object({
  name: yup.string().required(),
  serial_number: yup.string().required(),
  description: yup.string().required(),
})

const formulario: Ref<ItemEntity> = ref({
  name: '',
  serial_number: '',
  description: '',
});

const handleFileChange = (event: Event) => {
  const file = (event.target as HTMLInputElement).files?.[0];
  if (file) {
    formulario.value.resource = file;
    if (itemPhoto.value != undefined) {
      setImagen(file, itemPhoto);
    }
  }
}


const onSubmit = (values: any) => {
  const itemEntity: ItemEntity = values;
  if (formulario.value.resource == null) return console.error("falta imagen");
  itemEntity.resource = formulario.value.resource;
  return emits("enviar", itemEntity);
};
</script>

<!-- <style scoped lang="scss"></style> -->