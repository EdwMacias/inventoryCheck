<template>
  <div>
    <h2 class="card-title">Código de Verificación</h2>
    <p class="mt-2 text-sm mb-6">A su correo debió llegar un código. Por favor, digite el código.</p>

    <VeeForm @submit="onSubmit" :validation-schema="schemaCodigo">
      <VeeField name="code" v-slot="{ handleChange }">
        <FormularioOtpRecuperacionPassword @update:modelValue="handleChange" />
      </VeeField>

      <VeeErrorMessage name="code" class="text-center justify-center
                  text-error mt-8 animate__animated  animate__fadeIn">
      </VeeErrorMessage>

      <div class="text-center mt-4">
        <p class="text-sm">No recibiste ningún código?</p>
        <nuxtLink to="/forgot-password">
          <span class="text-sm text-primary inline-block  
                  hover:text-primary hover:underline 
                  hover:cursor-pointer transition duration-200">
            Reenviar Codigo
          </span>
        </nuxtLink>
      </div>

      <div class="card-actions justify-end mt-2">
        <button type="submit" class="btn btn-primary">Confirmar</button>
      </div>
    </VeeForm>
  </div>
</template>

<script lang="ts" setup>
import swal from 'sweetalert2';
import { RecoveryPasswordServices } from '~/domain/client/services/recovery/password/recovery.password.services';


const emit = defineEmits(["reenviarCodigo", "confirmar"]);

const schemaCodigo = yup.object({
  code: yup.number().required().min(100000, 'El código debe tener al menos 6 dígitos')
    .max(999999, 'El código debe tener como máximo 6 dígitos')
})

async function onSubmit(value: any) {

  const passwordStore = useRecoveryPasswordStore();
  const spinnerStore = SpinnerStore();
  const alertaStore = AlertaStore();
  const code: number = value.code;
  spinnerStore.activeOrInactiveSpinner(true);
  const email = passwordStore.email;

  try {
    let response;
    if (email) {
      response = await RecoveryPasswordServices.ValidationCodeRecovery(email, code);
      passwordStore.setCode(response.data.codigo_autenticacion);
    } else {
      return swal.fire({
        icon: 'error',
        title: "Notificación error",
        text: "Hubo un error por favor recargue la pagina y vuelva a intentar",
        showCancelButton: false,
        confirmButtonText: 'Confirmar',
        reverseButtons: true
      }).then(button => {
        if (button.isConfirmed) {
          return location.reload();
        }
        return location.reload();
      })
    }
    // passwordStore.setCode(code);
    spinnerStore.activeOrInactiveSpinner(false);

    swal.fire({
      icon: 'success',
      title: "Notificación",
      text: 'Codigo Validado Correctamente',
      showCancelButton: false,
      confirmButtonText: 'Confirmar',
      reverseButtons: true
    }).then(button => {
      if (button.isConfirmed) {
        return emit("confirmar", true)
      }
    })
  } catch (error: any) {
    alertaStore.emitNotificacion({ mensaje: error.response.data.messages, tipo: 'warning', cabecera: 'Notificación' });
  }
  spinnerStore.activeOrInactiveSpinner(false);


}
</script>

<style></style>