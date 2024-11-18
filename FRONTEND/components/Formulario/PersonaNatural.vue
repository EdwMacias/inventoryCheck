<template>
  <div class="flex w-full flex-col">
        <div class="divider divider-center select-none">Datos Basicos</div>
      </div>
      <div class="grid grid-cols-4 gap-4">
        <label class="form-control w-full max-w-xs">
          <div class="label">
            <span class="label-text">Primer Nombre *</span>
          </div>
          <input type="text" placeholder="Nombre" class="input input-bordered w-full max-w-xs" />
        </label>
        <label class="form-control w-full max-w-xs">
          <div class="label">
            <span class="label-text">Segundo Nombre</span>
          </div>
          <input type="text" placeholder="Nombre" class="input input-bordered w-full max-w-xs" />
        </label>
        <label class="form-control w-full max-w-xs">
          <div class="label">
            <span class="label-text">Primer Apellido *</span>
          </div>
          <input type="text" placeholder="Apellido" class="input input-bordered w-full max-w-xs" />
        </label>
        <label class="form-control w-full max-w-xs">
          <div class="label">
            <span class="label-text">Segundo Apellido</span>
          </div>
          <input type="text" placeholder="Apellido" class="input input-bordered w-full max-w-xs" />
        </label>

      </div>
      <div class="grid grid-cols-2 gap-2 mt-2">

        <div class="">
          <div class="label">
            <span class="label-text">Tipo Identificación *</span>
          </div>
          <div class="flex gap-10 ">
            <!-- Persona Natural -->
            <div class="form-control">
              <label class="label cursor-pointer">
                <input type="radio" name="tipoIdentificacion"
                  class="radio peer appearance-none rounded-full border border-gray-300 checked:border-blue-500 focus:outline-none transition"
                  value="CC" />
                <span class="label-text mx-2 text-gray-600 peer-checked:font-medium">Cedula Ciudadania</span>
              </label>
            </div>

            <!-- Persona Jurídica -->
            <div class="form-control">
              <label class="label cursor-pointer">
                <VeeField type="radio" name="tipoIdentificacion" class="radio peer appearance-none rounded-full 
                  border border-gray-300 checked:border-blue-500 focus:outline-none transition" value="CE" />
                <span class="label-text mx-2 text-gray-600 peer-checked:font-medium">Cedula de Extranjería</span>
              </label>
            </div>

            <div class="form-control">
              <label class="label cursor-pointer">
                <VeeField type="radio" name="tipoIdentificacion"
                  class="radio peer appearance-none rounded-full border border-gray-300 checked:border-blue-500 focus:outline-none transition"
                  value="PASAPORTE" />
                <span class="label-text mx-2 text-gray-600 peer-checked:font-medium">Pasaporte</span>
              </label>
            </div>

          </div>

        </div>
        <div>
          <label class="form-control w-full max-w-xs">
            <div class="label">
              <span class="label-text">Número de Identificacion *</span>
            </div>
            <input type="text" placeholder="108#####" class="input input-bordered w-full " />
          </label>
        </div>

      </div>

      <div class="flex w-full flex-col">
        <div class="divider divider-center select-none">Datos de Contacto</div>
      </div>
      <div class="grid grid-cols-3 gap-3">
        <label class="form-control w-full max-w-xs">
          <div class="label">
            <span class="label-text">Teléfono *</span>
          </div>
          <input type="text" placeholder="Nombre" class="input input-bordered w-full max-w-xs" />
        </label>
        <label class="form-control w-full max-w-xs">
          <div class="label">
            <span class="label-text">Correo Electronico *</span>
          </div>
          <input type="text" placeholder="Nombre" class="input input-bordered w-full max-w-xs" />
        </label> <label class="form-control w-full max-w-xs">
          <div class="label">
            <span class="label-text">Dirección *</span>
          </div>
          <input type="text" placeholder="Nombre" class="input input-bordered w-full max-w-xs" />
        </label>
      </div>

      <div class="flex w-full flex-col">
        <div class="divider divider-center select-none">Datos de Ubicación</div>
      </div>
      <div class="grid grid-cols-3 gap-3">
        <div class="">
          <div class="label">
            <span class="label-text">Departamento</span>
          </div>
          <Multiselect :options="articles.data.value" placeholder="Departamento" label="departamento"
            v-model="formulario.departamento" track-by="departamento">
          </Multiselect>
        </div>
        <div class="">
          <div class="label">
            <span class="label-text">Ciudad o Municipio</span>
          </div>
          <Multiselect :disabled="ciudades.length == 0" :close-on-select="true" :options="ciudades"
            placeholder="Municipio" v-model="formulario.ciudad">
          </Multiselect>
        </div>
      </div>
    <ButtonOptions @cancel="handleCancel">Registrar</ButtonOptions>

</template>

<script lang="ts" setup>
import { TerceroCreate } from '~/Domain/DTOs/Terceros/Tercero/TerceroCreateDTO';
import Multiselect from 'vue-multiselect'

const emits = defineEmits<{
  (event: 'cancel', payload: boolean): void;
}>();

const formulario: Ref<TerceroCreate> = ref(new TerceroCreate({
  departamento: '',
  ciudad: ''
}));

const articles = await useFetch('/api/colombia')
const ciudades: Ref<[]> = ref([]);

const handleCancel = () => {
  return emits('cancel', true);
};

watch(
  () => formulario.value.departamento,
  (newDepartamento: any) => {
    if (newDepartamento) {
      // Find the department and update the cities
      const selectedDepartment = articles.data.value.find(
        (item: any) => item.departamento === newDepartamento.departamento
      );
      ciudades.value = selectedDepartment ? selectedDepartment.ciudades : [];
    } else {
      // Clear the cities if no department is selected
      ciudades.value = [];
    }
  }
);


</script>

<style>

</style>