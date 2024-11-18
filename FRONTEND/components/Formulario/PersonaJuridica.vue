<template>
  <div>
    
  </div>
  <ButtonOptions @cancel="handleCancel">Registrar</ButtonOptions>

</template>

<script lang="ts" setup>
const emits = defineEmits<{
  (event: 'cancel', payload: boolean): void;
}>();

const handleCancel = () => {
  return emits('cancel', true);
};
</script>

<style>

</style>