<template>
  <VeeForm :validationSchema="schemaPassword" @submit="onSubmit">
    <VeeField autocomplete="off" name="password" type="password" v-slot="{ field, meta }" class="mt-3">
      <p class="text-sm">Nueva contraseña</p>
      <label class="input input-bordered flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
          <path fill-rule="evenodd"
            d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
            clip-rule="evenodd" />
        </svg>
        <input autocomplete="off" type="password" class="grow" placeholder="************" v-bind="field" />
      </label>
    </VeeField>

    <VeeErrorMessage name="password" class="text-center justify-center
                  text-error mt-8 animate__animated  animate__fadeIn">
    </VeeErrorMessage>

    <VeeField autocomplete="off" name="password_confirmation" type="password" v-slot="{ field, meta }">
      <p class="text-sm mt-2 mb-2">Confirme su contraseña</p>
      <label class="input input-bordered flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
          <path fill-rule="evenodd"
            d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
            clip-rule="evenodd" />
        </svg>
        <input autocomplete="off" type="password" class="grow" placeholder="************" v-bind="field" />
      </label>
    </VeeField>

    <VeeErrorMessage name="password_confirmation" class="text-center justify-center
                  text-error mt-8 animate__animated  animate__fadeIn">
    </VeeErrorMessage>

    <div class="card-actions justify-end mt-2">
      <button type="submit" class="btn btn-primary">Confirmar</button>
    </div>
  </VeeForm>
</template>

<script lang="ts" setup>

const emits = defineEmits<{
  (event: "callback", payload: { password: string, password_confirmation: string }): void
}>();

const schemaPassword = yup.object({
  password: yup.string()
    .required('La contraseña es obligatoria')
    .min(8, 'La contraseña debe tener al menos 8 caracteres')
    .matches(
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*!])[a-zA-Z\d@#$%^&*!]{8,}$/,
      ({ regex }) => `La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y uno de los siguientes caracteres especiales: ${regex.source.replace(/[()^$.*+?|[\]\\]/g, '')}`
    ),
  password_confirmation: yup.string()
    .required('Debes confirmar tu contraseña')
    .oneOf([yup.ref('password')], 'Las contraseñas deben coincidir')
});

function onSubmit(values: any) {
  const passwordReset = {
    password: values.password,
    password_confirmation: values.password_confirmation
  }

  return emits("callback", passwordReset);
}

</script>

<style></style>