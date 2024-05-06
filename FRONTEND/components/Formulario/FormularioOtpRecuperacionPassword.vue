<template>
  <div>
    <section class="">
      <h1 class="card-title">Código de Verificación</h1>
      <p class="mt-2 text-sm">A su correo debió llegar un código. Por favor, digite el código.</p>

      <div class="w-[300px] mx-auto bg-white rounded-xl p-5 mt-3 ">
        <p class="mt-2 text-sm text-center mb-2">Código de 6 digitos</p>
        <VerificadorOtpInput v-model="code" :fields="6"></VerificadorOtpInput>
      </div>

      <div class="card-actions justify-center">
        <button type="submit" class="btn btn-primary">Confirmar</button>
      </div>

    </section>

    <div class="text-center text-primary">
      <nuxtLink href="/forgot-password">
        <span
          class="text-sm  inline-block  hover:text-primary hover:underline hover:cursor-pointer transition duration-200">
          Reenviar Codigo
        </span>
      </nuxtLink>
    </div>
  </div>
</template>

<script lang="ts" setup>
const code = ref();

</script>

<style></style>