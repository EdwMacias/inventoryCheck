<template>
  <div class="min-h-screen bg-base-200 flex">

    <nuxtLink to="/login" class="btn btn-primary mx-2 mt-2 absolute top-0 left-0">
      <i class="bi bi-box-arrow-left"></i> Regresar al inicio de sesion
    </nuxtLink>

    <div class="container mx-auto mt-20">
      <div class="card max-w-3xl lg:card-side mx-auto bg-base-100 shadow-xl">

        <ul :class="`steps lg:steps-vertical p-3`">
          <li :class="stepClasses('step_email')">Ingrese correo</li>
          <li :class="stepClasses('step_code')">Ingrese el pin</li>
          <li :class="stepClasses('step_password')">Cambio Contraseña</li>
          <li :class="stepClasses('step_final')">Finalizar</li>
        </ul>

        <!-- {{code}} -->
        <div class="card-body">
          <FormularioEmailRecuperacionPassword @nextstep="function () { steps.step_code = true }"
            v-if="!steps.step_code" />

          <CardCodigoVerificacion v-if="steps.step_code && !steps.step_password"
            @confirmar="function () { steps.step_password = true }" />

          <CardRecuperacionPassword v-if="steps.step_password && !steps.step_final"
            @confirmar="function () { steps.step_final = true }"></CardRecuperacionPassword>

          <div v-if="steps.step_final" class="text-center">
            <h2 class="card-title">Finalización</h2>
            <p class="mt-2 text-sm mt-10">Lograste cambiar tu contraseña con exito</p>
            <p class="mt-2 text-sm ">Ahora puedes loguearte correctamente</p>
            <div class="card-actions justify-end mt-20">
              <NuxtLink to="/login" class="btn btn-success">Aceptar</NuxtLink>
            </div>
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

interface RecoverySteps {
  step_email: boolean,
  step_code: boolean,
  step_password: boolean,
  step_final: boolean,
  [key: string]: boolean
}

const steps: Ref<RecoverySteps> = ref({
  step_email: true,
  step_code: false,
  step_password: false,
  step_final: false,
})





function stepClasses(step: string) {
  return {
    'step': true,
    'step-primary': steps.value[step]
  };
}


</script>