import type { PersonaNatural } from "~/Domain/DTOs/Terceros/PersonaNatural/PersonaNatural";
import { GET_DETALLES_TERCERO_NATURAL, POST_CREATE_TERCERO_NATURAL } from "~/Infrastructure/Connections/endpoints.connection";
import { http } from "~/Infrastructure/http/http"

export const personaNaturalRepository = {
    create: async (datos: object) => {
        const response = http.post<PersonaNatural>(POST_CREATE_TERCERO_NATURAL, datos);
        return response;
    },
    details: async (email : string) => { 
        const response = http.get<PersonaNatural>(GET_DETALLES_TERCERO_NATURAL+email);
        return response;
    }

}