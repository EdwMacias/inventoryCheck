import { EquipoRequestCreateDTO } from "~/Domain/DTOs/EquipoRequestCreateDTO";
import type { EquipoEntity } from "~/Domain/Models/Entities/equipo";
import { EquipoRepository } from "~/Infrastructure/Repositories/Item/equipo.repository";

export const EquipoService = {
    create: async (equipoEntity: EquipoEntity) => {
        const equipoCreateRequestDTO = new EquipoRequestCreateDTO(equipoEntity);
        const equipoResponse = await EquipoRepository.create(equipoCreateRequestDTO.toFormData());
        console.log(equipoResponse);
        return true;
    }

}