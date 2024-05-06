<template>
  <div class="min-h-screen bg-base-200 flex">
    <div class="container mx-auto mt-20">
      <div class="card max-w-3xl lg:card-side mx-auto bg-base-100 shadow-xl">

        <ul :class="`steps lg:steps-vertical p-3`">
          <li :class="stepClasses('step_email')">Ingrese correo</li>
          <li :class="stepClasses('step_code')">Ingrese el pin</li>
          <li :class="stepClasses('step_password')">Cambio Contraseña</li>
          <li :class="stepClasses('step_final')">Finalizar</li>
        </ul>

        <div class="card-body">
          <FormularioRecuperacionPassword @nextstep="function () { steps.step_code = true }" v-if="!steps.step_code">
          </FormularioRecuperacionPassword>

          <FormularioOtpRecuperacionPassword v-if="steps.step_code && !steps.step_password">
          </FormularioOtpRecuperacionPassword>
        </div>
      </div>

    </div>
  </div>

</template>

<script lang="ts" setup>


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

// const code = ref();

definePageMeta({
  path: '/forgot-password',
  // middleware: []
})
const vertical: Ref<boolean> = ref(false);

// function activeVertical() {
//   vertical.value = checkWindowSize(1020)
//   console.log(checkWindowSize(1020));
// }

function stepClasses(step: string) {
  return {
    'step': true,
    'step-primary': steps.value[step]
  };
}

onMounted(() => {
  // window.addEventListener('resize', activeVertical);
  // activeVertical();
})


</script>