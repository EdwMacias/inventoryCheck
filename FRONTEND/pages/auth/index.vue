<template>
  <!-- <div class="card mx-auto w-full max-w-5xl  shadow-xl md:mt-12">
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
  </div> -->
  <!-- <p class="text-sm font-bold flex justify-center mt-2 ">InventoryCheck v. 1.0.1 </p> -->
  <div class="hero bg-base-200 min-h-screen">
    <div class="hero-content flex-col lg:flex-row-reverse">
      <div class="text-center lg:text-left">
        <!-- <h1 class="text-5xl font-bold">Login now!</h1> -->
        <p class="py-6">
          <img src="/images/LogoEmpresa.webp" alt="Dashwind Admin Template" class="w-100 inline-block"></img>

          <!-- Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem -->
          <!-- quasi. In deleniti eaque aut repudiandae et a id nisi. -->
        </p>
      </div>
      <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
        <!-- <form class="card-body"> -->
        <!-- <div class="form-control"> -->
        <FormularioLogin />

        <!-- <label class="label">
            <span class="label-text">Email</span>
          </label>
          <input type="email" placeholder="email" class="input input-bordered" required />
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Password</span>
          </label>
          <input type="password" placeholder="password" class="input input-bordered" required />
          <label class="label">
            <a href="#" class="label-text-alt link link-hover">Forgot password?</a>
          </label>
        </div>
        <div class="form-control mt-6">
          <button class="btn btn-primary">Login</button>
        </div>
      </form> -->
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
definePageMeta({
  path: '/login',
})


</script>