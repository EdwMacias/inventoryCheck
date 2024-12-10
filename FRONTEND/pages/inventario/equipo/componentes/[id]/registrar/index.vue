<template>
  <div>
    <div class="breadcrumbs text-lg  ">
      <ul>
        <li>
          <NuxtLink to="/">Inicio</NuxtLink>
        </li>
        <li>
          <NuxtLink :to="INDEX_PAGE_INVENTARIO">Inventario</NuxtLink>
        </li>
        <li>
          <NuxtLink :to="`${INDEX_PAGE_COMPONENTES_EQUIPO}${route.params.id}`">Equipo</NuxtLink>
        </li>
        <li>
          <NuxtLink :to="`${INDEX_PAGE_COMPONENTES_EQUIPO}${route.params.id}`">Componentes</NuxtLink>
        </li>
        <li>Registrar</li>
      </ul>
    </div>

    <div class="bg-base-100 p-4">
      <FormularioComponentesEquipo @click-in-cancel="clickInCancel" @callback="createComponente">
      </FormularioComponentesEquipo>
    </div>


  </div>
</template>

<script lang="ts" setup>
import { EquipoService } from '~/Domain/Client/Services/Items/equipo.service';
import type { EquipoComponentesCreateDTO } from '~/Domain/DTOs/Items/Equipo/EquipoComponentesCreateDTO';
import { INDEX_PAGE_COMPONENTES_EQUIPO, INDEX_PAGE_INVENTARIO } from '~/Infrastructure/Paths/Paths';
const route = useRoute();
const router = useRouter();
const { $swal } = useNuxtApp()


async function createComponente(equipoComponenteCreateDTOs: EquipoComponentesCreateDTO[]) {
  const spinnerStore = SpinnerStore();
  spinnerStore.status = true;
  try {
    const response = await EquipoService.registrarComponentes(equipoComponenteCreateDTOs, route.params.id as string);
    spinnerStore.status = false;

    await $swal.fire({
      icon: 'success',
      title: "Componentes Registrados",
      text: "Los componentes se registraron exitosamente",
      showCancelButton: false,
    });

    router.push(`${INDEX_PAGE_COMPONENTES_EQUIPO}${route.params.id}`);

  } catch (error) {
    spinnerStore.status = false;
  }
}

function clickInCancel(click: boolean) {
  router.push(`${INDEX_PAGE_COMPONENTES_EQUIPO}${route.params.id}`);
}

</script>

<style></style>