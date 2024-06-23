<template>
  <div class="breadcrumbs text-lg mx-5">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>Usuarios</li>
    </ul>
  </div>
  <div>
    <div class="mx-5" >
      <ClientOnly>
        <Table :url="GET_USUARIOS_ALL" :columns="columns" @inactivar="statuUsuario"></Table>
      </ClientOnly>
    </div>
  </div>
</template>

<script lang="ts" setup>

import type { ConfigColumns } from 'datatables.net-dt';
import { UsuarioServices } from '~/Domain/Client/Services/usuario.service';
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

</script>

<style></style>