<style>
@import 'datatables.net-dt';
</style>

<template>

  <div class="flex justify-end mb-2">
    <NuxtLink class="btn btn-success me-2 text-white" to="crear"><i class="bi bi-plus-circle text-white"></i> Agregar</NuxtLink>
  </div>

  <DataTable ref="table" class="table table-zebra rounded" :columns="columns" :options="options"
    :ajax="settingRequest">
    <template #action="props">
      <button class="btn btn-primary me-1 btn-sm " :text="`Col 1: ${props.cellData}`"
        @click="editClick(props.rowData)"><i class="bi bi-pen-fill"></i>Editar</button>
      <button class="btn btn-error btn-sm " :text="`Col 1: ${props.cellData}`"
        @click="console.log(props.rowData)"><i class="bi bi-slash-circle"></i> Eliminar</button>
    </template>
  </DataTable>
  <!-- </div> -->
</template>

<script lang="ts" setup>

let dt;

import DataTable from 'datatables.net-vue3';
import DataTablesCore, { type Config, type ConfigColumns } from 'datatables.net-dt';
import 'datatables.net-select';
import 'datatables.net-responsive';
import language from '@/lang/datatable.language.spanish.json';
import { UsuarioRepository } from '~/infrastructure/Repositories/Usuario/usuario.repository';

const props = defineProps({
  url: String
});

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

DataTable.use(DataTablesCore);

const settingRequest: any = {
  url: props.url,
  method: 'GET',
  headers: {
    Authorization: 'Bearer ' + UsuarioRepository.getToken(),
  },
};

const options: Config = {
  columnDefs: [
    {
      targets: -1,
      className: 'dt-body-center dt-head-center text-base sm:text-sm md:text-base lg:text-base xl:text-base'
    },
    {
      targets: '_all',
      className: 'dt-head-center dt-body-center text-base sm:text-sm md:text-base lg:text-base xl:text-base'
    },
  ],
  responsive: true,
  select: true,
  serverSide: true,
  processing: true,
  language: language,
};

const table = ref(); // This variable is used in the `ref` attribute for the component

const editClick = (id: any) => {
  return navigateTo("editar?id=" + id.email)
}

onMounted(function () {
  dt = table.value.dt;

  const selectTable = document.querySelector('.dt-length select');
  selectTable?.classList.remove('dt-input');
  selectTable?.classList.add('select', 'select-bordered')

  const inputTable = document.querySelector('.dt-search input[type="search"]');
  inputTable?.classList.remove('dt-input');
  inputTable?.classList.add('input', 'input-bordered', 'rounded');
  inputTable?.setAttribute('placeholder', 'Buscar....');

  dt.ajax = settingRequest;
});
</script>
