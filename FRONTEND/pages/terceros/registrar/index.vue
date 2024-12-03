<template>

  <div class="breadcrumbs text-lg">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink :to="INDEX_PAGE_TERCERO">Terceros</NuxtLink>
      </li>
      <li>
        <a>Registrar</a>
      </li>
    </ul>
  </div>

  <div class="bg-base-100 rounded-md p-5 mb-5">
    <div class="flex flex-col items-center gap-4 h-aut p-5">
      <!-- Encabezado principal -->
      <h1 class="text-xl font-semibold text-gray-700">Seleccione *</h1>

      <!-- Opciones de selección -->
      <div class="flex gap-10 justify-center items-center">
        <!-- Persona Natural -->
        <div class="form-control">
          <label class="label cursor-pointer">
            <input type="radio" name="tipoPersona"
              class="radio peer appearance-none rounded-full border border-gray-300 checked:border-blue-500 focus:outline-none transition"
              v-model="selection" value="1" />
            <span class="label-text mx-2 text-gray-600 peer-checked:font-medium">Persona Natural</span>
          </label>
        </div>

        <!-- Persona Jurídica -->
        <div class="form-control">
          <label class="label cursor-pointer">
            <VeeField type="radio" name="tipoPersona"
              class="radio peer appearance-none rounded-full border border-gray-300 checked:border-blue-500 focus:outline-none transition"
              v-model="selection" value="2" />
            <span class="label-text mx-2 text-gray-600 peer-checked:font-medium">Persona Jurídica</span>
          </label>
        </div>
      </div>
    </div>

    <div v-show="selection == 1">
      <FormularioPersonaNatural @callback="createPersonaNatural" @cancel="pushBack"></FormularioPersonaNatural>
    </div>

    <div v-show="selection == 2">
      <FormularioPersonaJuridica @callback="createPersonaJuridica" @cancel="pushBack"></FormularioPersonaJuridica>
    </div>

  </div>

</template>

<script lang="ts" setup>

import { personaJuridicaService } from '~/Domain/Client/Services/Terceros/PersonaJuridica/juridica.service';
import { personaNaturalService } from '~/Domain/Client/Services/Terceros/PersonaNatural/natural.service';
import type { PersonaJuridicaCreateDTO } from '~/Domain/DTOs/Terceros/PersonaJuridica/PersonaJuridicaCreateDTO';
import type { PersonaNaturalCreateDTO } from '~/Domain/DTOs/Terceros/PersonaNatural/PersonaNaturalCreateDTO';
import { INDEX_PAGE_TERCERO } from '~/Infrastructure/Paths/Paths';

const { $swal } = useNuxtApp()
const spinnerStore = SpinnerStore();
const router = useRouter();
const selection = ref(0);

function pushBack() {
  router.push(INDEX_PAGE_TERCERO)
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

<style></style>