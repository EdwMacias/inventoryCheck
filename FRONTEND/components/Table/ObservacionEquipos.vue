<style lang="css">
@import 'datatables.net-dt';

</style>
<template>


  <DataTable ref="table" class="table table-zebra rounded" :columns="columns" :options="options">
  </DataTable>

  <!-- <FormularioObservacion :is-open="isModalOpen" @close="isModalOpen = false" /> -->

</template>

<script lang="ts" setup>
const route = useRoute();
import DataTable from 'datatables.net-vue3';
import DataTablesCore, { type Config, type ConfigColumns } from 'datatables.net-dt';
import 'datatables.net-select';
import 'datatables.net-responsive';
import language from '@/lang/datatable.language.spanish.json';
import { UsuarioRepository } from '@/Infrastructure/Repositories/Usuario/usuario.repository';
import { UserDTO } from '~/Domain/DTOs/UsuarioDTO';
import { GET_OBSERVACIONES_EQUIPO_BY_ITEM_ID } from '~/Infrastructure/Connections/endpoints.connection';


const emit = defineEmits(["inactivar", 'role'])
const { $swal } = useNuxtApp();
const isModalOpen = ref(false);

DataTable.use(DataTablesCore);


const settingRequest: any = {
  url: buildURLWithId(GET_OBSERVACIONES_EQUIPO_BY_ITEM_ID, route.params.id),
  method: 'GET',
  headers: {
    Authorization: 'Bearer ' + UsuarioRepository.getToken(),
  },

  error: async (err: any) => {
    console.log(err);
  },
  beforeSend: function () {
    const spinner = SpinnerStore();
    spinner.activeOrInactiveSpinner(true);
  },
  complete: function () {
    const spinner = SpinnerStore();
    spinner.activeOrInactiveSpinner(false);
  }
};

const columns: ConfigColumns[] = [
{
    data: null,
    title: '#',
    render: (data, type, row, meta) => meta.row + 1,
    searchable: false,
    orderable: false,
    width: '10px', // Controla el ancho de la columna
  },
  { data: 'fecha', title: 'Fecha', width: '200px' },
  { data: 'asunto', title: 'Asunto', width: '200px' },
  { data: 'actividad', title: 'Descripción', width: '400px' },
  { data: 'estado', title: 'Estado', width: '100px' },
  { data: 'proxima_actividad', title: 'Proxima actividad', width: '150px' },
];

const options: Config = {
  responsive: true,
  serverSide: true,
  select: false,
  processing: false,
  language: language,
  ajax: settingRequest
};

const table = ref(); // This variable is used in the `ref` attribute for the component



const reloadTable = () => {
  if (table.value && table.value.dt) {
    table.value.dt.draw();
  }
}

DatatableStore().reload = reloadTable;

</script>
