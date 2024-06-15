<template>
  <div class="min-h-screen bg-base-200 flex items-center">
    <div class="card mx-auto w-full max-w-5xl  shadow-xl">
      <div class="grid md:grid-cols-2 grid-cols-1 bg-base-100 rounded-xl">
        <div class="">
          <div class="hero min-h-full rounded-l-xl bg-base-200">
            <div class="hero-content py-12">
              <div class="max-w-md">
                <div class="text-center">
                  <img src="/images/LogoEmpresa.png" alt="Dashwind Admin Template" class="w-100 inline-block"></img>
                </div>
              </div>
            </div>
          </div>
        </div>
        <FormularioLogin />
      </div>
      <Tema></Tema>
    </div>
  </div>
</template>

<script setup lang="ts">
definePageMeta({
  path: '/login',
})


</script>