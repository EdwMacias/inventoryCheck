import { http } from "~/Infrastructure/http/http"

export const OficinaObservacionRepository = {

    create: async (observacion: FormData) => {
        return await http.post<any>('item/observacion/oficina', observacion);
    },
    getObservacionItemOficinaById: async (id: string) => {
        return await http.post<any>('item/observacion/oficina/' + id);
    }

}