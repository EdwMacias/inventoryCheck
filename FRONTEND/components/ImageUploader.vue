<template>
  <div>
    <input class="file-input file-input-sm file-input-bordered" type="file" multiple @change="handleFileChange" />
    <div v-if="previewImages.length" class="grid grid-cols-2 gap-4 mt-4">
      <div v-for="(image, index) in previewImages" :key="index" class="card card-compact w-52 bg-base-100 shadow-xl">
        <figure>
          <img @click="openModal(image)" :src="image" alt="Preview Image" class="object-cover w-full h-32 cursor-pointer" />
        </figure>
        <div class="card-body">
          <button @click="removeImage(index)" class="btn btn-outline btn-error">Eliminar</button>
        </div>
      </div>
    </div>
    <div class="swap swap-flip mt-4" :class="{ 'swap-active': selectedFiles.length > 0 }">
      <button v-if="selectedFiles.length > 0" @click="emitFiles" class="btn btn-sm btn-outline btn-success swap-on">Subir
      </button>
      <div class="swap-off"></div>
    </div>
    <input type="checkbox" id="image-modal" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle">
      <div class="modal-box relative max-w-screen-lg max-h-screen">
        <label for="image-modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
        <img :src="currentImage" alt="Image Preview" class="w-full h-full object-contain" />
      </div>
      <label for="image-modal" class="modal-backdrop"></label>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue';

const emit = defineEmits(['files-selected']);
const selectedFiles = ref<File[]>([]);
const previewImages = ref<string[]>([]);
const currentImage = ref<string | null>(null);
const handleFileChange = (event: Event) =>  {
  const target = event.target as HTMLInputElement;
  const files = target.files as FileList;
  Array.from(files).forEach(file => {
    selectedFiles.value.push(file);
    const reader = new FileReader();
    reader.onload = (e) => {
      previewImages.value.push(e.target?.result as string);
    };
    reader.readAsDataURL(file);
  });
}
const removeImage = (index: number) => {
  selectedFiles.value.splice(index, 1);
  previewImages.value.splice(index, 1);
}
const emitFiles = () =>{
  emit('files-selected', selectedFiles.value);
}
const openModal = (image: string) => {
  currentImage.value = image;
  (document.getElementById('image-modal') as HTMLInputElement).checked = true;
}
const closeModal = () => {
  (document.getElementById('image-modal') as HTMLInputElement).checked = false;
}
const handleEscapeKey = (event: KeyboardEvent) => {
  if (event.key === 'Escape') {
    closeModal();
  }
}
onMounted(() => {
  document.addEventListener('keydown', handleEscapeKey);
});
onBeforeUnmount(() => {
  document.removeEventListener('keydown', handleEscapeKey);
});
</script>
