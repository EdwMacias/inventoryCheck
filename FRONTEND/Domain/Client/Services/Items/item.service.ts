import type { ItemRequest } from "~/Domain/Models/Api/Request/item.request";
import type { ItemEntity } from "~/Domain/Models/Entities/item"
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository"


export const itemService = {
    create: async (itemEntity : ItemEntity) => {
        const itemRequest : ItemRequest = {
            description : itemEntity.description,
            name : itemEntity.name,
            serial_number : itemEntity.serial_number,
            resource : itemEntity.resource,
        }

        const response = await ItemRepository.Create(itemRequest);
        return response;
    },
}