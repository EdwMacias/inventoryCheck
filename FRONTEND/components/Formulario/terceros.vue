<template>
  <VeeForm :validation-schema="formularioTerceroSchema" @submit="onSubmit" v-slot="{ errors }">
    

    <div>
      <!-- <p>formulario natural</p> -->
      
    </div>

    <div v-show="formulario.tipoPersonaId == 2">
      <p>formulario juridico</p>
    </div>
  </VeeForm>
</template>

<script lang="ts" setup>
import * as yup from 'yup';
import { TerceroCreate } from '~/Domain/DTOs/Terceros/Tercero/TerceroCreateDTO';



const emits = defineEmits<{
  (event: 'cancel', payload: boolean): void;
}>();

const handleCancel = () => {
  return emits('cancel', true);
};

const formulario: Ref<TerceroCreate> = ref(new TerceroCreate({
  departamento: '',
  ciudad: ''
}));




const formularioTerceroSchema = yup.object({
  fecha: yup.string()
    .required('Este campo es requerido*')
    .matches(
      /^\d{4}-\d{2}-\d{2}$/,
      'Debe ser una fecha en formato YYYY-MM-DD'
    ),
  tipoDocumento: yup
    .string()
    .oneOf(['NIT', 'CE', 'CC', 'PASAPORTE'], 'Debe seleccionar un tipo de documento válido')
    .required('Debe seleccionar un tipo de documento'),
  tipoPersona: yup.string().required('Debe seleccionar un tipo de persona'),
  numeroDocumento: yup.string().required('El número de documento es obligatorio'),
  nombreCompleto: yup.string().required('El nombre completo es obligatorio'),
  correo: yup.string().email('El correo debe ser válido').required('El correo es obligatorio'),
  direccion: yup.string().required('La dirección es obligatoria'),
  ciudad: yup.string().required('La ciudad es obligatoria'),
  telefono: yup.string().required('El teléfono es obligatorio'),
});

const onSubmit = (values: any) => {
  console.log('Formulario enviado:', values);
};
</script>
