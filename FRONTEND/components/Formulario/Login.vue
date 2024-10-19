<template>
  <VeeForm v-slot="{ handleSubmit, resetForm }" :validation-schema="formulario" as="div">
    <form @submit="handleSubmit($event, onSubmit)">

      <div class="form-control w-full mb-2">
        <label class="label">
          <span class='label-text text-base-content'>Correo Electronico * </span>
        </label>
        <VeeField class="input  input-bordered w-full" placeholder="usuario@correo.com" name="email"
          :v-bind="login.email" v-model="login.email" />
        <VeeErrorMessage name="email" class="text-right text-error animate__animated  animate__fadeIn">
        </VeeErrorMessage>
      </div>

      <!-- {/* Password Input */} -->
      <div class='form-control w-full mb-2'>
        <label class="label">
          <span class='label-text text-base-content'>Contraseña *</span>
        </label>
        <VeeField type="password" class="input  input-bordered w-full" placeholder="**********" name="password"
          autocomplete="password" v-model="login.password" />
        <VeeErrorMessage name="password" class="text-right  text-error animate__animated  animate__fadeIn">
        </VeeErrorMessage>
      </div>


      <!-- {/* Forgot Password Link */} -->
      <div class="text-right text-primary">
        <button type="button" @click="forgotPassword">
          <span
            class="text-sm  inline-block  hover:text-primary hover:underline hover:cursor-pointer transition duration-200">
            Olvido Su Contraseña?
          </span>
        </button>
      </div>
      <button type="submit" class="btn mt-2 w-full btn-secondary">
        Iniciar Sesión
      </button>
    </form>
  </VeeForm>
</template>

<script lang="ts" setup>

import { yup } from '@/utils/yup.config';
import { LoginDTO } from '~/Domain/DTOs/Auth/LoginDTO';

const emits = defineEmits<{
  (event: "callback", payload: LoginDTO): void, 
  (event: "forgot-password", payload: void): void,
}>();
const login: Ref<LoginDTO> = ref(new LoginDTO());

const formulario = yup.object({
  email: yup.string().required().email(),
  password: yup.string().required()
})

const forgotPassword = () => {
  return emits("forgot-password");
}

const onSubmit = async (values: any, { resetForm }: any) => {
  const loginDTO = new LoginDTO(values);
  return emits("callback", loginDTO);
}


</script>

<style scoped></style>