<template>

  <div class="breadcrumbs text-lg mx-5">
    <ul>
      <li>
        <NuxtLink to="/">Inicio</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/terceros/">Terceros</NuxtLink>
      </li>
      <li>
        <a>Registrar</a>
      </li>
    </ul>
  </div>

  <div class="bg-base-100 container mx-auto rounded-lg p-3">
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
      <FormularioPersonaNatural @cancel="pushBack"></FormularioPersonaNatural>
    </div>

    <div v-show="selection == 2">
      <FormularioPersonaJuridica @cancel="pushBack"></FormularioPersonaJuridica>
    </div>

  </div>

</template>

<script lang="ts" setup>
const router = useRouter();
const selection = ref(0);

function pushBack() {
  router.push('/terceros/')
}

</script>

<style></style>