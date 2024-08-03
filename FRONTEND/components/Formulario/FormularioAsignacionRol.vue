<template>
  <!-- <div> -->
  <VeeForm :validationSchema="formularioSchema" @submit="create">

    <label class="input input-bordered flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
        <path
          d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
        <path
          d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
      </svg>
      <input type="text" class="grow" v-model="formulario.email" placeholder="Email" disabled />
    </label>

    <VeeField name="role" class="select select-bordered w-full mt-2" v-model="formulario.role" as="select">
      <option value="0">Selecione el rol</option>
      <option value="SUPERADMINISTRADOR">SUPERADMINISTRADOR</option>
      <option value="ADMINISTRADOR">ADMINISTRADOR</option>
      <option value="USUARIO">USUARIO</option>
    </VeeField>

    <div class="card-actions justify-end mt-5">
      <label for="modalFormularioRole" class="btn btn-neutral" >Cancelar</label>
      <button class='btn btn-primary mt'>Guardar</button>
    </div>
  </VeeForm>

  <!-- </div> -->
</template>

<script lang="ts" setup>
const { $swal } = useNuxtApp()


const props = defineProps(['email', 'role']);
const emit = defineEmits(['create'])

const formularioSchema = yup.object({
  role: yup.string().required()
})

const formulario = ref({
  email: '',
  role: ''
});

function create(values: any) {
  if (values.role == '' || values.role == '0' || values.role === 0) {
    $swal.fire({
      icon: 'warning',
      title: 'Seleccione un rol',
      confirmButtonText: 'Aceptar',
    })
    return;
  }
  return emit('create', formulario.value)
}

watch(
  () => props.email,
  (newEmail) => {
    formulario.value.email = newEmail;
    formulario.value.role = props.role;
  },
  { immediate: true } // Update immediately when the component is created
);


</script>

<style></style>