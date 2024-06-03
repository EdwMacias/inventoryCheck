<template>
    <div>
        <FormularioItems @enviar="create" />
    </div>
</template>

<script setup lang="ts">
import type { ItemEntity } from '~/Domain/Models/Entities/item';

definePageMeta({
    middleware: ['actions-middleware']
})

function create(itemEntity : ItemEntity){
    try {
        
    } catch (error) {
        
    }
    // const formData = new FormData();

  // formData.set('name', itemEntity.name);
  // formData.set('description', itemEntity.description);
  // formData.set('serial_number', itemEntity.serial_number);
  // formData.set('resource', itemEntity.resource);
}


</script>

<style scoped></style>