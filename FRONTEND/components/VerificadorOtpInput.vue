<script lang="ts" setup>
import { ref, watch } from 'vue';
const props = defineProps<{
  fields: number;
}>();

const data: any = ref([]);
const firstInputEl: any = ref(null);
const emit = defineEmits(['update:modelValue']);

watch(
  () => data,
  (newVal: any) => {
    if (
      newVal.value != '' &&
      newVal.value.length === props.fields &&
      !newVal.value.includes('')
    ) {
      emit('update:modelValue', Number(newVal.value.join('')));
    } else {
      emit('update:modelValue', null);
    }
  },
  { deep: true }
);

const handleOtpInput = (e : any) => {
  if (e.data && e.target.nextElementSibling) {
    e.target.nextElementSibling.focus();
  } else if (e.data == null && e.target.previousElementSibling) {
    e.target.previousElementSibling.focus();
  }
};

const handlePaste = (e: any) => {
  const pasteData = e.clipboardData.getData('text');
  let nextEl = firstInputEl.value[0].nextElementSibling;
  for (let i = 1; i < pasteData.length; i++) {
    if (nextEl) {
      data.value[i] = pasteData[i];
      nextEl = nextEl.nextElementSibling;
    }
  }
};

// 123456
</script>

<template>
  <div class="otp flex justify-around" @input="handleOtpInput">
    <template v-for="field in fields" :key="field">
      <input v-model="data[field - 1]" ref="firstInputEl" placeholder="-" type="text" maxlength="1"
        class="border rounded w-10 h-10 text-center" @paste="field === 1 && handlePaste($event)" />
    </template>
  </div>
</template>
