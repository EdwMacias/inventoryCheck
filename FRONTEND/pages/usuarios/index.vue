<template>
  <div>
    <div class="mt-20 container mx-auto bg-white rounded p-2 shadow" style="z-index: 0;">
      <ClientOnly>
        <Table :url="GET_USUARIOS_ALL" :columns="columns"></Table>
      </ClientOnly>
    </div>
  </div>
</template>

<script lang="ts" setup>
import type { ConfigColumns } from 'datatables.net-dt';
import { GET_USUARIOS_ALL } from '~/Infrastructure/Connections/endpoints.connection';

const columns: ConfigColumns[] = [
  { data: 'name', title: 'Nombre' },
  { data: 'last_name', title: 'Apellido' },
  { data: 'email', title: 'Correo Electronico' },
  { data: 'number_document', title: 'Número Documento' },
  { data: 'number_telephone', title: 'Célular' },
  {
    data: null,
    render: '#action',
    title: 'Acciones',
    responsivePriority: 1,
    searchable: false,
    orderable: false
  }
];


</script>

<style></style>