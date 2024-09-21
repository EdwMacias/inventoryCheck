<template>
    <div class="breadcrumbs text-lg mx-2 mt-20">
        <ul>
            <li>
                <NuxtLink to="/">Inicio</NuxtLink>
            </li>
            <li>
                <NuxtLink to="/inventario/items/">Inventario</NuxtLink>
            </li>
            <li>Crear</li>
        </ul>
    </div>

    <div class="container mx-auto  ">
        <div class="mb-2">
            <label class="label">
                <span class="block text-sm font-medium ">Seleccione el registro a crear</span>
            </label>
            <select v-model="categoriaSeleccionada" class="select select-bordered">
                <option value="0" disabled>Seleccione</option>
                <option value="1">Equipo de pista</option>
                <option value="2">Administrativo</option>
            </select>
        </div>

        <div v-if="categoriaSeleccionada == '1'" class="bg-base-100 p-1 rounded-lg">
            <FormularioEquipos @callback="crearEquipo" />
        </div>
        <div v-if="categoriaSeleccionada == '2'" class="bg-base-100 p-5 rounded-lg">
            <FormularioItem @callback="crearItemBasico" />
        </div>

    </div>

</template>
<script setup lang="ts">
import { EquipoService } from '~/Domain/Client/Services/Items/equipo.service';
import { itemService } from '~/Domain/Client/Services/Items/item.service';
import type { FormularioCreateItemBasicoDTO } from '~/Domain/DTOs/Request/Items/FormularioCreateItemBasicoDTO';
import type { EquipoEntity } from '~/Domain/Models/Entities/equipo';
const spinnerStore = SpinnerStore();
const router = useRouter();

definePageMeta({
    middleware: ['actions-middleware']
})

const crearEquipo = async (equipoEntity: EquipoEntity) => {
    spinnerStore.status = true;
    const response = await EquipoService.create(equipoEntity);
    spinnerStore.status = false;

    if (response) {
        await emitNotificaciones({
            tipo: 'success',
            cabecera: 'Éxito',
            mensaje: 'Equipo Creado Con Exito',
        });
        return router.push('/inventario/items');
    }
}


const crearItemBasico = async (formularioCreateItemBasicoDTO: FormularioCreateItemBasicoDTO) => {
    spinnerStore.status = true;
    const response = await itemService.create(formularioCreateItemBasicoDTO);
    spinnerStore.status = false;

    if (response) {
        await emitNotificaciones({
            tipo: 'success',
            cabecera: 'Éxito',
            mensaje: 'Item de Oficina Creado Exitosamente',
        });
        return router.push('/inventario/items');
    }
}

const categoriaSeleccionada: Ref<string> = ref('1');
</script>

<style scoped></style>