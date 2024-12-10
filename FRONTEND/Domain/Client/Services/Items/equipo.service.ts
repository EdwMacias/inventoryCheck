import { EquipoRequestCreateDTO } from "~/Domain/DTOs/EquipoRequestCreateDTO";
import type { EquipoComponentesCreateDTO } from "~/Domain/DTOs/Items/Equipo/EquipoComponentesCreateDTO";
import { EquipoDTO } from "~/Domain/DTOs/Items/Equipo/EquipoDTO";
import type { EquipoEntity } from "~/Domain/Models/Entities/equipo";
import { EquipoRepository } from "~/Infrastructure/Repositories/Item/equipo.repository";

export const EquipoService = {
    create: async (equipoEntity: EquipoEntity) => {
        const equipoCreateRequestDTO = new EquipoRequestCreateDTO(equipoEntity);
        const equipoResponse = await EquipoRepository.create(equipoCreateRequestDTO.toFormData());
        return equipoResponse;
    },

    details: async (itemId: string) => {
        const response = await EquipoRepository.details(itemId);
        const equipoDTO = new EquipoDTO(response.data);
        return equipoDTO;
    },

    registrarComponentes: async (equipoComponenteCreateDTOs: EquipoComponentesCreateDTO[],itemId : string) => {
        const formData = new FormData();

        equipoComponenteCreateDTOs.forEach((elemento, index) => {
            formData.append(`componentes[${index}]`, elemento.toString())
        });

        const response = await EquipoRepository.registarComponentes(formData,itemId);

        return response;
    }

}