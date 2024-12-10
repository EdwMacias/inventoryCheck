<template>
  <div>
    <VeeForm :validationSchema="formularioEquipoSchema" @submit="onSubmit" v-slot="{ meta, errors }">
      <div class="overflow-x-auto">
        <div class="flex justify-end mb-2">
          <button type="button" class="btn btn-sm btn-neutral rounded-full" @click="addComponent">Agregar +</button>
        </div>
        <div class="w-full">
          <table class="table table-zebra table-sm w-full">
            <thead>
              <tr>
                <th>Serial</th>
                <th>Nombre*</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Cantidad*</th>
                <th>Unidad</th>
                <th>Cuidados</th>
                <th>Tipo</th>
                <th>Quitar</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(x, index) in formulario.length" :key="index">
                <td>
                  <VeeField :name="`componentes[${index}].serial`" v-model="formulario[index].serial"
                    placeholder="Serial"
                    :class="`input input-sm w-full ${errors[`componentes[${index}].serial`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].serial`" class="text-error mx-2 text-sm" />
                </td>
                <td>
                  <VeeField :name="`componentes[${index}].nombre`" v-model="formulario[index].nombre"
                    placeholder="Nombre*"
                    :class="`input input-sm w-full ${errors[`componentes[${index}].nombre`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].nombre`" class="text-error mx-2 text-sm" />
                </td>
                <td>
                  <VeeField :name="`componentes[${index}].marca`" v-model="formulario[index].marca" placeholder="Marca"
                    :class="`input input-sm w-full ${errors[`componentes[${index}].marca`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].marca`" class="text-error mx-2 text-sm" />
                </td>
                <td>
                  <VeeField :name="`componentes[${index}].modelo`" v-model="formulario[index].modelo"
                    placeholder="Modelo"
                    :class="`input input-sm w-full ${errors[`componentes[${index}].modelo`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].modelo`" class="text-error mx-2 text-sm" />
                </td>
                <td>
                  <VeeField :name="`componentes[${index}].cantidad`" v-model="formulario[index].cantidad"
                    placeholder="Cantidad*"
                    :class="`input input-sm w-full ${errors[`componentes[${index}].cantidad`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].cantidad`" class="text-error mx-2 text-sm" />
                </td>
                <td>
                  <VeeField :name="`componentes[${index}].unidad`" v-model="formulario[index].unidad"
                    placeholder="Unidad"
                    :class="`input input-sm w-full ${errors[`componentes[${index}].unidad`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].unidad`" class="text-error mx-2 text-sm" />
                </td>
                <td>
                  <VeeField :name="`componentes[${index}].cuidados`" v-model="formulario[index].cuidados"
                    placeholder="Cuidados"
                    :class="`input input-sm w-full ${errors[`componentes[${index}].cuidados`] ? 'input-error' : 'input-bordered'}`" />
                  <VeeErrorMessage :name="`componentes[${index}].cuidados`" class="text-error mx-2 text-sm" />
                </td>
                <td>
                  <VeeField :name="`componentes[${index}].tipo`"
                    :class="`select w-full mt-1 ${errors[`componentes[${index}].tipo`] ? 'select-error' : 'select-bordered'}`"
                    v-model="formulario[index].tipo" as="select">
                    <option value="0">Seleccione</option>
                    <option value="1">Original</option>
                    <option value="2">Repuesto</option>
                  </VeeField>
                  <VeeErrorMessage :name="`componentes[${index}].tipo`"
                    class="text-error animate__animated animate__fadeIn">

                  </VeeErrorMessage>
                </td>
                <td>
                  <button type="button" class="btn btn-sm btn-neutral rounded-full" :disabled="formulario.length <= 1"
                    @click="deleteComponent(index)">-</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <ButtonOptions @cancel="clickInCancel"></ButtonOptions>
    </VeeForm>
  </div>
</template>

<script lang="ts" setup>
import { EquipoComponentesCreateDTO } from '~/Domain/DTOs/Items/Equipo/EquipoComponentesCreateDTO';

const emits = defineEmits<{
  (event: 'callback', payload: EquipoComponentesCreateDTO[]): void,
  (event: 'clickInCancel', payload: boolean): void
}>();

const formularioEquipoSchema = yup.object({
  componentes: yup.array().of(
    yup.object({
      serial: yup.string().nullable(),
      nombre: yup.string().required('El campo es requerido'),
      marca: yup.string().nullable(),
      modelo: yup.string().nullable(),
      cantidad: yup.string()
        .nullable()
        .matches(/^\d+$/, 'La cantidad solo puede contener números*')
        .test('no-cero', 'La Cantidad no puede ser 0*', value => !value || value !== '0')
        .required(),
      unidad: yup.string().nullable(),
      cuidados: yup.string().nullable(),
      tipo: yup
        .string()
        .required('Seleccione una opción válida')
        .oneOf(['1', '2'], 'Seleccione una opción válida'),

    })
  ).test('at-least-one-field', 'Debe haber al menos un campo con datos si alguno está lleno', function (array) {
    return array?.every(obj =>
      Object.values(obj).every(value => value === null || value === undefined || value === '') ||
      (obj.nombre && obj.cantidad)
    );
  })

});
const formulario: Ref<EquipoComponentesCreateDTO[]> = ref([{
  serial: '',
  cantidad: undefined,
  cuidados: '',
  marca: '',
  modelo: '',
  nombre: '',
  unidad: '',
  tipo: '0'
}]);

const addComponent = () => {
  formulario.value.push({
    serial: '',
    cantidad: undefined,
    cuidados: '',
    marca: '',
    modelo: '',
    nombre: '',
    unidad: '',
    tipo: '0'
  })
}

const deleteComponent = (index: number) => {
  if (formulario.value.length > 1) {
    formulario.value.splice(index, 1);
  }
}

function clickInCancel() {
  return emits("clickInCancel", true);
}


const onSubmit = (values: any) => {
  console.log('aqui');

  let equipoComponenteCreateDTO: EquipoComponentesCreateDTO[] = [];

  formulario.value.forEach(element => {
    equipoComponenteCreateDTO.push(new EquipoComponentesCreateDTO(element));
  });

  // const equipoComponenteCreateDTO = new EquipoComponentesCreateDTO(formulario.value);
  return emits("callback", equipoComponenteCreateDTO);
}

</script>

<style></style>