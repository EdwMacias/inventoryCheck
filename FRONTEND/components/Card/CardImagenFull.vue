<template>
  <!-- <div> -->
  <input type="checkbox" :checked="modalOpen" @click="toggleModal" :id="idModal" class="modal-toggle" />
  <div class="modal bg-base-200">
    <!-- <div class="moda "> -->
    <div class="modal-box w-11/12 max-w-7xl bg-base-200 ">

      <label :for="idModal" class="btn btn-neutral btn-circle absolute right-0 top-0 mx-5 mt-5"
        @click="closeModalBackdrop" style="z-index: 200;">✕</label>
      <div class="card ">
        <div class="card-body">
          <figure>
            <img :src="imagen" class="rounded-lg"alt="Imagen del artículo" />
          </figure>
        </div>
      </div>
    </div>
    <label class="modal-backdrop" :for="idModal" @click="closeModalBackdrop">Cerrar</label>
  </div>
</template>

<script setup lang="ts">


const emit = defineEmits(["close"]);

const props = defineProps<{
  isModalOpen: boolean
  idModal: string
  imagen: string | undefined
}>();

const modalOpen = ref(false);

watch(() => props.isModalOpen, (newValue) => {
  toggleModal();
});

function toggleModal() {
  modalOpen.value = !modalOpen.value;
}

function closeModalBackdrop() {
  modalOpen.value = false
  return emit("close", false)
}

function preventDoubleClick(event: MouseEvent) {
  if (event.detail > 1) {
    event.preventDefault();
  }
}
</script>

<style scoped></style>
