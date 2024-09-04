<style>
@import 'datatables.net-dt';
</style>
<template>
  <div id="Pagina" class="mx-2">
    <h3 class="font-semibold text-xl">Historial de calibracion, Verificaciones y mantenimiento de equipos</h3>
  </div>
  <div class="flex justify-end mx-2">
    <button class="btn btn-success me-2 text-white" @click="isModalOpen = true"><i
        class="bi bi-plus-circle text-white"></i> Agregar
    </button>
    <button class="btn btn-primary" @click="reloadTable">
      <i class="bi bi-arrow-clockwise"></i>Recargar Tabla
    </button>
  </div>
  <div class="mx-2">
    <DataTable ref="table" class="table table-zebra" :columns="columns" :options="options">
    </DataTable>
  </div>
  <FormularioObservacion :is-open="isModalOpen" @close="isModalOpen = false" />
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
    // spinner.activeOrInactiveSpinner(true);
  },
  complete: function () {
    const spinner = SpinnerStore();
    // spinner.activeOrInactiveSpinner(false);
  }
};

const columns: ConfigColumns[] = [
  { data: 'fecha', title: 'Fecha' },
  { data: 'asunto', title: 'Asunto' },
  { data: 'actividad', title: 'Descripción' },
  { data: 'estado', title: 'Estado' },
  // { data: 'firma_responsable', title: 'Firmado' },
  { data: 'proxima_actividad', title: 'Proxima actividad' },
];

const options: Config = {
  responsive: true,
  serverSide: true,
  select: true,
  processing: true,
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
