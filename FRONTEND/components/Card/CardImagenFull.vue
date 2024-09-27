<template>
  <input type="checkbox" :checked="modalOpen" :id="idModal" class="modal-toggle" />
  <div class="modal bg-base-200 " :id="identificador" v-if="modalOpen">
    <div class="modal-box w-11/12 max-w-7xl bg-base-200 " role="dialog">

      <label :for="idModal" class="btn btn-neutral btn-circle absolute right-0 top-0 mx-5 mt-5"
        @click="closeModalBackdrop" style="z-index: 200;">✕</label>
      <div class="card ">
        <div class="card-title">{{ title ?? 'Imagen' }}</div>
        <div class="card-body">
          <figure>
            <NuxtImg :src="imagen" class="rounded-lg" alt="Imagen del artículo" />
          </figure>
        </div>
      </div>
    </div>
    <label class="modal-backdrop cursor-pointer" :for="idModal" @click="closeModalBackdrop">Cerrar</label>
  </div>

</template>

<script setup lang="ts">

import { v4 as uuid } from 'uuid';
const identificador: Ref<string> = ref(uuid());
const emit = defineEmits(["close"]);

const props = defineProps<{
  isModalOpen: boolean
  idModal: string
  imagen: string | undefined
  title?: string
}>();

const modalOpen = ref(false);

watch(async () => props.isModalOpen, async (newValue) => {
  modalOpen.value = await newValue;
  await nextTick();
});

// function toggleModal() {
//   modalOpen.value = !modalOpen.value;
// }

function closeModalBackdrop() {
  return emit('close', false)
}

function handleEscape(event: KeyboardEvent) {
  if (event.key === "Escape") {
    closeModalBackdrop();
  }
}

onMounted(() => {
  window.addEventListener("keydown", handleEscape);
});

onBeforeUnmount(() => {
  window.removeEventListener("keydown", handleEscape);
});

</script>

<style scoped></style>
