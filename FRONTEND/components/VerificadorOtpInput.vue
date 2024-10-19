<script lang="ts" setup>

const props = defineProps<{
  fields: number;
}>();

const data: any = ref(Array(props.fields).fill('')); // Inicializa con un array vacío para cada campo
const firstInputEl: any = ref(null);
const emit = defineEmits(['update:modelValue']);

watch(
  () => data.value,
  (newVal: any) => {
    const joinedValue = newVal.join('');
    if (joinedValue.length === props.fields && !joinedValue.includes('')) {
      // Emitir el valor como una cadena para preservar los ceros iniciales
      console.log(joinedValue);
      
      emit('update:modelValue', joinedValue);
    } else {
      emit('update:modelValue', joinedValue);
    }
  },
  { deep: true }
);

const handleOtpInput = (e: any) => {
  if (e.data && e.target.nextElementSibling) {
    e.target.nextElementSibling.focus();
  } else if (!e.data && e.target.previousElementSibling) {
    e.target.previousElementSibling.focus();
  }
};

const handlePaste = (e: any) => {
  const pasteData = e.clipboardData.getData('text').slice(0, props.fields); // Limita el número de caracteres pegados
  const inputs = firstInputEl.value; // Acceder a todos los elementos de input
  for (let i = 0; i < pasteData.length; i++) {
    if (inputs[i]) {
      data.value[i] = pasteData[i];
    }
  }
};

</script>

<template>
  <div class="otp flex justify-around" @input="handleOtpInput">
    <template v-for="field in fields" :key="field">
      <input v-model="data[field - 1]" ref="firstInputEl" placeholder="-" type="text" maxlength="1"
        class="border rounded w-10 h-10 text-center" @paste="field === 1 && handlePaste($event)" />
    </template>
  </div>
</template>
