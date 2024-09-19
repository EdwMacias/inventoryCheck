import { http } from "~/Infrastructure/http/http"

export const EquipoObservacionRepository = {

    create: async (observacion: FormData) => {
       return await http.post<any>('item/observacion/equipo', observacion);
    }

}