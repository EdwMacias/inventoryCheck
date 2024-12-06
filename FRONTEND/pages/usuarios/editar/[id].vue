<template>
  <div class="breadcrumbs text-lg">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink :to="INDEX_USUARIOS">Usuarios</NuxtLink>
      </li>
      <li>
        Editar
      </li>
    </ul>
  </div>
  <div class="bg-base-100 rounded-md p-5 text-lg">
    <FormularioRegistro :user-to-edit="usuario" @update="editarUser"></FormularioRegistro>
  </div>
</template>

<script lang="ts" setup>
import { UsuarioServices } from '~/Domain/Client/Services/usuario.service';
import { UsuarioCreateDTO } from '~/Domain/DTOs/UsuarioCreateDTO';
import { INDEX_USUARIOS } from '~/Infrastructure/Paths/Paths';
import { UsuarioRepository } from '~/Infrastructure/Repositories/Usuario/usuario.repository';
const { $swal } = useNuxtApp()
const router = useRouter();
const route = useRoute();
const usuario = ref();
const identificador = ref();

if (!route.params.id) router.push(INDEX_USUARIOS);

try {
  const response = await UsuarioRepository.getUsuarioByEmail(route.params.id as string);
  usuario.value = new UsuarioCreateDTO(response);
  identificador.value = response.user_id;
} catch (error) {
  router.push(INDEX_USUARIOS);
}


const editarUser = async (usuarioCreateDTO: UsuarioCreateDTO) => {
  const spinnerStore = SpinnerStore();
  spinnerStore.activeOrInactiveSpinner(true);

  try {
    await UsuarioServices.updateUser(identificador.value as number, usuarioCreateDTO)
    spinnerStore.activeOrInactiveSpinner(false);

    await $swal.fire({
      title: 'Usuario Registrado',
      text: 'El usuario a sido creado con exito',
      icon: 'success'
    })

    return router.push(INDEX_USUARIOS)

  } catch (error) {
    console.error(error)
    spinnerStore.activeOrInactiveSpinner(false);
    return;
  }
}

</script>

<style></style>