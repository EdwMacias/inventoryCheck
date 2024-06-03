<template>
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
        // console.log(response);
        spinnerStore.activeOrInactiveSpinner(false);
        return navigateTo('/inventario/items');
    } catch (error) {
        console.log(error);
    }
    spinnerStore.activeOrInactiveSpinner(false);
    // const formData = new FormData();

    // formData.set('name', itemEntity.name);
    // formData.set('description', itemEntity.description);
    // formData.set('serial_number', itemEntity.serial_number);
    // formData.set('resource', itemEntity.resource);
}


</script>

<style scoped></style>