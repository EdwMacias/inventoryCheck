<template>
  <div>
    <div class="breadcrumbs text-lg">
      <ul>
        <li>
          <NuxtLink to="/">Inicio</NuxtLink>
        </li>
        <li>
          <NuxtLink :to="INDEX_PAGE_TERCERO">Terceros</NuxtLink>
        </li>
        <li>
          <NuxtLink :to="INDEX_PAGE_TERCERO_NATURAL">Naturales</NuxtLink>
        </li>
        <li>
          <a>Registrar</a>
        </li>
      </ul>
    </div>
    <div class="bg-base-100 p-4">
      <FormularioPersonaNatural @callback="createPersonaNatural" @cancel="pushBack"></FormularioPersonaNatural>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { personaNaturalService } from '~/Domain/Client/Services/Terceros/PersonaNatural/natural.service';
import type { PersonaNaturalCreateDTO } from '~/Domain/DTOs/Terceros/PersonaNatural/PersonaNaturalCreateDTO';
import { INDEX_PAGE_TERCERO, INDEX_PAGE_TERCERO_NATURAL } from '~/Infrastructure/Paths/Paths';
const spinnerStore = SpinnerStore();
const { $swal } = useNuxtApp()

function pushBack() {
  const router = useRouter();
  router.push(INDEX_PAGE_TERCERO_NATURAL)
}

async function createPersonaNatural(personaNaturalCreateDTO: PersonaNaturalCreateDTO) {
  // await personaNaturalRepository.create(personaNaturalCreateDTO.toArray());
  spinnerStore.activeOrInactiveSpinner(true);
  try {
    const response = await personaNaturalService.create(personaNaturalCreateDTO);
    spinnerStore.activeOrInactiveSpinner(false);

    if (!Array.isArray(response.messages)) {

      await $swal.fire({
        title: "Creacion Exitosa",
        text: response.messages,
        icon: "success"
      });

    } else {

      await $swal.fire({
        title: "Creacion Exitosa",
        text: "El tercero se ha creado con exito",
        icon: "success"
      });

    }

    return pushBack();

  } catch (error) {
    spinnerStore.activeOrInactiveSpinner(false);
    console.error(error);
  }

}
</script>

<style></style>