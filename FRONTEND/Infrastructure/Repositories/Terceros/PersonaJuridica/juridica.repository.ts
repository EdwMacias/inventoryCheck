import type { PersonaJuridicaDTO } from "~/Domain/DTOs/Terceros/PersonaJuridica/PersonaJuridicaDTO";
import { http } from "~/Infrastructure/http/http"

export const personaJuridicaRepository = {
    create: async (datos: object) => {
        const response = await http.post<PersonaJuridicaDTO>("", datos);
        return response;
    },
}