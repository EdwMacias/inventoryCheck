<template>
  <VeeForm :validationSchema="formularioSchema" class="mt-5" @submit="onSubmit" v-slot="{ meta, errors }">
    <h2 class="text-center font-semibold text-xl  mb-2">Información Personal</h2>
    <p class="text-center text-sm  mb-4">Utiliza una dirección permanente donde puedas recibir correo.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
      <div>
        <label class="label">
          <span class='block text-sm font-medium leading-6 '>Nombre</span>
        </label>
        <VeeField name="name" type="text" placeholder="Carlos Mariano" v-model="formulario.name"
          :class="`input w-full mt-1 ${errors.name ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="name" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
      </div>
      <div>
        <label class="label">
          <span class='block text-sm font-medium leading-6 '>Apellido</span>
        </label>
        <VeeField name="last_name" type="text" placeholder="Rodríguez" v-model="formulario.last_name"
          :class="`input w-full mt-1 ${errors.last_name ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="last_name" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-5">
      <div class="md:col-span-1 lg:col-span-1">
        <label class="label">
          <span class='block text-sm font-medium leading-6 '>Tipo Documento</span>
        </label>
        <!-- <label for="tipo_documento" class="block text-sm font-medium leading-6 ">Tipo de Documento</label> -->
        <VeeField name="document_type_id" v-model="formulario.document_type_id"
          :class="`select  w-full mt-1 ${errors.document_type_id ? 'select-error' : 'select-bordered'}`" as="select">
          <option value="0">Seleccione</option>
          <option :value="1">Cédula de Ciudadania</option>
          <option :value="2">Tarjeta de Indentidad</option>
        </VeeField>
        <VeeErrorMessage name="document_type_id" class="text-error animate__animated  animate__fadeIn">
        </VeeErrorMessage>

      </div>

      <div class="md:col-span-1 lg:col-span-1">
        <label class="label">
          <span class='block text-sm font-medium leading-6 '>Número de Documento</span>
        </label>

        <VeeField name="number_document" type="text" placeholder="1093########" v-model="formulario.number_document"
          :class="`input w-full mt-1 ${errors.number_document ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="number_document" class="text-error animate__animated  animate__fadeIn">
        </VeeErrorMessage>

      </div>

      <div class="md:col-span-2 lg:col-span-1">
        <label class="label">
          <span class='block text-sm font-medium leading-6 '>Dirección</span>
        </label>
        <VeeField name="address" placeholder="Av 3ll #4mm" v-model="formulario.address"
          :class="`input w-full mt-1 ${errors.address ? 'input-error' : 'input-bordered'}`">
        </VeeField>
        <VeeErrorMessage name="address" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>

      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-5">
      <div class="md:col-span-1 lg:col-span-1">
        <label class="label">
          <span class='block text-sm font-medium leading-6 '>Género</span>
        </label>
        <VeeField name="gender_id"
          :class="`select  w-full mt-1 ${errors.gender_id ? 'select-error' : 'select-bordered'}`"
          v-model="formulario.gender_id" as="select">
          <option value="0">Seleccione</option>
          <option value="1">Masculino</option>
          <option value="2">Femenino</option>
          <option value="3">Helicóptero Apache</option>
        </VeeField>
        <VeeErrorMessage name="gender_id" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>

      </div>

      <div class="md:col-span-1 lg:col-span-1">
        <label class="label">
          <span class='block text-sm font-medium leading-6 '>Número de Celular</span>
        </label>
        <VeeField type="text" placeholder="" v-model="formulario.number_telephone"
          :class="`input w-full mt-1 ${errors.number_telephone ? 'input-error' : 'input-bordered'}`"
          name="number_telephone">
        </VeeField>
        <VeeErrorMessage name="number_telephone" class="text-error animate__animated  animate__fadeIn">
        </VeeErrorMessage>

      </div>

      <div class="md:col-span-2 lg:col-span-1">
        <label class="label">
          <span class='block text-sm font-medium leading-6 '>Correo Electrónico</span>
        </label>

        <VeeField name="email" type="email" placeholder="example@gmail.com" v-model="formulario.email"
          :class="`input w-full mt-1 ${errors.email ? 'input-error' : 'input-bordered'}`" />
        <VeeErrorMessage name="email" class="text-error animate__animated  animate__fadeIn"></VeeErrorMessage>

      </div>
    </div>

    <div class="mt-24 flex items-center justify-end gap-x-6">
      <NuxtLink to="/usuarios" class="btn btn-neutral">Cancelar</NuxtLink>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
  </VeeForm>
</template>

<script lang="ts" setup>
import { UsuarioServices } from '~/Domain/Client/Services/usuario.service';
import type { UsuarioEntity } from '~/Domain/Models/Entities/usuario';
import { UsuarioRepository } from '~/Infrastructure/Repositories/Usuario/usuario.repository';
const { $swal }: any = useNuxtApp()

const route = useRoute();

yup.setLocale({

  number: {
    moreThan: "Elija un opción valida"
  },
  mixed: {
    notType: 'Digito datos no validos por favor compruebe la información registrada'
  }

})


const formularioSchema = yup.object({
  name: yup.string().required(),
  last_name: yup.string().required(),
  address: yup.string().required(),
  number_telephone: yup.number().required(),
  number_document: yup.number().required(),
  gender_id: yup.number().required().moreThan(0),
  email: yup.string().required().email(),
  document_type_id: yup.number().required().moreThan(0),
})

const formulario: Ref<UsuarioEntity> = ref({
  gender_id: 0,
  document_type_id: 0
});

const onSubmit = async (values: UsuarioEntity, { resetForm }: any) => {
  const spinnerStore = SpinnerStore();
  const alertaStore = AlertaStore();
  spinnerStore.activeOrInactiveSpinner(true);
  let mensaje = '';
  try {
    const param = route.params.id;
    if (typeof param == 'string') {
      switch (param) {
        case 'crear':
          await UsuarioServices.createUser(values)
          mensaje = 'Usuario Creado';
          break;
        case 'editar':
          const { user_id } = formulario.value;
          if (user_id) {
            await UsuarioServices.updateUser(user_id, values);
          }
          mensaje = 'Usuario Actualizado';
          break;
      }
    }
  } catch (error) {
    console.error(error)
    return;
  }
  alertaStore.emitNotificacion({ cabecera: 'Notificación', mensaje: mensaje, tipo: 'success' });
  spinnerStore.activeOrInactiveSpinner(false);
  navigateTo('/usuarios')
}

onMounted(async () => {
  const spinnerStore = SpinnerStore();
  if (typeof route.query.id == 'string') {
    spinnerStore.activeOrInactiveSpinner(true);
    const email: string = route.query.id;
    const response = await UsuarioRepository.getUsuarioByEmail(email);
    formulario.value = response;
    spinnerStore.activeOrInactiveSpinner(false);
  }
})


</script>

<style></style>