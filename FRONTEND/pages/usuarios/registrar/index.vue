<template>
  <div class="breadcrumbs text-lg">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/usuarios">Usuarios</NuxtLink>
      </li>
      <li>
        Registrar
      </li>
    </ul>
  </div>
  <div class="bg-base-100 rounded-md  p-5 text-lg">
    <FormularioRegistro @create="createUser"></FormularioRegistro>
  </div>
</template>

<script lang="ts" setup>
import { UsuarioServices } from '~/Domain/Client/Services/usuario.service';
import type { UsuarioCreateDTO } from '~/Domain/DTOs/UsuarioCreateDTO';
const { $swal } = useNuxtApp()

const router = useRouter();


const createUser = async (usuarioCreateDTO: UsuarioCreateDTO) => {
  const spinnerStore = SpinnerStore();
  spinnerStore.activeOrInactiveSpinner(true);

  try {
    await UsuarioServices.createUser(usuarioCreateDTO)
    spinnerStore.activeOrInactiveSpinner(false);

    await $swal.fire({
      title: 'Usuario Registrado',
      text: 'El usuario a sido creado con exito',
      icon: 'success'
    })

    return router.push('/usuarios')

  } catch (error) {
    console.error(error)
    spinnerStore.activeOrInactiveSpinner(false);
    return;
  }
}


</script>

<style></style>