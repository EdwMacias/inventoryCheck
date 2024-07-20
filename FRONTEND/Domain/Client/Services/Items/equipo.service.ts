import { EquipoRequestCreateDTO } from "~/Domain/DTOs/EquipoRequestCreateDTO";
import type { EquipoRequestCreate } from "~/Domain/Models/Api/Request/equipo.request";
import type { EquipoEntity } from "~/Domain/Models/Entities/equipo";

export const EquipoService = {
    create: async (equipoEntity: EquipoEntity) => {
        const equipoCreateRequestDTO = new EquipoRequestCreateDTO(equipoEntity);
        console.log(equipoCreateRequestDTO);
        const equipoCreate = dtoToObject<EquipoRequestCreate>(equipoCreateRequestDTO);
        console.log(equipoCreate);
        
    }

}