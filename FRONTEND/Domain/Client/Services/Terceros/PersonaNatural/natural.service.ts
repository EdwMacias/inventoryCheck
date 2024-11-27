import type { PersonaNaturalCreateDTO } from "~/Domain/DTOs/Terceros/PersonaNatural/PersonaNaturalCreateDTO";
import { personaNaturalRepository } from "~/Infrastructure/Repositories/Terceros/PersonaNatural/natural.repository";

export const personaNaturalService = {
    create: async (personaNaturalCreateDTO: PersonaNaturalCreateDTO) => {
        return await personaNaturalRepository.create(personaNaturalCreateDTO.toArray());
    }
}