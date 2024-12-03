<template>
    <div class="breadcrumbs text-lg">
        <ul>
            <li>
                <NuxtLink to="/">Inicio</NuxtLink>
            </li>
            <li>
                <NuxtLink :to="INDEX_PAGE_INVENTARIO">Inventario</NuxtLink>
            </li>
            <li>Registrar</li>
        </ul>
    </div>

    <div class="">
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

        <div v-show="categoriaSeleccionada == '1'" class="bg-base-100 p-1 rounded-lg">
            <FormularioEquipos @callback="crearEquipo" />
        </div>
        <div v-show="categoriaSeleccionada == '2'" class="bg-base-100 p-5 rounded-lg">
            <FormularioItem @callback="crearItemBasico" />
        </div>

    </div>

</template>
<script setup lang="ts">
import { EquipoService } from '~/Domain/Client/Services/Items/equipo.service';
import { itemService } from '~/Domain/Client/Services/Items/item.service';
import type { FormularioCreateItemBasicoDTO } from '~/Domain/DTOs/Request/Items/FormularioCreateItemBasicoDTO';
import type { EquipoEntity } from '~/Domain/Models/Entities/equipo';
import { INDEX_PAGE_INVENTARIO } from '~/Infrastructure/Paths/Paths';
const spinnerStore = SpinnerStore();
const router = useRouter();
const { $swal } = useNuxtApp()

const crearEquipo = async (equipoEntity: EquipoEntity) => {
    spinnerStore.status = true;
    try {
        const response = await EquipoService.create(equipoEntity);
        spinnerStore.status = false;

        if (response) {
            await $swal.fire({
                title: 'Equipo Creado',
                text: 'El Equipo Fue Creado Con Exito',
                icon: 'success'
            })
            return router.push(INDEX_PAGE_INVENTARIO);
        }
    } catch (error) {
        // return;
        spinnerStore.status = false;

    }

}


const crearItemBasico = async (formularioCreateItemBasicoDTO: FormularioCreateItemBasicoDTO) => {
    spinnerStore.status = true;
    try {
        const response = await itemService.create(formularioCreateItemBasicoDTO);
        spinnerStore.status = false;

        if (response) {
            
            await $swal.fire({
                title: 'Item Oficina Creado',
                text: 'El Item Oficina Fue Creado Con Exito',
                icon: 'success'
            });

            return router.push(INDEX_PAGE_INVENTARIO);

        }
    } catch (error) {
        spinnerStore.status = false;
    }

}

const categoriaSeleccionada: Ref<string> = ref('1');
</script>

<style scoped></style>