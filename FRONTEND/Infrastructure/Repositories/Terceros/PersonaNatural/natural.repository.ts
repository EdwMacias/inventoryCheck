import type { PersonaNatural } from "~/Domain/DTOs/Terceros/PersonaNatural/PersonaNatural";
import { POST_CREATE_TERCERO_NATURAL } from "~/Infrastructure/Connections/endpoints.connection";
import { http } from "~/Infrastructure/http/http"

export const personaNaturalRepository = {
    create: async (datos: object) => {
        const response = http.post<PersonaNatural>(POST_CREATE_TERCERO_NATURAL, datos);
        return response;
    }
}