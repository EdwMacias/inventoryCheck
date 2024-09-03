<template>
  <div class="breadcrumbs text-sm mx-2">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink to="">Usuarios</NuxtLink>
      </li>
      <li>
        <NuxtLink to="">Gestion Usuarios</NuxtLink>
      </li>
    </ul>
  </div>
  <div>
    <div class="mx-5 container mx-auto">
      <ClientOnly>
        <TableUsuario :url="GET_USUARIOS_ALL" :columns="columns" @inactivar="statuUsuario" @role="getDatosRoleUser"></TableUsuario>
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
  </div>
</template>

<script lang="ts" setup>
const emailUserSeleccionado = ref('');
const roleUsuarioSeleccionado = ref();
const modalRole = ref();
const { $swal } = useNuxtApp();


const getDatosRoleUser = (userDTO: UserDTO) => {
  emailUserSeleccionado.value = userDTO.email;
  roleUsuarioSeleccionado.value = userDTO.role;
}

import type { ConfigColumns } from 'datatables.net-dt';
import { RoleService } from '~/Domain/Client/Services/Roles/role.service';
import { UsuarioServices } from '~/Domain/Client/Services/usuario.service';
import { RoleRequestAssingRoleDTO } from '~/Domain/DTOs/Request/Roles/RoleRequestAssingRoleDTO';
import type { UserDTO } from '~/Domain/DTOs/UsuarioDTO';
import { GET_USUARIOS_ALL } from '~/Infrastructure/Connections/endpoints.connection';
import { DatatableStore } from '~/stores/DatatableStore';

const columns: ConfigColumns[] = [
  { data: 'name', title: 'Nombre' },
  { data: 'last_name', title: 'Apellido' },
  { data: 'email', title: 'Correo Electronico' },
  { data: 'number_document', title: 'Número Documento' },
  { data: 'number_telephone', title: 'Célular' },
  {
    data: null,
    render: '#user-action',
    title: 'Acciones',
    responsivePriority: 1,
    searchable: false,
    orderable: false
  }
];

async function statuUsuario(userDTO: UserDTO, table: any) {
  const spinnerStore = SpinnerStore();
  spinnerStore.activeOrInactiveSpinner(true);
  await UsuarioServices.statuUsuario(userDTO)
  DatatableStore().reload();
}

async function asignarRole(user: UserDTO) {
  const spinnerStore = SpinnerStore();
  const roleRequestDTO = new RoleRequestAssingRoleDTO(user);

  try {
    spinnerStore.activeOrInactiveSpinner(true);
    const response = await RoleService.assignar(roleRequestDTO)

    spinnerStore.activeOrInactiveSpinner(false);
    $swal.fire({
      icon: 'success',
      text: response.messages[0],
    }).then((action) => {
      if (action.dismiss) {
        modalRole.value.checked = false;
        DatatableStore().reload();
      }
      if (action.isConfirmed) {
        modalRole.value.checked = false;
        DatatableStore().reload();
      }
    });

  } catch (error: unknown) {
    spinnerStore.activeOrInactiveSpinner(false);
    $swal.fire({
      icon: 'info',
      text: error as string,
    });
  }
}

</script>

<style></style>