<style>
@import 'datatables.net-dt';
</style>

<template>
  <DataTable ref="table" class="table table-zebra display" :columns="columns" :options="options">
    <template #user-action="props">
      <div class="dropdown dropdown-left">
        <div tabindex="0" role="button" class="btn m-1">Acciones</div>
        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
          <li><a @click="clickInDetails(props.rowData.personaNaturalId)">Detalles</a></li>
        </ul>
      </div>
    </template>
  </DataTable>
</template>

<script lang="ts" setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore, { type Config, type ConfigColumns } from 'datatables.net-dt';
import 'datatables.net-select';
import 'datatables.net-responsive';
import language from '@/lang/datatable.language.spanish.json';
import { UsuarioRepository } from '@/Infrastructure/Repositories/Usuario/usuario.repository';
import { GET_TABLE_TERCERO_NATURAL } from '~/Infrastructure/Connections/endpoints.connection';
DataTable.use(DataTablesCore);
const emits = defineEmits<{
  (event: 'detalles', payload: number): void
}>()

const columns: ConfigColumns[] = [
  {
    data: null,
    title: '#',
    render: (data, type, row, meta) => {
      return meta.row + 1;
    },
    searchable: true, // Deshabilitar la búsqueda en esta columna si es necesario
    orderable: false, // Deshabilitar el ordenamiento en esta columna si es necesario
  },
  {
    data: 'nombre', title: 'Nombre Completo', searchable: true,
    orderable: false
  },
  {
    data: 'identificacion', title: 'identificacion', searchable: true,
    orderable: false
  },
  {
    data: 'numeroIdentificacion', title: '# Identificación', searchable: true,
    orderable: false
  },
  {
    data: 'dv', title: 'dv', searchable: true,
    orderable: false
  },
  {
    data: 'telefono', title: 'telefono', searchable: true,
    orderable: false
  },
  {
    data: 'correo', title: 'correo', searchable: true,
    orderable: false
  },
  {
    data: null,
    render: '#user-action',
    title: 'Acciones',
    responsivePriority: 1,
    searchable: false,
    orderable: false
  }
];


const settingRequest: any = {
  url: GET_TABLE_TERCERO_NATURAL,
  method: 'GET',
  headers: {
    Authorization: 'Bearer ' + UsuarioRepository.getToken(),
  },
};

const options: Config = {
  columnDefs: [
    {
      targets: -1,
      // className: 'dt-body-center dt-head-center text-base sm:text-sm md:text-base lg:text-base xl:text-base'
    },
    {
      targets: '_all',
      // className: 'dt-head-center dt-body-center text-base sm:text-sm md:text-base lg:text-base xl:text-base'
    },
  ],
  responsive: true,
  serverSide: true,
  select: false,
  processing: true,
  language: language,
  ajax: settingRequest
};

const table = ref(); // This variable is used in the `ref` attribute for the component

function clickInDetails(email: number) {
  return emits('detalles', email);
}



</script>
