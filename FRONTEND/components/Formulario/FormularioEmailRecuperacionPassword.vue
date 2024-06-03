<template>
  <h1 class="card-title">¿Olvidaste tu contraseña?</h1>
  <p class="mb-2 text-xs">Por favor, ingrese el correo electrónico que utilizó para registrarse.</p>
  <VeeForm v-slot="{ handleSubmit, resetForm }" :validationSchema="schemaCorreo" as="div">
    <form @submit="handleSubmit($event, onSubmit)" method="post" id="correoContraseña">
      <VeeField name="email" type="email" v-slot="{ field, meta }">
        <label class="input input-bordered flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
            <path
              d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
            <path
              d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
          </svg>
          <input type="email" class="grow" placeholder="Email" v-bind="field" />
        </label>
      </VeeField>
      <VeeErrorMessage name="email" class="text-center text-error mt-8 animate__animated  animate__fadeIn">
      </VeeErrorMessage>
      <div class="card-actions justify-end mt-20">
        <button type="submit" class="btn btn-primary">Confirmar</button>
      </div>
    </form>
  </VeeForm>
</template>

<script lang="ts" setup>
import swal from 'sweetalert2';
import { RecoveryPasswordServices } from '~/Domain/Client/Services/recovery/password/recovery.password.services';

const emit = defineEmits(["nextstep"])

async function onSubmit(values: any) {

  const spinnerStore = SpinnerStore();
  const alertaStore = AlertaStore();
  const passwordStore = useRecoveryPasswordStore();
  const email: string = values.email;
  spinnerStore.activeOrInactiveSpinner(true);

  try {
    await RecoveryPasswordServices.CodeTemporaryRecovery(email);
    passwordStore.setEmail(email);
    spinnerStore.activeOrInactiveSpinner(false);
    swal.fire({
      icon: 'success',
      title: "Notificación",
      text: 'Recibira un codigo a su correo.',
      showCancelButton: false,
      confirmButtonText: 'Confirmar',
      reverseButtons: true
    }).then(button => {
      if (button.isConfirmed) {
        return emit("nextstep")
      }
    })
  } catch (error: any) {
    alertaStore.emitNotificacion({ mensaje: error.response.data.messages, tipo: 'warning', cabecera: 'Notificación' });
  }
  spinnerStore.activeOrInactiveSpinner(false);


}
const schemaCorreo = yup.object({
  email: yup.string().required().email()
});



</script>

<style></style>