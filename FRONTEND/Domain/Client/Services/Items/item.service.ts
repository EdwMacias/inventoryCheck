import { ItemBasicoRequestCreateDTO } from "~/Domain/DTOs/ItemBasicoRequestCreateDTO";
import type { FormularioCreateItemBasicoDTO } from "~/Domain/DTOs/Request/Items/FormularioCreateItemBasicoDTO";
import type { ItemBasicoRequest } from "~/Domain/Models/Api/Request/itemBasico.request";
import type { ItemBasico } from "~/Domain/Models/Entities/itemBasico";
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository"

export const itemService = {
    create: async (formularioCreateItemBasicoDTO: FormularioCreateItemBasicoDTO) => {
        const itemBasicoRequestDTO = new ItemBasicoRequestCreateDTO(formularioCreateItemBasicoDTO);
        const response = await ItemRepository.Create(itemBasicoRequestDTO.toFormData());
        return true;
    },
}