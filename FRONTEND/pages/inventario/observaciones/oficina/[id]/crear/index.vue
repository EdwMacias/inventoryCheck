<template>
  <div class="breadcrumbs text-lg">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/inventario/">Inventario</NuxtLink>
      </li>
      <li>
        <NuxtLink :to="`/inventario/observaciones/oficina/${route.params.id}`"> Observación Item Oficina
        </NuxtLink>
      </li>
      <li>
        Crear
      </li>
    </ul>
  </div>
  <p class="font-semibold text-lg">Formulario Observación Item Oficina</p>
  <div class="bg-base-100 p-5 rounded-md">
    <FormularioFormObservacionItemBasico @callback="crearObservacion" @button-cancel="navigate">
    </FormularioFormObservacionItemBasico>
  </div>
</template>

<script lang="ts" setup>
import type { ItemOficinaObservacionDTO } from '~/Domain/DTOs/Observaciones/Oficina/ItemOficinaObservacionDTO';
import { OficinaObservacionRepository } from '~/Infrastructure/Repositories/Observation/Oficina/OficinaObservacion.repository';

const route = useRoute();
const router = useRouter(); 
const { $swal } = useNuxtApp()
const spinnerStore = SpinnerStore();

const navigate = () => {
  router.push(`/inventario/observaciones/oficina/${route.params.id}`);
}

const crearObservacion = async (itemOficinaObservacionDTO: ItemOficinaObservacionDTO) => {
  // Obtenemos el item seleccionado desde localStorage
  const selectItem = localStorage.getItem('item-select');

  if (!selectItem) return; // Salimos si no hay item en localStorage

  // Parseamos el item seleccionado
  const item: { itemId: string, identificador: number } = JSON.parse(selectItem);

  // Verificamos si el itemId en la ruta coincide con el del localStorage
  if (route.params.id !== item.itemId) {
    await $swal.fire({
      title: "Error de información",
      text: "Ha ocurrido un error inesperado. Por favor vuelva a intentarlo. Lamentamos el inconveniente.",
      showCancelButton: false,
    });
    return router.push('/inventario/');
  }

  // Asignamos el itemId al DTO
  itemOficinaObservacionDTO.itemId = item.itemId;

  spinnerStore.status = true;

  try {
    // Enviamos la solicitud de creación de observación
    await OficinaObservacionRepository.create(itemOficinaObservacionDTO.toFormData());
    spinnerStore.status = false;

    // Mostramos mensaje de éxito
    await $swal.fire({
      icon: 'success',
      title: "Observación Creada",
      text: "Se ha registrado tu observación con éxito",
      showCancelButton: false,
    });

    // Redireccionamos al usuario a la página de observaciones
    router.push(`/inventario/observaciones/oficina/${route.params.id}`);

  } catch (error) {
    console.error('Error al crear observación:', error);
    spinnerStore.status = false;
  }
};


</script>

<style></style>