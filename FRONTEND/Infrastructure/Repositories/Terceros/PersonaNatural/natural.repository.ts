import { http } from "~/Infrastructure/http/http"

export const personaNaturalRepository = {
    create: async (datos: object) => {
        const response = http.post("", datos);
        return response;
    }
}