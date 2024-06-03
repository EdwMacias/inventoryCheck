<template>
  <div>
    <h2 class="card-title">Código de Verificación</h2>
    <p class="mt-2 text-sm mb-6">A su correo debió llegar un código. Por favor, digite el código.</p>

    <VeeForm @submit="onSubmit" :validation-schema="schemaCodigo">
      <VeeField name="code"  class="mb-5" v-slot="{ handleChange }">
        <FormularioOtpRecuperacionPassword @update:modelValue="handleChange" />
      </VeeField>

      <VeeErrorMessage name="code" class=" p-25
                  text-error animate__animated  animate__fadeIn">
      </VeeErrorMessage>

      <div class="card-actions justify-end mt-5">
        <button type="submit" class="btn btn-primary">Confirmar</button>
      </div>
    </VeeForm>
  </div>
</template>

<script lang="ts" setup>
import swal from 'sweetalert2';
import { RecoveryPasswordServices } from '~/Domain/Client/Services/recovery/password/recovery.password.services';


const emit = defineEmits(["reenviarCodigo", "confirmar"]);

const schemaCodigo = yup.object({
  code: yup.string()
    .required('El código es requerido')
    .matches(/^\d{6}$/, 'El código debe tener exactamente 6 dígitos, no se permiten letras')
});

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