<template>
    <div class="breadcrumbs text-sm mx-2 mt-20">
        <ul>
            <li>
                <NuxtLink to="/">Inicio</NuxtLink>
            </li>
            <li>
                <NuxtLink to="/inventario/items/">Inventario</NuxtLink>
            </li>
            <li>Crear Item</li>
        </ul>
    </div>
    <div class="container mx-auto mx-5 ">
        <h2 class="font-semibold text-xl mt-2">Creación de artículos</h2>
        <div class="mb-2">
            <label class="label">
                <span class="block text-sm font-medium ">Seleccione el registro a crear</span>
            </label>
            <select v-model="categoriaSeleccionada" class="select select-sm select-bordered">
                <option v-for="equipo in equipo" :key="equipo.id" :value="equipo.id">{{ equipo.opcion }}</option>
            </select>
        </div>
        <div v-if="categoriaSeleccionada == 0" class="mt-1 text-error animate__animated text-sm  animate__fadeIn">
            <p>Seleccione un tipo de equipo, por favor.</p>
        </div>
        <FormularioEquipos v-if="categoriaSeleccionada == 1" @callback="crearEquipo" />
        <div v-if="categoriaSeleccionada == 2" class="bg-base-100 p-5 rounded">
            <FormularioItem @callback="crearItemBasico" />
        </div>
        <!-- <ButtonScroll/> -->
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
            mensaje: 'Imagen subida correctamente. Redirigiendo al inventario...',
        });
        return router.push('/inventario/items');
    }
}

const categoriaSeleccionada: Ref<number> = ref(0);
const equipo = ref([
    { id: 0, opcion: 'Seleccione' },
    { id: 1, opcion: 'Equipo de pista' },
    { id: 2, opcion: 'Administrativo' },
]);
</script>

<style scoped></style>