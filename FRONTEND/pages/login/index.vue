<template>
    <!-- <div>
        <NuxtLink href="/">Iniciar sesión</NuxtLink>
    </div> -->
    <form @submit.prevent="validarformulario">
        <input type="text"
            :class="v$.firstName.$error == true ? 'input input-bordered input-error w-full max-w-xs' : 'input input-bordered w-full max-w-xs'"
            placeholder="Correo Electronico" v-model="formulario.firstName">

        <div class="input-errors" v-for="error of v$.firstName.$errors" :key="error.$uid">
            <div class="error-msg">{{ error.$message }}</div>
        </div>

        <input type="text"
            :class="v$.lastName.$error == true ? 'input input-bordered input-error w-full max-w-xs' : 'input input-bordered w-full max-w-xs'"
            placeholder="Contraseña" v-model="formulario.lastName">
        <div class="input-errors" v-for="error of v$.lastName.$errors" :key="error.$uid">
            <div class="error-msg">{{ error.$message }}</div>
        </div>

        <button class="btn">button</button>
    </form>

</template>

<script setup lang="ts">

import { useVuelidate } from '@vuelidate/core'

definePageMeta({
    layout: 'login',
})

const formulario = ref({
    firstName: '',
    lastName: '',
})

const rules = {
    firstName: { required, email },
    lastName: { required }
}

const v$ = useVuelidate(rules, formulario)

const validarformulario = async () => {
    const result = await v$.value.$validate();

    if (result) {
        alert("datos correctos")
    }
}


</script>

<style scoped></style>
~/utils/transalateVueValidate