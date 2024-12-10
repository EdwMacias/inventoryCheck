import type { PersonaJuridicaCreateDTO } from "~/Domain/DTOs/Terceros/PersonaJuridica/PersonaJuridicaCreateDTO";
import { PersonaJuridicaDTO } from "~/Domain/DTOs/Terceros/PersonaJuridica/PersonaJuridicaDTO";
import { personaJuridicaRepository } from "~/Infrastructure/Repositories/Terceros/PersonaJuridica/juridica.repository";

export const personaJuridicaService = {
    create: async (personaJuridicaCreateDTO: PersonaJuridicaCreateDTO) => {
        return await personaJuridicaRepository.create(personaJuridicaCreateDTO.toArray());
    },
    details: async (email: string) => {
        try {
            const response = await personaJuridicaRepository.details(email);
            return new PersonaJuridicaDTO(response.data);
        } catch (error) {
            console.error(error);
            return;
        }
    }
}