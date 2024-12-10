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
          <NuxtLink :to="INDEX_PAGE_TERCERO_JURIDICO">Juridicos</NuxtLink>
        </li>
        <li>
          <a>Registrar</a>
        </li>
      </ul>
    </div>
    <div class="bg-base-100 p-4">
      <FormularioPersonaJuridica @callback="createPersonaJuridica" @cancel="pushBack"></FormularioPersonaJuridica>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { personaJuridicaService } from '~/Domain/Client/Services/Terceros/PersonaJuridica/juridica.service';
import type { PersonaJuridicaCreateDTO } from '~/Domain/DTOs/Terceros/PersonaJuridica/PersonaJuridicaCreateDTO';
import { INDEX_PAGE_TERCERO, INDEX_PAGE_TERCERO_JURIDICO } from '~/Infrastructure/Paths/Paths';
const { $swal } = useNuxtApp()
const spinnerStore = SpinnerStore();
const router = useRouter();

function pushBack() {
  router.push(INDEX_PAGE_TERCERO_JURIDICO)
}



async function createPersonaJuridica(personaJuridicaCreateDTO: PersonaJuridicaCreateDTO) {
  spinnerStore.activeOrInactiveSpinner(true);
  try {
    const response = await personaJuridicaService.create(personaJuridicaCreateDTO);
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
    console.log(error);
  }
}
</script>

<style>

</style>