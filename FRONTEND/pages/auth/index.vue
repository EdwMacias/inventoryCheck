<template>
  <div class="min-h-screen bg-base-200 flex items-center">
    <div class="card mx-auto w-full max-w-5xl  shadow-xl">
      <div class="grid  md:grid-cols-2 grid-cols-1  bg-base-100 rounded-xl">
        <div class="">
          <div class="hero min-h-full rounded-l-xl bg-base-200">
            <div class="hero-content py-12">
              <div class="max-w-md ">
                <div class="text-center">
                  <img src="/public/LogoMain.png" alt="Dashwind Admin Template" class="w-48 inline-block"></img>
                </div>
              </div>
            </div>
          </div>
        </div>
        <FormularioLogin />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">

definePageMeta({
  path: '/login'
})

// const responsive: Ref<boolean> = ref(true);

// const checkWindowSize = async () => {
//   responsive.value = !(window.innerWidth <= 767)
// }

onMounted(async () => {
  // await checkWindowSize();
  // window.addEventListener('resize', checkWindowSize);

})



</script>