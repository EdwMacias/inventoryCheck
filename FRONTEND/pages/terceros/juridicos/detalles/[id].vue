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
          <p>Detalles</p>
        </li>
      </ul>
    </div>

    <div class="bg-base-100 p-4 select-none">
      <div class="flex w-full flex-col">
        <div class="divider divider-center select-none">Datos de Identificación</div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Razon Social
            <p class="grow h-6 skeleton rounded" v-if="!data?.razonSocial"></p>
            <p class="grow select-text " v-else>{{ data?.razonSocial }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            NIT
            <p class="grow h-6 skeleton rounded" v-if="!data?.nit"></p>
            <p class="grow select-text " v-else>{{ data?.nit }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Tipo de Entidad
            <p class="grow h-6 skeleton rounded" v-if="!data"></p>
            <p class="grow select-text " v-else>{{ data.nit }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Fecha Registro Camara de Comercio
            <p class="grow h-6 skeleton rounded" v-if="!data"></p>
            <p class="grow select-text " v-else>{{ data?.fechaRegistroCamara ?? 'N/A' }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Número Camara Comercio
            <p class="grow h-6 skeleton rounded" v-if="!data"></p>
            <p class="grow select-text " v-else>{{ data?.numeroRegistro ?? 'N/A' }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Pais de origen
            <p class="grow h-6 skeleton rounded" v-if="!data"></p>
            <p class="grow select-text " v-else>{{ data.pais ?? 'N/A' }}</p>
          </label>
        </div>

      </div>
      <div class="flex w-full flex-col">
        <div class="divider divider-center select-none">Datos de Contacto</div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Representate Legal
            <p class="grow h-6 skeleton rounded" v-if="!data"></p>
            <p class="grow select-text " v-else>{{ data?.representanteLegal ?? 'N/A' }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Telefono
            <p class="grow h-6 skeleton rounded" v-if="!data"></p>
            <p class="grow select-text " v-else>{{ data?.telefono ?? 'N/A' }}</p>
          </label>
        </div>

        <div>
          <label class="input input-bordered flex items-center gap-2">
            Correo
            <p class="grow h-6 skeleton rounded" v-if="!data"></p>
            <p class="grow select-text " v-else>{{ data?.correo ?? 'N/A' }}</p>
          </label>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { personaJuridicaService } from '~/Domain/Client/Services/Terceros/PersonaJuridica/juridica.service';
import type { PersonaJuridicaDTO } from '~/Domain/DTOs/Terceros/PersonaJuridica/PersonaJuridicaDTO';
import { INDEX_PAGE_TERCERO, INDEX_PAGE_TERCERO_JURIDICO } from '~/Infrastructure/Paths/Paths';
const route = useRoute();
const router = useRouter();
const { $swal } = useNuxtApp()
const data: Ref<PersonaJuridicaDTO | undefined> = ref();

onMounted(async () => {
  try {
    const result = await personaJuridicaService.details(route.params.id as string);

    if (!result) {
      throw new Error("Datos no disponibles");
    }

    data.value = result;

  } catch (error) {
    $swal.fire({
      icon: 'warning',
      title: 'Error inesperado',
      text: 'Ha ocurrido un error inesperado. Por favor, inténtelo de nuevo más tarde.',
      confirmButtonText: 'Entendido'
    });
    router.push(INDEX_PAGE_TERCERO_JURIDICO); // Redirigir en caso de error
  }
});


</script>

<style></style>