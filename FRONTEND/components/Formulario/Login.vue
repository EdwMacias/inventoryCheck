<template>
  <div class="py-24 px-10">
    <h2 class="text-2xl font-semibold mb-2 text-center">Iniciar Sesión</h2>
    <VeeForm v-slot="{ handleSubmit, resetForm }" :validation-schema="formulario" as="div">
      <form @submit="handleSubmit($event, onSubmit)">

        <div class="form-control w-full mt-4">
          <label class="label">
            <span class='label-text text-base-content'>Correo Electronico</span>
          </label>
          <VeeField class="input  input-bordered w-full" placeholder="Correo Electronico" name="email"
            :v-bind="login.email" v-model="login.email" />
        </div>

        <VeeErrorMessage name="email" class="text-center text-error mt-8 animate__animated  animate__fadeIn">
        </VeeErrorMessage>
        <!-- {/* Password Input */} -->
        <div class='form-control w-full mt-4'>
          <label class="label">
            <span class='label-text text-base-content'>Contraseña</span>
          </label>
          <VeeField type="password" class="input  input-bordered w-full" placeholder="password" name="password"
            autocomplete="password" v-model="login.password" />
        </div>

        <VeeErrorMessage name="password" class="text-center text-error mt-8 animate__animated  animate__fadeIn">
        </VeeErrorMessage>

        <!-- {/* Forgot Password Link */} -->
        <div class="text-right text-primary">
          <a href="/forgot-password">
            <span
              class="text-sm  inline-block  hover:text-primary hover:underline hover:cursor-pointer transition duration-200">
              Olvido Su Contraseña?
            </span>
          </a>
        </div>
        <button type="submit" class="btn mt-2 w-full btn-primary" :disabled="disableButton">
          Iniciar Sesión
        </button>
      </form>

    </VeeForm>
  </div>

</template>

<script lang="ts" setup>

import { yup } from '@/utils/yup.config';
import type { LoginRequest } from '~/Domain/Models/Api/Request/login.request.model';
import { UsuarioServices } from '~/Domain/client/services/usuario.service';
const spinnerStore = SpinnerStore();
const alertaStore = useMyAlertaStoreStore();

const disableButton: Ref<boolean> = ref(false);
const login: Ref<LoginRequest> = ref({});

const formulario = yup.object({
  email: yup.string().required().email(),
  password: yup.string().required()
})

const onSubmit = async (values: any, { resetForm }: any) => {

  spinnerStore.activeOrInactiveSpinner(true);

  try {
    const response = await UsuarioServices.Login(values);
    console.log(response);
  } catch (error: any) {
    spinnerStore.activeOrInactiveSpinner(false);
    alertaStore.emitNotificacion({ mensaje: error, tipo: 'warning', cabecera: 'Notificación' });
  }
}


</script>

<style scoped></style>