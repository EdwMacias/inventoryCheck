<template>
    <div class="min-h-screen bg-base-200 flex items-center">
        <div class="card mx-auto w-full max-w-5xl  shadow-xl">
            <div class="grid  md:grid-cols-2 grid-cols-1  bg-base-100 rounded-xl">
                <div class="">
                    <div class="hero min-h-full rounded-l-xl bg-base-200">
                        <div class="hero-content py-12">
                            <div class="max-w-md">
                                <h1 class="text-3xl text-center font-bold ">
                                    <!-- <img src="/public/LogoMain.png" -->
                                        <!-- class="w-12 inline-block mr-2 mask mask-circle" alt="dashwind-logo" /> -->
                                    CEDAC
                                </h1>
                                <div class="text-center mt-12">
                                    <img src="/public/LogoMain.png"
                                        alt="Dashwind Admin Template" class="w-48 inline-block"></img>
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
</script>