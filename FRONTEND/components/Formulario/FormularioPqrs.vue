<template>
  <div>
    <VeeForm :validationSchema="validacionFormularioPQRS" @submit="onSubmit" v-slot="{ resetForm }">
      <div>
        <label for="name" class="label">
          <span class="block text-md font-medium leading-6 ">Asunto</span>
        </label>
        <VeeField name="name" id="name" type="select" placeholder="Asunto (Opcional)" v-model="formularioPQRS.name"
          class="input w-full mt-1 input-bordered" autocomplete="off" />
        <VeeErrorMessage name="name" class="text-sm text-error animate__animated animate__fadeIn label block">
        </VeeErrorMessage>
      </div>
      <div>
        <label for="option" class="label">
          <span class="block text-md font-medium leading-6 ">Tipo de PQR</span>
        </label>
        <VeeField name="opcion"  id="option" as="select" v-model="formularioPQRS.option" class="select w-full mt-1 select-bordered"
          autocomplete="off">
          <option value="0" disabled>Seleccione</option>
          <option value="1">Petición</option>
          <option value="2">Queja</option>
          <option value="3">Mejora</option>
        </VeeField>
        <VeeErrorMessage name="opcion" class="text-error text-sm animate__animated animate__fadeIn label block">
        </VeeErrorMessage>
      </div>
      <div>
        <label for="descripcion" class="label">
          <span class="block text-md font-medium leading-6 ">Descripción</span>
        </label>
        <VeeField name="descriptionPQRS" as="textarea" id="descripcion"
          placeholder="Por favor, redacte su petición, queja o recurso de manera respetuosa, clara y concisa sin exceder los 500 caracteres"
          v-model="formularioPQRS.descriptionPQRS" autocomplete="off" class="textarea w-full mt-1 textarea-bordered" />
        <p class=" text-sm text-gray-500">{{ remainingCharacters }} caracteres restantes</p>
        <VeeErrorMessage name="descriptionPQRS"
          class="text-error text-sm animate__animated animate__fadeIn label block">
        </VeeErrorMessage>
      </div>
      <ButtonOptions @cancel="resetFormFields(resetForm)"></ButtonOptions>
    </VeeForm>
  </div>
</template>

<script lang="ts" setup>
import { ref, computed, watch } from 'vue';
import { PqrsEntity } from '~/Domain/Models/Entities/pqrs';
import * as yup from 'yup';

// Definir las props
const props = defineProps<{
  shouldResetForm: boolean
}>();

const emits = defineEmits<{
  (event: "callback", payload: PqrsEntity): void
  (event: "clickbuttoncancel", payload: void): void
}>();

const formularioPQRS = ref(new PqrsEntity(null));

// Crear una referencia para resetForm
const formResetFunction = ref<any>(null);

const validacionFormularioPQRS = yup.object({
  opcion: yup.string()
    .oneOf(['1', '2', '3'], 'Seleccione una opción válida *')
    .required('*Campo requerido'),
  descriptionPQRS: yup.string()
    .max(500, 'La descripción no puede exceder los 500 caracteres *')
    .required('*Campo requerido'),
});

const remainingCharacters = computed(() => {
  return 500 - formularioPQRS.value.descriptionPQRS.length;
});

// Observador para resetear el formulario cuando la prop `shouldResetForm` cambie
watch(() => props.shouldResetForm, (newValue) => {
  if (newValue && formResetFunction.value) {
    formularioPQRS.value = new PqrsEntity(null); // Reiniciar los datos del formulario
    formResetFunction.value();
  }
});

const onSubmit = (values: any, { resetForm }: { resetForm: Function }) => {
  const formulario = new PqrsEntity(formularioPQRS.value);
  emits("callback", formulario);
  setFormResetFunction(resetForm);
};
const resetFormFields = (resetForm: Function) => {
  formularioPQRS.value = new PqrsEntity(null); // Reiniciar los datos del formulario
  resetForm(); // Restablecer el estado de validación de VeeForm
  emits("clickbuttoncancel");
};
// Función para almacenar la referencia de resetForm
const setFormResetFunction = (resetForm: any) => {
  formResetFunction.value = resetForm;
};
</script>

<style></style>
