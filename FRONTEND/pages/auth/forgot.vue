<template>
  <div class="min-h-screen bg-base-200 hero">

    <NuxtLink to="/login" class="btn btn-primary mx-2 mt-2 absolute top-0 left-0">
      <i class="bi bi-box-arrow-left"></i> Regresar al inicio de sesion
    </NuxtLink>

    <div class="container mx-auto mt-20">
      <div class="card max-w-3xl lg:card-side mx-auto bg-base-100 shadow-xl">

        <ul :class="`steps lg:steps-vertical p-3`">
          <li :class="stepClasses('step_email')">Ingrese correo</li>
          <li :class="stepClasses('step_code')">Ingrese el pin</li>
          <li :class="stepClasses('step_password')">Cambio Contraseña</li>
        </ul>

        <div class="card-body">

          <div :class="[{ 'hidden': !steps.step_email }]">
            <h1 class="card-title">¿Olvidaste tu contraseña?</h1>
            <p class="mb-2 text-xs">Por favor, ingrese el correo electrónico que utilizó para registrarse.</p>
            <FormularioEmailRecuperacionPassword @callback="sendEmail" />
          </div>

          <div :class="[{ 'hidden': !steps.step_code }]">
            <h2 class="card-title">Código de Verificación</h2>
            <p class="mt-2 text-sm mb-6">A su correo debió llegar un código. Por favor, digite el código.</p>
            <CardCodigoVerificacion @callback="sendCode" />
          </div>

          <div :class="[{ 'hidden': !steps.step_password }]">
            <h2 class="card-title">Cambio Contraseña</h2>
            <p class="mt-2 text-sm mb-6">Digite su nueva contraseña</p>

            <CardRecuperacionPassword @callback="recoveryPassword"></CardRecuperacionPassword>
          </div>

        </div>
      </div>

    </div>
  </div>

</template>

<script lang="ts" setup>
definePageMeta({
  path: '/forgot-password',
})
import { RecoveryPasswordServices } from '~/Domain/Client/Services/recovery/password/recovery.password.services';
import type { PasswordRecovery } from '~/Domain/Models/Api/Request/password.recovery.model';
const { $swal } = useNuxtApp()

interface RecoverySteps {
  step_email: boolean,
  step_code: boolean,
  step_password: boolean,
  [key: string]: boolean
}

const steps: Ref<RecoverySteps> = ref({
  step_email: true,
  step_code: false,
  step_password: false,
})


function stepClasses(step: string) {
  return {
    'step': true,
    'step-primary': steps.value[step]
  };
}

const sendEmail = async (email: string) => {
  const spinnerStore = SpinnerStore();
  const alertaStore = AlertaStore();
  const passwordStore = useRecoveryPasswordStore();

  // Activa el spinner
  spinnerStore.activeOrInactiveSpinner(true);

  try {
    // Llamada al servicio para enviar el código de recuperación
    await RecoveryPasswordServices.CodeTemporaryRecovery(email);

    // Almacena el correo en el store
    passwordStore.setEmail(email);

    // Alerta de éxito
    $swal.fire({
      icon: 'success',
      title: "Notificación",
      text: 'Recibirá un código en su correo.',
      confirmButtonText: 'Confirmar',
    });

    steps.value.step_email = false;
    steps.value.step_code = true;

  } catch (error: any) {
    // Manejo de errores, con verificación de la existencia de mensajes en la respuesta
    const errorMessage = error.response?.data?.messages || 'Ocurrió un error inesperado';
    alertaStore.emitNotificacion({ mensaje: errorMessage, tipo: 'warning', cabecera: 'Notificación' });
  } finally {
    // Siempre desactiva el spinner al finalizar
    spinnerStore.activeOrInactiveSpinner(false);
  }
};

const sendCode = async (code: string) => {
  const passwordStore = useRecoveryPasswordStore();
  const spinnerStore = SpinnerStore();
  const alertaStore = AlertaStore();

  const email = passwordStore.email;

  // Activa el spinner antes de comenzar la operación
  spinnerStore.activeOrInactiveSpinner(true);

  try {
    if (!email) {
      // Mostrar alerta de error si no hay correo en el store
      return await $swal.fire({
        icon: 'error',
        title: "Notificación error",
        text: "Hubo un error, por favor recargue la página e intente nuevamente",
        confirmButtonText: 'Confirmar',
      }).then(() => location.reload());
    }

    const response = await RecoveryPasswordServices.ValidationCodeRecovery(email, code);
    passwordStore.setCode(response.data.codigo_autenticacion);

    // Mostrar alerta de éxito si la validación fue exitosa
    $swal.fire({
      icon: 'success',
      title: "Notificación",
      text: 'Código Validado Correctamente',
      confirmButtonText: 'Confirmar',
    });

    steps.value.step_email = false;
    steps.value.step_code = false;
    steps.value.step_password = true;

  } catch (error: any) {
    // Verifica si la respuesta tiene un mensaje de error específico
    const errorMessage = error.response?.data?.messages || 'Ocurrió un error inesperado';
    alertaStore.emitNotificacion({ mensaje: errorMessage, tipo: 'warning', cabecera: 'Notificación' });
  } finally {
    // Siempre desactiva el spinner
    spinnerStore.activeOrInactiveSpinner(false);
  }
}

const recoveryPassword = async (resetPassword: { password: string, password_confirmation: string }) => {
  const passwordStore = useRecoveryPasswordStore();
  const email = passwordStore.email;
  const code = passwordStore.code;
  const spinnerStore = SpinnerStore();
  const alertaStore = AlertaStore();

  spinnerStore.activeOrInactiveSpinner(true);

  try {
    // Validación básica de email y código
    if (!email || !code) {
      $swal.fire({
        icon: 'error',
        title: "Notificación error",
        text: "Hubo un error, por favor recargue la página e intente nuevamente",
        confirmButtonText: 'Confirmar',
      }).then(() => location.reload());
      return;
    }

    // Modelo para la recuperación de contraseña
    const passwordModel: PasswordRecovery = {
      email: email,
      password: resetPassword.password,
      password_confirmation: resetPassword.password_confirmation,
    };

    // Llamada al servicio para actualizar la contraseña
    await RecoveryPasswordServices.UpdatePassword(code, passwordModel);

    // Mensaje de éxito
    spinnerStore.activeOrInactiveSpinner(false);

    await $swal.fire({
      icon: 'success',
      title: "Notificación",
      text: 'Contraseña cambiada con éxito',
      confirmButtonText: 'Confirmar',
    });

    // Reiniciar estado y redirigir al login
    passwordStore.$reset();
    navigateTo("/login");

  } catch (error: any) {
    // Manejo de errores más robusto
    const errorMessage = error.response?.data?.messages || 'Ocurrió un error inesperado';
    alertaStore.emitNotificacion({
      mensaje: errorMessage,
      tipo: 'warning',
      cabecera: 'Notificación'
    });
  } finally {
    // Asegurar que el spinner siempre se desactive
    spinnerStore.activeOrInactiveSpinner(false);
  }

}

</script>