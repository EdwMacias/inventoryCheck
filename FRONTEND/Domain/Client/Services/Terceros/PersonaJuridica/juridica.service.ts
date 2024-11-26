import type { PersonaJuridicaCreateDTO } from "~/Domain/DTOs/Terceros/PersonaJuridica/PersonaJuridicaCreateDTO";
import { personaJuridicaRepository } from "~/Infrastructure/Repositories/Terceros/PersonaJuridica/juridica.repository";

export const personaJuridicaService = {
    create: async (personaJuridicaCreateDTO: PersonaJuridicaCreateDTO) => {
        return await personaJuridicaRepository.create(personaJuridicaCreateDTO.toArray());
    }
}