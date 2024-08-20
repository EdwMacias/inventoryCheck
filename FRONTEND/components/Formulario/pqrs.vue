<template>
  <div v-if="isOpen" class="modal modal-open">
    <div class="modal-box">
      <VeeForm :validationSchema="validacionFormularioPQRS" @submit="onSubmit" v-slot="{ meta, errors }">
        <div> <!-- Nombre del item -->
          <label class="label">
            <span class="block text-md font-medium leading-6 ">Nombre del Item</span>
          </label>
          <VeeField name="name" type="text" placeholder="Articulo" v-model="formularioPQRS.name"
            :class="`input w-full mt-1 ${errors.name ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="name" class="text-error animate__animated animate__fadeIn label block">
          </VeeErrorMessage>
        </div>
        <div>
          <label class="label">
            <span class="block text-md font-medium leading-6 ">Descripción</span>
          </label>
          <VeeField name="descriptionPQRS" type="text-area" placeholder="Descripción" v-model="formularioPQRS.descriptionPQRS"
            :class="`input w-full mt-1 ${errors.descriptionPQRS ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="descriptionPQRS" class="text-error animate__animated animate__fadeIn label block">
          </VeeErrorMessage>
        </div>
        <div>
          <label class="label">
            <span class="block text-md font-medium leading-6 ">Opciones</span>
          </label>
          <VeeField name="opcion" type="number" v-model="formularioPQRS.option" :class="`input w-full mt-1 ${errors.opcion ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="opcion" class="text-error animate__animated animate__fadeIn label block">
          </VeeErrorMessage>
        </div>
          <ButtonOptions  @save="handleSave" @cancel="handleCancel" >Registrar</ButtonOptions>
      </VeeForm>
    </div>
  </div>
</template>

<script lang="ts" setup>
import swal from 'sweetalert2';
const router = useRouter();
const emits = defineEmits(["callback"]);
const isModalOpen = ref(false);

const props = defineProps({
  isOpen: Boolean,
  link: {
    type: String,
    default: '/'
  },
  
});

interface PQRS { name?: string | null , option: number, descriptionPQRS: string };

const handleSave = () => {
  onSubmit(formularioPQRS.value);
}
const handleCancel = () => {
  router.push(props.link);
}

const formularioPQRS: Ref<PQRS> = ref({
  name: '',
  option: 0,
  descriptionPQRS: '',
})

const validacionFormularioPQRS = yup.object({
  opcion: yup.number().required('*Campo requerido'),
  descriptionPQRS: yup.string().required('*Campo requerido'),
})


const onSubmit = (values: any) => {
  const pqrsEntity = values;
  if (formularioPQRS.value.descriptionPQRS == null) {
    swal.fire({
      icon: 'error',
      title: "Falta Descripcion",
      text: "Solo es necesario el tipo de llamado de atención y la descripción, rellene los campos.",
      showCancelButton: false,
      confirmButtonText: 'Aceptar',
      reverseButtons: true
    });
    return;
  }
  emits("callback", pqrsEntity);
  router.push('/');
}
</script>

<style>

</style>