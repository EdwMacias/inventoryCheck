import type { PersonaNaturalCreateDTO } from "~/Domain/DTOs/Terceros/PersonaNatural/PersonaNaturalCreateDTO";
import { PersonaNaturalDTO } from "~/Domain/DTOs/Terceros/PersonaNatural/PersonaNaturalDTO";
import { personaNaturalRepository } from "~/Infrastructure/Repositories/Terceros/PersonaNatural/natural.repository";

export const personaNaturalService = {
    create: async (personaNaturalCreateDTO: PersonaNaturalCreateDTO) => {
        return await personaNaturalRepository.create(personaNaturalCreateDTO.toArray());
    },
    details: async (id: string) => {
        try {
            const response = await personaNaturalRepository.details(id);
            return new PersonaNaturalDTO(response.data);
        } catch (error) {
            console.error(error);
            return;
        }
    }
}