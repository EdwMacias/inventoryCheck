import type { PersonaJuridica } from "~/Domain/DTOs/Terceros/PersonaJuridica/PersonaJuridica";
import type { PersonaJuridicaDTO } from "~/Domain/DTOs/Terceros/PersonaJuridica/PersonaJuridicaDTO";
import { GET_DETALLES_TERCERO_JURIDICO, POST_CREATE_TERCERO_JURIDICO } from "~/Infrastructure/Connections/endpoints.connection";
import { http } from "~/Infrastructure/http/http"

export const personaJuridicaRepository = {
    create: async (datos: object) => {
        const response = await http.post<PersonaJuridica>(POST_CREATE_TERCERO_JURIDICO, datos);
        return response;
    },
    details: async (email: string) => {
        const response = await http.get<PersonaJuridica>(GET_DETALLES_TERCERO_JURIDICO + email);
        return response;
    }
}