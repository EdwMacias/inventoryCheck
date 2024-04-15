<style>
@import 'datatables.net-dt';

.dt-paging.paging_full_numbers button {
  /* Agrega las clases de DaisyUI para los botones de paginación */
  padding: 0.5rem 1rem !important;
  border-radius: 0.375rem !important;
  background-color: #d6e1fa !important;
  color: #fff !important;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
}

button.dt-paging-button.current {
  border-radius: 0.375rem !important;
  padding: 0.5rem 1rem !important;
  /* box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important; */
  background-color: #3B82F6 !important;
}
</style>
<template>
  <DataTable ref="table" class="table table-zebra rounded " :columns="columns" :options="options"
    :ajax="settingRequest">
    <template #action="props">
      <button class="btn btn-primary  me-1 btn-sm " :text="`Col 1: ${props.cellData}`"
        @click="console.log(props.rowData)">Editar</button>
      <button class="btn btn-error btn-sm " :text="`Col 1: ${props.cellData}`"
        @click="console.log(props.rowData)">Eliminar</button>
    </template>
  </DataTable>
</template>

<script lang="ts" setup>

let dt;

import DataTable from 'datatables.net-vue3';
import DataTablesCore, { type Config, type ConfigColumns } from 'datatables.net-dt';
import 'datatables.net-select';
import 'datatables.net-responsive';
import language from '@/lang/datatable.language.spanish.json';
// import language from 'datatables.net-plugins/i18n/es-ES.mjs';

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
    Authorization: 'Bearer ' + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3MTMyMTc2ODcsImV4cCI6MTcxMzIyMTI4NywibmJmIjoxNzEzMjE3Njg3LCJqdGkiOiJXTXVod0F1ZDN3elk1dUlSIiwic3ViIjoiNyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjciLCJuYW1lIjoidXN1YXJpbyBwcnVlYmEiLCJsYXN0X25hbWUiOiJjZWRhYyIsImVtYWlsIjoiY2VkYWN0ZXN0QGdtYWlsLmNvbSJ9.uhie8UM9y-Dtrrl2-kwiEGQhKictsLUO95IqW2YhYQc',
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
