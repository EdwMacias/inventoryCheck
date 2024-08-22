<template>
  <div v-if="isOpen" class="modal modal-open" @click.self="handleCancel">
    <div class="modal-box" @click.stop>
      <VeeForm :validationSchema="validacionFormularioPQRS" @submit="onSubmit" v-slot="{resetForm, meta, errors }">
        <div> <!-- Nombre del item -->
          <label class="label">
            <span class="block text-md font-medium leading-6 ">Formato de PQRS</span>
          </label>
          <VeeField name="name" type="select" placeholder="Nombre (Opcional)" v-model="formularioPQRS.name"
            :class="`input w-full mt-1 ${errors.name ? 'input-error' : 'input-bordered'}`" />
          <VeeErrorMessage name="name" class="text-error animate__animated animate__fadeIn label block">
          </VeeErrorMessage>
        </div>
        <div>
          <label class="label">
            <span class="block text-md font-medium leading-6 ">Opcion</span>
          </label>
          <VeeField name="opcion" as="select" v-model="formularioPQRS.option" :class="`select w-full mt-1 ${errors.opcion ? 'select-error' : 'select-bordered'}`" >
          <option value="0" disabled>Seleccione</option>
          <option value="1">Petición</option>
          <option value="2">Queja</option>
          <option value="3">Mejora</option>
          </VeeField>
          <VeeErrorMessage name="opcion" class="text-error animate__animated animate__fadeIn label block">
          </VeeErrorMessage>
        </div>
        <div>
          <label class="label">
            <span class="block text-md font-medium leading-6 ">Descripción</span>
          </label>
          <VeeField name="descriptionPQRS" as="textarea" placeholder="Por favor, redacte su petición, queja o recurso de manera respetuosa, clara y concisa sin exceder los 500 caracteres" v-model="formularioPQRS.descriptionPQRS"
          :class="`textarea w-full mt-1 ${errors.descriptionPQRS ? 'textarea-error' : 'textarea-bordered'}`" />
          <p class=" text-sm text-gray-500">{{ remainingCharacters }} caracteres restantes</p>
          <VeeErrorMessage name="descriptionPQRS" class="text-error animate__animated animate__fadeIn label block">
          </VeeErrorMessage>
        </div>
          <ButtonOptions class="mt-5" @save="() => handleSave(resetForm)" @cancel="handleCancel" ></ButtonOptions>
      </VeeForm>
    </div>
  </div>
</template>

<script lang="ts" setup>
import swal from 'sweetalert2';
import type { FormContext } from 'vee-validate';

const router = useRouter();
const emits = defineEmits(["callback", "close"]);
const isModalOpen = ref(false);

const remainingCharacters = computed(() => {
  return 500 - formularioPQRS.value.descriptionPQRS.length;
});

const props = defineProps({
  isOpen: Boolean,
  link: {
    type: String,
    default: '/'
  },
});

const handleEsc = (event: KeyboardEvent) => {
  if (event.key === 'Escape') {
    handleCancel();
  }
};

onMounted(() => {
  window.addEventListener('keydown', handleEsc);
});

interface PQRS { name?: string | null , option: number, descriptionPQRS: string };

const handleSave = (resetForm: FormContext['resetForm']) => {
  const formValues = { ...formularioPQRS.value };
  onSubmit(formValues);
  setTimeout(() => {
    emits('close');
  }, 500);
  resetForm();
}
const handleCancel = () => {
  emits('close');
};

const formularioPQRS: Ref<PQRS> = ref({
  name: '',
  option: 0,
  descriptionPQRS: '',
})

const validacionFormularioPQRS = yup.object({
  opcion: yup.number().required('*Campo requerido'),
  descriptionPQRS: yup.string().max(500, 'La descripción no puede exceder los 500 caracteres')
  .required('*Campo requerido'),
})

const onSubmit = (values: any) => {
  const pqrsEntity = values;
  if (formularioPQRS.value.descriptionPQRS == null) {
    swal.fire({
      icon: 'error',
      title: "Falta información",
      text: "Solo es necesario el tipo de opción y la descripción, rellene los campos.",
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