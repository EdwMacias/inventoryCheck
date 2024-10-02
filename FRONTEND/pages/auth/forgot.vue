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
          <FormularioEmailRecuperacionPassword @nextstep="function () { steps.step_code = true }"
            v-if="!steps.step_code" />

          <CardCodigoVerificacion v-if="steps.step_code && !steps.step_password"
            @confirmar="function () { steps.step_password = true }" />

          <CardRecuperacionPassword v-if="steps.step_password && !steps.step_final"></CardRecuperacionPassword>
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


</script>