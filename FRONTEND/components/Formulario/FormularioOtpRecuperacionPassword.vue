<template>
  <p class="text-sm text-center mb-3">Código de 6 dígitos</p>
  <div class="sm:w-[250px] lg:w-[300px] mx-auto bg-white rounded-xl">
    <VerificadorOtpInput v-model="internalCode" :fields="6" @update:modelValue="handleCodeUpdate"></VerificadorOtpInput>
  </div>
</template>

<script lang="ts" setup>

const code = ref('');

const internalCode = ref('');

const emits = defineEmits(["update:modelValue"]);

const handleCodeUpdate = (newValue: string) => {
  internalCode.value = newValue;
  emits('update:modelValue', newValue);
};

watch(code, (newValue) => {
  internalCode.value = newValue;
});

</script>

<style></style>
