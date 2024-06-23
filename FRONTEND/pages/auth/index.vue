<template>
    <div class="card mx-auto w-full max-w-5xl  shadow-xl md:mt-12">
      <div class="grid md:grid-cols-2 grid-cols-1 bg-base-100 rounded-xl">
          <div class="hero min-h-full rounded-l-xl bg-base-200">
            <div class="hero-content py-12">
              <div class="max-w-md">
                <div class="text-center">
                  <img src="/images/LogoEmpresa.webp" alt="Dashwind Admin Template" class="w-100 inline-block"></img>
                </div>
              </div>
            </div>
          </div>
        <FormularioLogin />
      </div>
    </div>
    <p class="text-sm font-bold flex justify-center mt-2 ">InventoryCheck v. 1.0.1 </p>
</template>

<script setup lang="ts">
definePageMeta({
  path: '/login',
})


</script>