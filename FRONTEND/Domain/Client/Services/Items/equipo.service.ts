import { EquipoRequestCreateDTO } from "~/Domain/DTOs/EquipoRequestCreateDTO";
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
    }

}