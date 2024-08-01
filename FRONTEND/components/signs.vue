<template>
  <VueSignaturePad height="100px" ref="signaturePad" class="border border-gray-300 rounded-lg" />
  <div>
    <button @click="undo" class="underline">Deshacer</button>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { VueSignaturePad } from 'vue-signature-pad';

const signaturePad = ref(null);

const undo = () => {
  signaturePad.value.undoSignature();
};

</script>
