<template>
  <Form @submit="submit" :validation-schema="schema">
    <Field name="email" />
    <ErrorMessage name="email" />
    <Field name="contraseña" type="password" />
    <ErrorMessage name="contraseña" />
    <button>Submit</button>
  </Form>
</template>
<script setup lang="ts">

import { yup } from "@/utils/yup.config";
import { Form, Field, ErrorMessage } from 'vee-validate';

const schema = yup.object({
  email: yup.string().required().email(),
  contraseña: yup.string().required(),
});
</script>
