<template>
<dialog :open="isCvOpen" id="my_modal_2" class="modal">
  <div class="modal-box w-11/12 max-w-5xl">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"  @click="closeCv">✕</button>
      <h3 class="font-bold text-lg">Hoja de vida</h3>
      <p>{{ props }}</p>
      <div class="grid grid-rows-2">
        <div class="">
          <img :src="props.image" alt="Imagen del item" class="w-1/2 h-1/2 object-contain" />
        </div>
        <div class="">
          <p>{{ props.itemName }}</p>
          <p>{{ props.quantity }} {{ props.unit }}</p>
          <p>{{ props.serial }}</p>
          <p>{{ props.identifier }}</p>
          <p>{{ props.category == '1' ? 'Equipo' : 'Oficina' }}</p>
        </div>
      </div>

  </div>
  <form method="dialog" class="modal-backdrop">
    <button @click="closeCv">Cerrar</button>
  </form>
</dialog>
</template>

<script lang="ts" setup>
const emit = defineEmits(['close']);
const props = defineProps<{
  isCvOpen: boolean;
  idCv: string;
  itemName: string;
  image: string;
  category: string;
  identifier: number;
  serial: string;
  quantity: number;
  unit: string;
}>();


function closeCv() {
  emit('close', false);
}

function handleEscape(event: KeyboardEvent) {
  if (event.key === 'Escape') {
    closeCv();
  }
}
onMounted(() => {
  window.addEventListener('keydown', handleEscape);
});

onBeforeUnmount(() => {
  window.removeEventListener('keydown', handleEscape);
});
</script>

<style>

</style>