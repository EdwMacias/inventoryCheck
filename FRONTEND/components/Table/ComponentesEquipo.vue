<style>
@import 'datatables.net-dt';
</style>

<template>
  <DataTable ref="table" class="table table-zebra display" :columns="columns" :options="options">
  </DataTable>
</template>

<script lang="ts" setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore, { type Config, type ConfigColumns } from 'datatables.net-dt';
import 'datatables.net-select';
import 'datatables.net-responsive';
import language from '@/lang/datatable.language.spanish.json';
import { UsuarioRepository } from '@/Infrastructure/Repositories/Usuario/usuario.repository';
import { GET_TABLE_COMPONENTE_EQUIPO_BY_ITEM_ID } from '~/Infrastructure/Connections/endpoints.connection';
DataTable.use(DataTablesCore);
const emits = defineEmits<{
  (event: 'detalles', payload: string): void
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
    data: 'nombre', title: 'Nombre', searchable: true,
    orderable: false
  },
  {
    data: 'cantidad', title: 'Cantidad', searchable: true,
    orderable: false
  },
  {
    data: 'serial', title: 'Serial', searchable: true,
    orderable: false
  }, {
    data: 'cuidados', title: 'Cuidados', searchable: true,
    orderable: false
  }, {
    data: 'modelo', title: 'Modelo', searchable: true,
    orderable: false
  }, {
    data: 'marca', title: 'Marca', searchable: true,
    orderable: false
  }, {
    data: 'unidad', title: 'Unidad', searchable: true,
    orderable: false
  }, {
    data: 'type', title: 'Tipo', searchable: true,
    orderable: false
  },

];

const route = useRoute();
const settingRequest: any = {
  url: GET_TABLE_COMPONENTE_EQUIPO_BY_ITEM_ID + route.params.id,
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

function clickInDetails(email: string) {
  return emits('detalles', email);
}



</script>
