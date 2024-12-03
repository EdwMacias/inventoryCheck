<template>
  <div class="breadcrumbs text-lg">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/inventario/items/">Inventario</NuxtLink>
      </li>
      <li>
        <NuxtLink :to="`/inventario/items/observaciones/equipo/${route.params.id}`"> Observación Equipo
        </NuxtLink>
      </li>
      <li>
        Crear
      </li>
    </ul>
  </div>
  <div class="mt-2">
    <div class="container mx-auto bg-base-100 p-5 rounded-lg">
      <FormularioFormObservacionEquipo @callback="crearObservacion"></FormularioFormObservacionEquipo>
    </div>
  </div>
</template>

<script lang="ts" setup>
import type { EquipoObservacionCreateDTO } from '~/Domain/DTOs/Observaciones/Equipos/EquipoObservacionCreateDTO';
import { EquipoObservacionRepository } from '~/Infrastructure/Repositories/Observation/Equipo/EquipoObservacion.repository';

const route = useRoute();
const router = useRouter();
const { $swal } = useNuxtApp()


const crearObservacion = async (equipoObservacionCreateDTO: EquipoObservacionCreateDTO) => {
  const spinnerStore = SpinnerStore();
  spinnerStore.status = true;
  let selectItem = localStorage.getItem('item-select');

  if (selectItem) {

    const item: { itemId: string, identificador: number } = JSON.parse(selectItem);
    if (route.params.id !== item.itemId) {
      spinnerStore.status = false;

      await $swal.fire({
        icon: 'error',
        title: "Error Inesperado",
        text: "Ha ocurrido un error inesperado. Por favor vuelva a intentarlo, lamentamos el inconveniente.",
        showCancelButton: false,
      })

      return router.push('/inventario/items');

    }

    equipoObservacionCreateDTO.equipoId = item.identificador;
    try {
      const response = await EquipoObservacionRepository.create(equipoObservacionCreateDTO.toFormData());
      spinnerStore.status = false;

      await $swal.fire({
        icon: 'success',
        title: "Observación Creada Correctamente",
        text: "La observación ha sido guardada exitosamente.",
        showCancelButton: false,
      });

      return router.push(`/inventario/items/observaciones/equipo/${route.params.id}`);



    } catch (error) {

    }

  }

}

</script>

<style></style>