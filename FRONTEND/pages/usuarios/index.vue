<template>
  <div class="breadcrumbs text-lg">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink to="">Usuarios</NuxtLink>
      </li>
    </ul>
  </div>
  <div class="bg-base-100 p-2 rounded-md">
    <ClientOnly>
      <TableUsuario @inactivar="statuUsuario" @role="getDatosRoleUser"></TableUsuario>
    </ClientOnly>
  </div>

  <input type="checkbox" id="modalFormularioRole" ref="modalRole" class="modal-toggle" />
  <div class="modal" role="dialog">
    <div class="modal-box">
      <h2 class="text-2xl font-semibold mb-2 ">Asignación de Rol</h2>
      <FormularioAsignacionRol :email="emailUserSeleccionado" :role="roleUsuarioSeleccionado" @create="asignarRole" />
    </div>
    <label class="modal-backdrop" for="modalFormularioRole"></label>
  </div>

</template>

<script lang="ts" setup>

definePageMeta({
  middleware: ['redirect-trailing-slash']
})
const emailUserSeleccionado = ref('');
const roleUsuarioSeleccionado = ref();
const modalRole = ref();
const { $swal } = useNuxtApp();


const getDatosRoleUser = (userDTO: UserDTO) => {
  emailUserSeleccionado.value = userDTO.email;
  roleUsuarioSeleccionado.value = userDTO.role;
}

import { RoleService } from '~/Domain/Client/Services/Roles/role.service';
import { UsuarioServices } from '~/Domain/Client/Services/usuario.service';
import { RoleRequestAssingRoleDTO } from '~/Domain/DTOs/Request/Roles/RoleRequestAssingRoleDTO';
import type { UserDTO } from '~/Domain/DTOs/UsuarioDTO';
import { DatatableStore } from '~/stores/DatatableStore';

async function statuUsuario(userDTO: UserDTO, table: any) {
  const nombreUsuario = userDTO.name + " " + userDTO.last_name;
  const userName = capitalizeFirstLetter(nombreUsuario);
  let message = userDTO.statu_id == 1 ? {
    title: 'Inactivación de Usuario',
    text: 'Se inactivará el usuario: ' + userName
  } : {
    title: 'Activación de Usuario',
    text: 'Se activará el usuario: ' + userName
  }

  const response = await $swal.fire({
    icon: 'warning',
    title: message.title,
    text: message.text,
    showCancelButton: true,
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    reverseButtons: true
  }).then(button => {
    if (button.isConfirmed) {
      return true;
    }
  })

  if (response) {
    const spinnerStore = SpinnerStore();
    spinnerStore.activeOrInactiveSpinner(true);
    await UsuarioServices.statuUsuario(userDTO)
    await DatatableStore().reload();
    await $swal.fire({
      icon: 'info',
      title: 'Proceso Realizado Con Exito',
      text: message.title + 'exitosa.',
      showCancelButton: false,
      confirmButtonText: 'Confirmar',
    })
  }

}

async function asignarRole(user: UserDTO) {
  const spinnerStore = SpinnerStore();
  const roleRequestDTO = new RoleRequestAssingRoleDTO(user);

  try {
    spinnerStore.activeOrInactiveSpinner(true);
    const response = await RoleService.assignar(roleRequestDTO)
    await DatatableStore().reload();

    spinnerStore.activeOrInactiveSpinner(false);
    await $swal.fire({
      icon: 'success',
      text: response.messages[0],
    });

    modalRole.value.checked = false;

  } catch (error: unknown) {
    spinnerStore.activeOrInactiveSpinner(false);
    await $swal.fire({
      icon: 'info',
      text: error as string,
    });
  }
}

const capitalizeFirstLetter = (text: string) => {
  return text
    .split(' ') // Divide el texto en palabras
    .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()) // Capitaliza la primera letra de cada palabra
    .join(' '); // Une las palabras de nuevo en una cadena
}

</script>

<style></style>