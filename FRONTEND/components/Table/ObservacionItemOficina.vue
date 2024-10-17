

<style>
@import 'datatables.net-dt';
</style>
<template>
  <!-- <div> -->
  <div class="flex justify-end">
    <NuxtLink to="crear" class="btn btn-success me-1"><i class="bi bi-plus-circle"></i> Agregar
    </NuxtLink>
    <button class="btn btn-neutral">
      <i class="bi bi-arrow-clockwise"></i>Recargar Tabla
    </button>
  </div>
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
import { GET_OBSERVACIONES_EQUIPO_BY_ITEM_ID, GET_OBSERVACIONES_OFICINA_BY_ITEM_ID } from '~/Infrastructure/Connections/endpoints.connection';


const emit = defineEmits(["inactivar", 'role'])
const { $swal } = useNuxtApp();
const isModalOpen = ref(false);

DataTable.use(DataTablesCore);


const settingRequest: any = {
  url: buildURLWithId(GET_OBSERVACIONES_OFICINA_BY_ITEM_ID, route.params.id),
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
    width: '5%', // Ancho fijo para el índice
  },
  { 
    data: 'fecha', 
    title: 'Fecha', 
    width: '10%', // Ancho adecuado para la fecha 
  },
  { 
    data: 'descripcion', 
    title: 'Descripción', 
    width: '80%', // Ancho más amplio para la descripción
  },
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
