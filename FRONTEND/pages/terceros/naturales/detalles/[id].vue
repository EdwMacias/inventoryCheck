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
          <p>Detalles</p>
        </li>
      </ul>
    </div>
    <!-- {{ data }} -->
    <div class="bg-base-100 p-4 select-none">
      <div class="flex w-full flex-col">
        <div class="divider divider-center select-none">Nombre</div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Primer Nombre
            <p class="grow h-6 skeleton rounded" v-if="!data?.primerNombre"></p>
            <p class="grow select-text " v-else>{{ data?.primerNombre }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Segundo Nombre
            <p class="grow h-6 skeleton rounded" v-if="!data?.segundoNombre"></p>
            <p class="grow select-text" v-else>{{ data?.segundoNombre }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Primer Apellido
            <p class="grow h-6 skeleton rounded" v-if="!data?.primerApellido"></p>
            <p class="grow select-text" v-else>{{ data?.primerApellido }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Segundo Apellido
            <p class="grow h-6 skeleton rounded" v-if="!data?.segundoApellido"></p>
            <p class="grow select-text" v-else>{{ data?.segundoApellido }}</p>
          </label>
        </div>
      </div>
      <div class="flex w-full flex-col">
        <div class="divider divider-center select-none">Identificacion</div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Identificacion
            <p class="grow h-6 skeleton rounded" v-if="!data?.tipoIdentificacion"></p>
            <p class="grow select-text" v-else>{{ data?.documento.name }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Numero Identificacion
            <p class="grow h-6 skeleton rounded" v-if="!data?.numeroIdentificacion"></p>
            <p class="grow select-text" v-else>{{ data?.numeroIdentificacion }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            DV
            <p class="grow h-6 skeleton rounded" v-if="!data?.dv"></p>
            <p class="grow select-text" v-else>{{ data?.dv ?? 'N/A' }}</p>
          </label>
        </div>
      </div>
      <div class="flex w-full flex-col">
        <div class="divider divider-center select-none">Datos de Contacto</div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Correo
            <p class="grow h-6 skeleton rounded" v-if="!data?.correo"></p>
            <p class="grow select-text" v-else>{{ data?.correo ?? 'N/A' }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Telefono
            <p class="grow h-6 skeleton rounded" v-if="!data?.telefono"></p>
            <p class="grow select-text" v-else>{{ data?.telefono ?? 'N/A' }}</p>
          </label>
        </div>
      </div>
      <div class="flex w-full flex-col">
        <div class="divider divider-center select-none">Datos de Ubicación</div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Direccion
            <p class="grow h-6 skeleton rounded" v-if="!data?.direccion"></p>
            <p class="grow select-text" v-else>{{ data?.direccion ?? 'N/A' }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Departamento
            <p class="grow h-6 skeleton rounded" v-if="!data?.departamento"></p>
            <p class="grow select-text" v-else>{{ data?.departamento ?? 'N/A' }}</p>
          </label>
        </div>
        <div>
          <label class="input input-bordered flex items-center gap-2">
            Ciudad
            <p class="grow h-6 skeleton rounded" v-if="!data?.ciudad"></p>
            <p class="grow select-text" v-else>{{ data?.ciudad ?? 'N/A' }}</p>
          </label>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { personaNaturalService } from '~/Domain/Client/Services/Terceros/PersonaNatural/natural.service';
import type { PersonaNaturalDTO } from '~/Domain/DTOs/Terceros/PersonaNatural/PersonaNaturalDTO';
import { INDEX_PAGE_TERCERO, INDEX_PAGE_TERCERO_NATURAL } from '~/Infrastructure/Paths/Paths';

const route = useRoute();
const router = useRouter();
const { $swal } = useNuxtApp()
const data: Ref<PersonaNaturalDTO | undefined> = ref();

onMounted(async () => {
  try {
    const result = await personaNaturalService.details(
      cadenaANumero(route.params.id as string) as unknown as string
    );

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
    router.push(INDEX_PAGE_TERCERO_NATURAL); // Redirigir en caso de error
  }
});
</script>

<style></style>