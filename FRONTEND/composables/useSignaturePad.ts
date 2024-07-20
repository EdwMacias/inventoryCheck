// composables/useSignaturePad.ts
import { ref, onMounted, onBeforeUnmount } from 'vue';
import SignaturePad from 'signature_pad';

export function useSignaturePad() {
  const signaturePad = ref<SignaturePad | null>(null);
  const canvasRef = ref<HTMLCanvasElement | null>(null);

  const initSignaturePad = () => {
    if (canvasRef.value) {
      signaturePad.value = new SignaturePad(canvasRef.value, {
        penColor: 'rgb(0, 0, 0)',
      });
    }
  };

  const clearSignature = () => {
    signaturePad.value?.clear();
  };

  const getSignatureDataURL = (): string | null => {
    if (signaturePad.value && !signaturePad.value.isEmpty()) {
      return signaturePad.value.toDataURL('image/png');
    }
    return null;
  };

  onMounted(() => {
    initSignaturePad();
  });

  onBeforeUnmount(() => {
    signaturePad.value?.off();
  });

  return {
    canvasRef,
    clearSignature,
    getSignatureDataURL,
  };
}