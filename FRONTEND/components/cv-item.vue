<template>
<dialog id="my_modal_2" class="modal">
  <div class="modal-box">
    <label>
      <ul>
        <li>1</li>
        <li>2</li>
        <li>3</li>
      </ul>
    </label>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>
</template>

<script lang="ts" setup>
const emit = defineEmits(['close']);
const props = defineProps<{
  isCvOpen: boolean;
  idCv: string;
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