import { ItemBasicoRequestCreateDTO } from "~/Domain/DTOs/ItemBasicoRequestCreateDTO";
import { OficinaDTO } from "~/Domain/DTOs/Items/Oficina/OficinaDTO";
import type { FormularioCreateItemBasicoDTO } from "~/Domain/DTOs/Request/Items/FormularioCreateItemBasicoDTO";
import type { ItemBasicoRequest } from "~/Domain/Models/Api/Request/itemBasico.request";
import type { ItemBasico } from "~/Domain/Models/Entities/itemBasico";
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository"

export const itemService = {
    create: async (formularioCreateItemBasicoDTO: FormularioCreateItemBasicoDTO) => {
        // const itemBasicoRequestDTO = new ItemBasicoRequestCreateDTO(formularioCreateItemBasicoDTO);
        const response = await ItemRepository.Create(formularioCreateItemBasicoDTO.toFormData());
        return true;
    },

    details: async (itemId: string) => {
        const response = await ItemRepository.details(itemId);
        const oficinaDTO = new OficinaDTO(response.data);
        return oficinaDTO;
    }

}