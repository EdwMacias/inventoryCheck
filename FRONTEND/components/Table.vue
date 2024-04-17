<style>
@import 'datatables.net-dt';

.dt-paging.paging_full_numbers button {
  padding: 0.5rem 1rem !important;
  border-radius: 0.375rem !important;
  color: #fff !important;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
}
</style>

<template>
  <DataTable ref="table" class="table table-zebra rounded " :columns="columns" :options="options"
    :ajax="settingRequest">
    <template #action="props">
      <button class="btn btn-primary  me-1 btn-sm " :text="`Col 1: ${props.cellData}`" @click="editClick">Editar</button>
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
    Authorization: 'Bearer ' + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3MTMzNjQ3NjUsImV4cCI6MTcxMzM2ODM2NSwibmJmIjoxNzEzMzY0NzY1LCJqdGkiOiJsWTY1YjNPczJESUNxdXZ3Iiwic3ViIjoiNyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjciLCJuYW1lIjoidXN1YXJpbyBwcnVlYmEiLCJsYXN0X25hbWUiOiJjZWRhYyIsImVtYWlsIjoiY2VkYWN0ZXN0QGdtYWlsLmNvbSJ9.mefwXmxDM3WrxnEMcvb69PBX_rcq_N4QTjQxL5c15co',
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

const editClick = () => {
  return navigateTo("editar")
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
