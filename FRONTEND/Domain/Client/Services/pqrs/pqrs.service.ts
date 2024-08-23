import { PqrsRequestCreateDTO } from "~/Domain/DTOs/PqrsRequestCreateDTO";
import type { PqrsRequest } from "~/Domain/Models/Api/Request/pqrs.request"; 
import type { Pqrs } from "~/Domain/Models/Entities/pqrs";
import { PqrsRepository } from "~/Infrastructure/Repositories/pqrs/pqrs.repository";

export const PqrsService = {
    create: async (pqrsEntity: Pqrs) => {
        const pqrsRequestDTO = new PqrsRequestCreateDTO(pqrsEntity);
        const pqrsRequest = dtoToObject<PqrsRequest>(pqrsRequestDTO);
        const response = await PqrsRepository.Create(pqrsRequest);        
        return true;
    },
}

