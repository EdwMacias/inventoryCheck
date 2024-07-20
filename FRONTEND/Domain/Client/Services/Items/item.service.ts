import { ItemBasicoRequestCreateDTO } from "~/Domain/DTOs/ItemBasicoRequestCreateDTO";
import type { ItemBasicoRequest } from "~/Domain/Models/Api/Request/itemBasico.request";
import type { ItemBasico } from "~/Domain/Models/Entities/itemBasico";
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository"

export const itemService = {
    create: async (itemBasicoEntity: ItemBasico) => {
        const itemBasicoRequestDTO = new ItemBasicoRequestCreateDTO(itemBasicoEntity);
        const itemRequest = dtoToObject<ItemBasicoRequest>(itemBasicoRequestDTO);
        const response = await ItemRepository.Create(itemRequest);
        console.log(response);
        
        return true;
    },
}