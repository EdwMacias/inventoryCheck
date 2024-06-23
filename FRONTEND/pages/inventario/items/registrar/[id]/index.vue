<template>
    <div class="breadcrumbs text-lg mx-5">
        <ul>
            <li><NuxtLink to="/">Inicio</NuxtLink></li>
            <li><NuxtLink to="/inventario/items/">Inventario</NuxtLink></li>
            <li>Crear Item</li>
        </ul>
    </div>
    <div>
        <FormularioItems @enviar="create" />
    </div>
</template>

<script setup lang="ts">
import { itemService } from '~/Domain/Client/Services/Items/item.service';
import type { ItemEntity } from '~/Domain/Models/Entities/item';

definePageMeta({
    middleware: ['actions-middleware']
})

async function create(itemEntity: ItemEntity) {
    const spinnerStore = SpinnerStore();
    spinnerStore.activeOrInactiveSpinner(true);
    try {
        const response = await itemService.create(itemEntity);
        spinnerStore.activeOrInactiveSpinner(false);
        return navigateTo('/inventario/items');
    } catch (error) {
        console.log(error);
    }
    spinnerStore.activeOrInactiveSpinner(false);
}


</script>

<style scoped></style>