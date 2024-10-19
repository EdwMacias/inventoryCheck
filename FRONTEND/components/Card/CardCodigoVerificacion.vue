<template>
  <VeeForm @submit="onSubmit" :validation-schema="schemaCodigo">
    <VeeField name="code" class="mb-5" v-slot="{ handleChange }">
      <FormularioOtpRecuperacionPassword @update:modelValue="handleChange" />
    </VeeField>

    <VeeErrorMessage name="code" class=" p-25
                  text-error animate__animated  animate__fadeIn">
    </VeeErrorMessage>

    <div class="card-actions justify-end mt-5">
      <button type="submit" class="btn btn-primary">Confirmar</button>
    </div>
  </VeeForm>
</template>

<script lang="ts" setup>

const emits = defineEmits<{
  (event: "callback", payload: string): void
}>();

const schemaCodigo = yup.object({
  code: yup.string()
    .required('El código es requerido')
    .matches(/^\d{6}$/, 'El código debe tener exactamente 6 dígitos y solo números positivos')
});


async function onSubmit(value: any) {
  emits("callback",value.code);
}


</script>

<style></style>