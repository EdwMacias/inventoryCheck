import { EquipoRequestCreateDTO } from "~/Domain/DTOs/EquipoRequestCreateDTO";
import type { EquipoRequestCreate } from "~/Domain/Models/Api/Request/equipo.request";
import type { EquipoEntity } from "~/Domain/Models/Entities/equipo";
import { EquipoRepository } from "~/Infrastructure/Repositories/Item/equipo.repository";

export const EquipoService = {
    create: async (equipoEntity: EquipoEntity) => {
        const equipoCreateRequestDTO = new EquipoRequestCreateDTO(equipoEntity);
        const equipoCreate = dtoToObject<EquipoRequestCreate>(equipoCreateRequestDTO);
        const equipoResponse = await EquipoRepository.create(equipoCreate);
        console.log(equipoResponse);
        return true;
    }

}