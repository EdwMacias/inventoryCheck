<template>
  <div class="hero bg-base-200 min-h-screen">
    <div class=" hero-content flex flex-col-reverse lg:flex-row items-center justify-center">
      <div class="w-full lg:min-w-[500px]">
        <div class="text-center">
          <button class="btn btn-ghost mb-1">
            <Tema />
          </button>
        </div>
        <div class="card bg-base-100 shadow-2xl">
          <div class="stats shadow">
            <div class="stat">
              <p for="buzon" class="stat-title">Buzón PQRS</p>
            </div>
            <label for="modalpqrs" class="btn btn-secondary btn-circle fixed-button stat-figure mr-2">
              <SvgInbox />
            </label>
          </div>
          <div class="md:py-6 py-2 px-10">
            <p class="text-2xl font-semibold mb-2 text-center ">Iniciar Sesión</p>
            <FormularioLogin @callback="login" @forgot-password="forgotPassword" />
          </div>

        </div>
      </div>
      <div>
        <p class="pt-8">
          <img src="/images/LogoEmpresa.webp" alt="Logo Cedac" class="rounded-xl w-full"></img>
        </p>
      </div>
    </div>
  </div>

  <input type="checkbox" id="modalpqrs" class="modal-toggle" :checked="false" />
  <div class="modal" role="dialog">
    <div class="modal-box">
      <label for="modalpqrs" class="btn btn-neutral btn-circle absolute right-0 top-0  mx-2 mt-1">X</label>
      <FormularioPqrs @clickbuttoncancel="clickButtonCancel" :shouldResetForm="shoulResetForm" @callback="crearPqrs" />
      <div class="modal-action">
      </div>
    </div>
    <label class="modal-backdrop" for="modalpqrs">Close</label>
  </div>

</template>
<script setup lang="ts">
import type { LoginDTO } from '~/Domain/DTOs/Auth/LoginDTO';
import type { PqrsEntity } from '~/Domain/Models/Entities/pqrs';
import { PqrsRepository } from '~/Infrastructure/Repositories/pqrs/pqrs.repository';
const spinnerStore = SpinnerStore();
const { $swal } = useNuxtApp()
import { UsuarioServices } from '~/Domain/Client/Services/usuario.service';
const router = useRouter();

definePageMeta({
  path: '/login',
})

const shoulResetForm: Ref<boolean> = ref(false);
const clickButtonCancel = () => {
  const inputModal = document.getElementById('modalpqrs') as HTMLInputElement;
  inputModal.checked = false;
}

const forgotPassword = () => {
  return router.push('/forgot-password')
}

const login = async (loginDTO: LoginDTO) => {
  const spinnerStore = SpinnerStore();
  const alertaStore = AlertaStore();
  spinnerStore.activeOrInactiveSpinner(true);

  try {
    await UsuarioServices.Login(loginDTO.toFormData());
    spinnerStore.activeOrInactiveSpinner(false);
    return router.push('/')

  } catch (error: any) {
    alertaStore.emitNotificacion({ mensaje: error, tipo: 'warning', cabecera: 'Notificación' });
  }
  spinnerStore.activeOrInactiveSpinner(false);
}

const crearPqrs = async (formulario: PqrsEntity) => {
  try {
    shoulResetForm.value = false;
    spinnerStore.status = true; // Mostrar spinner

    await PqrsRepository.Create(formulario.toFormData()); // Enviar formulario

    clickButtonCancel(); // Simular el clic en el botón de cancelar para cerrar modal o limpiar

    spinnerStore.status = false; // Ocultar spinner
    shoulResetForm.value = true; // Reiniciar el formulario

    // Mostrar alerta de éxito
    await $swal.fire({
      title: '¡Solicitud creada!',
      text: 'Tu PQRS ha sido enviada correctamente.',
      icon: 'success',
      confirmButtonText: 'Aceptar',
    });

  } catch (error) {
    // Manejar errores si algo falla
    spinnerStore.status = false; // Ocultar spinner en caso de error
    console.error(error);

    // Mostrar alerta de error
    await $swal.fire({
      title: 'Error',
      text: 'Hubo un problema al enviar tu PQRS. Por favor, intenta nuevamente.',
      icon: 'error',
      confirmButtonText: 'Aceptar',
    });
  }

}

</script>
<style></style>