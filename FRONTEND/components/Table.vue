<style>
@import 'datatables.net-dt';
</style>

<template>

  <div class="">
    <div class="flex justify-end mb-2">
      <NuxtLink class="btn btn-success me-2 text-white" to="crear"><i class="bi bi-plus-circle text-white"></i> Agregar
      </NuxtLink>
      <button class="btn btn-primary" @click="reloadTable">
        <i class="bi bi-arrow-clockwise"></i>Recargar Tabla
      </button>
    </div>

    <DataTable ref="table" class="table table-zebra" :columns="columns" :options="options">
      <template #user-action="props">
        <button class="btn btn-primary me-1 btn-sm " :text="`Col 1: ${props.cellData}`"
          @click="editClick(props.rowData)"><i class="bi bi-pen-fill"></i>Editar</button>
        <button :class="`btn  me-1 ${props.rowData.statu_id == 1 ? 'btn-neutral ' : 'btn-accent '} btn-sm`"
          :text="`Col 1: ${props.cellData}`" @click="inactive(props.rowData)"><i
            :class="`${props.rowData.statu_id != 1 ? 'bi bi-check2-circle' : 'bi bi-x-circle'}`"></i>{{
              props.rowData.statu_id != 1 ?
                'Activar' : 'Inactivar' }}</button>
      </template>

      <template #roles-action="props">
        <button class="btn btn-primary me-1 btn-sm " :text="`Col 1: ${props.cellData}`"
          @click="editClick(props.rowData)"><i class="bi bi-pen-fill"></i>Editar</button>
        <button :class="`btn  me-1 ${props.rowData.statu_id == 1 ? 'btn-neutral ' : 'btn-accent '} btn-sm`"
          :text="`Col 1: ${props.cellData}`" @click="inactive(props.rowData)"><i
            :class="`${props.rowData.statu_id != 1 ? 'bi bi-check2-circle' : 'bi bi-x-circle'}`"></i>{{
              props.rowData.statu_id != 1 ?
                'Activar' : 'Inactivar' }}</button>
      </template>

    </DataTable>
  </div>
</template>

<script lang="ts" setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore, { type Config, type ConfigColumns } from 'datatables.net-dt';
import 'datatables.net-select';
import 'datatables.net-responsive';
import language from '@/lang/datatable.language.spanish.json';
import { UsuarioRepository } from '@/Infrastructure/Repositories/Usuario/usuario.repository';
import { UserDTO } from '~/Domain/DTOs/UsuarioDTO';

const emit = defineEmits(["inactivar"])
const { $swal } = useNuxtApp();

const props = defineProps<{
  url: string,
  columns: ConfigColumns[],
}>()

DataTable.use(DataTablesCore);

const settingRequest: any = {
  url: props.url,
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
  processing: false,
  language: language,
  ajax: settingRequest
};

const table = ref(); // This variable is used in the `ref` attribute for the component

const editClick = (id: any) => {
  return navigateTo("editar?id=" + id.email)
}

function inactive(id: any) {
  let title = id.statu_id == 1 ? 'Inactivacion de Usuario' : 'Activación de Usuario';
  const userDTO = new UserDTO(id);
  $swal.fire({
    icon: 'warning',
    title: title,
    text: 'Seguro que quiere inactivar el usuario?',
    showCancelButton: true,
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    reverseButtons: true
  }).then(button => {
    if (button.isConfirmed) {
      emit("inactivar", userDTO, table)
    }
  })
}

const reloadTable = () => {
  console.log("ejecutando reload");

  if (table.value && table.value.dt) {
    table.value.dt.draw();
  }
}
DatatableStore().reload = reloadTable;


onMounted(function () {

  const spinner = SpinnerStore();
  const selectTable = document.querySelector('.dt-length select');
  selectTable?.classList.remove('dt-input');
  selectTable?.classList.add('select', 'select-bordered')

  const inputTable = document.querySelector('.dt-search input[type="search"]');
  inputTable?.classList.remove('dt-input');
  inputTable?.classList.add('input', 'input-bordered', 'rounded');
  inputTable?.setAttribute('placeholder', 'Buscar....');

  table.value.dt.on('preDraw', function () {
    spinner.activeOrInactiveSpinner(true);
  });

  table.value.dt.on('draw', function () {
    spinner.activeOrInactiveSpinner(false);
  });
});
</script>
