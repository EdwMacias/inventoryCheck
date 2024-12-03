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
        Editar
      </li>
    </ul>
  </div>
  <div class="bg-base-100 rounded-md p-5  text-lg">
    <FormularioRegistro :user-to-edit="usuario" @update="editarUser"></FormularioRegistro>
  </div>
</template>

<script lang="ts" setup>
import { UsuarioServices } from '~/Domain/Client/Services/usuario.service';
import { UsuarioCreateDTO } from '~/Domain/DTOs/UsuarioCreateDTO';
import { UsuarioRepository } from '~/Infrastructure/Repositories/Usuario/usuario.repository';
const { $swal } = useNuxtApp()
const router = useRouter();
const route = useRoute();

const usuario = ref();

if (!route.query.id) router.push('/usuarios');

const response = await UsuarioRepository.getUsuarioByEmail(route.query.id as string);
const identificador = response.user_id;

usuario.value = new UsuarioCreateDTO(response);

const editarUser = async (usuarioCreateDTO: UsuarioCreateDTO) => {
  const spinnerStore = SpinnerStore();
  spinnerStore.activeOrInactiveSpinner(true);

  try {
    await UsuarioServices.updateUser(identificador as number, usuarioCreateDTO)
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