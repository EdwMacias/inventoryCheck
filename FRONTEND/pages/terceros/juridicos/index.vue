<template>
  <div>
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
          <p>Juridicos</p>
        </li>
      </ul>
    </div>
    <div class="bg-base-100 p-4">
      <div class="card-actions justify-end">
        <NuxtLink class="btn btn-success me-2" :to="INDEX_PAGE_REGISTRAR_TERCERO_JURIDICO"><i
            class="bi bi-plus-circle "></i> Registrar
        </NuxtLink>
      </div>
      <ClientOnly>
        <TableTerceroJuridica @detalles="clickInDetail"></TableTerceroJuridica>
      </ClientOnly>
    </div>

  </div>
  </div>
</template>

<script lang="ts" setup>
import { INDEX_PAGE_DETALLES_TERCERO_JURIDICO, INDEX_PAGE_REGISTRAR_TERCERO_JURIDICO, INDEX_PAGE_TERCERO } from '~/Infrastructure/Paths/Paths';


function clickInDetail(email: string) {
  const router = useRouter();
  router.push(INDEX_PAGE_DETALLES_TERCERO_JURIDICO + email);
}
</script>

<style>

</style>