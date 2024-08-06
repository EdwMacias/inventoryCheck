 <template>
  <div id="app">
    <VueSignaturePad height="100px" ref="signaturePad" class="border rounded-xl" />
    <div>
      <label @click="save">Save</label>
      <label @click="undo">Undo</label>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { VueSignaturePad } from 'vue-signature-pad';
const emits = defineEmits(['saveSignature']);

const signaturePad = ref(null);

const undo = () => {
  signaturePad.value.undoSignature();
};

const save = () => {
  const { isEmpty, data } = signaturePad.value.saveSignature();
  if (!isEmpty) {
    const base64Data = data; // data is already in base64 format
    emits('saveSignature', base64Data);
  } else {
    emits('saveSignature', '');
  }
};
</script>

