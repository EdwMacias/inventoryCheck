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
        <button class="btn btn-info me-1 btn-sm" :text="`Col 1: ${props.cellData}`" @click="editClick(props.rowData)">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
            <path
              d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
            <path
              d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
          </svg>
          <p class="">Editar</p>
        </button>

        <button :class="`btn  me-1 ${props.rowData.statu_id == 1 ? 'btn-warning ' : 'btn-success'} btn-sm`"
          @click="inactive(props.rowData)">

          <svg v-if="props.rowData.statu_id != 1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>

          <svg v-if="props.rowData.statu_id == 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
            fill="currentColor" class="size-4">
            <path fill-rule="evenodd"
              d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
              clip-rule="evenodd" />
          </svg>

          <p>
            {{ props.rowData.statu_id != 1 ? 'Activar' : 'Inactivar' }}
          </p>

        </button>

        <label for="modalFormularioRole" class="btn btn-neutral btn-sm" @click="buttonRole(props.rowData)">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
            <path fill-rule="evenodd"
              d="M15.75 1.5a6.75 6.75 0 0 0-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 0 0-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 0 0 .75-.75v-1.5h1.5A.75.75 0 0 0 9 19.5V18h1.5a.75.75 0 0 0 .53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1 0 15.75 1.5Zm0 3a.75.75 0 0 0 0 1.5A2.25 2.25 0 0 1 18 8.25a.75.75 0 0 0 1.5 0 3.75 3.75 0 0 0-3.75-3.75Z"
              clip-rule="evenodd" />
          </svg>
          role
        </label>
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

const emit = defineEmits(["inactivar", 'role'])
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
      // className: 'dt-body-center dt-head-center text-base sm:text-sm md:text-base lg:text-base xl:text-base'
    },
    {
      targets: '_all',
      // className: 'dt-head-center dt-body-center text-base sm:text-sm md:text-base lg:text-base xl:text-base'
    },
  ],
  responsive: true,
  serverSide: true,
  select : true,
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
  if (table.value && table.value.dt) {
    table.value.dt.draw();
  }
}
const buttonRole = (data: any) => {
  const userDTO = new UserDTO(data);
  return emit('role', userDTO);
}

DatatableStore().reload = reloadTable;

</script>
