<template>

  <div class="py-24 px-10">
    <h2 class="text-2xl font-semibold mb-2 text-center">Login</h2>
    <VeeForm @submit="onSubmit" :validation-schema="formularioSchema">
      <!-- {/* Email Input */} -->
      <div class="form-control w-full mt-4">
        <label class="label">
          <span class='label-text text-base-content'>Correo Electronico</span>
        </label>
        <VeeField class="input  input-bordered w-full" placeholder="Correo Electronico" name="email"
          v-model="login.email" />
      </div>

      <VeeErrorMessage name="email" class="text-center text-error mt-8">
      </VeeErrorMessage>
      <!-- {/* Password Input */} -->
      <div class='form-control w-full mt-4'>
        <label class="label">
          <span class='label-text text-base-content'>Contraseña</span>
        </label>
        <VeeField type="password" class="input  input-bordered w-full" placeholder="password" name="password"
          autocomplete="password" v-model="login.password" />
      </div>

      <VeeErrorMessage name="password" class="text-center text-error mt-8">
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
      <button type="submit" class="btn mt-2 w-full btn-primary">
        Iniciar Sesión
      </button>
    </VeeForm>
  </div>

</template>

<script lang="ts" setup>

import { yup } from '@/utils/yup.config';
import type { LoginRequest } from '~/Domain/Models/Api/Request/login.request.model';

const login: Ref<LoginRequest> = ref({});

const formularioSchema = yup.object({
  email: yup.string().required().email(),
  password: yup.string().required()
})

const onSubmit = async (values: any, { resetForm }: any) => {
  console.log(values);
  login.value = { ...{} }
  resetForm();
  return;
}


</script>

<style scoped></style>