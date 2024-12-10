<?php

namespace App\Repositories\Repositories;

use App\DTOs\ItemDTOs\ItemCreateDTO;
use App\Models\Inventory\Item;
use App\Models\Views\ItemView;
use App\Repositories\Interfaces\InterfaceItemRepository;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class ItemRepository implements InterfaceItemRepository
{

    /**
     *
     * @param mixed $id
     */
    public function active($id)
    {
        $itemModel = Item::find($id);
        $itemModel->statu_id = 1;
        return $itemModel->save();
    }


    public function create(array $item)
    {
        return Item::create($item);
    }

    /**
     *
     * @param mixed $id
     */
    public function delete($id)
    {
        try {
            $item = Item::find($id);

            if (!$item) {
                throw new \Exception("Item no encontrado", Response::HTTP_NOT_FOUND);
            }

            return $item->delete();

        } catch (\Exception $e) {
            throw new \Exception("Error al eliminar item : {$e->getMessage()}", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     *
     * @param mixed $id
     */
    public function inactivate($id)
    {
        $itemModel = Item::on()->find($id);
        $itemModel->statu_id = 0;
        return $itemModel->save();
    }

    /**
     *
     * @param mixed $id
     * @param array $item
     */
    public function update($id, array $item)
    {
        $itemModel = Item::on()->find($id);
        return $itemModel->update($item);
    }


    public function getItemByName(string $name): bool
    {
        $item = Item::where('name', $name)->exists();
        return $item;
    }
    /**
     *
     * @param string $serialNumber
     * @return bool
     */
    public function getItemBySerialNumber(string $serialNumber): bool
    {
        $item = Item::where('serial_number', $serialNumber)->exists();
        return $item;
    }
    /**
     *
     * @param string $itemId id del item a buscar
     * @return bool --Retorna true si existe false si no existe
     */
    public function existItemByItemId(string $itemId): bool
    {
        return Item::where('item_id', $itemId)->exists();
    }

    public function paginationItems(string $perPage, string $page, string $searchTerm = '', $category = null): LengthAwarePaginator
    {
        // Validar valores de paginación
        $perPage = is_numeric($perPage) && (int) $perPage > 0 ? (int) $perPage : 10;
        $page = is_numeric($page) && (int) $page > 0 ? (int) $page : 1;

        // Construir la consulta base
        $query = Item::orderBy('created_at', 'asc')
            ->with(['equipo', 'itemBasico']);
            
        if ($category) {
            $query->where('category_id', $category);
        }

        // Si el término de búsqueda no está vacío
        if (!empty($searchTerm)) {
            $query->where(function (Builder $q) use ($searchTerm) {
                $q->orWhereHas('equipo', function (Builder $q) use ($searchTerm) {
                    $q->where('serie_lote', 'like', "{$searchTerm}%")
                        ->orWhere('name', 'like', "{$searchTerm}%");
                })->orWhereHas('itemBasico', function (Builder $q) use ($searchTerm) {
                    $q->where('serie_lote', 'like', "{$searchTerm}%")
                        ->orWhere('name', 'like', "{$searchTerm}%");
                });
            });
        }

        // Devolver los resultados paginados
        return $query->paginate($perPage, ['*'], 'page', $page);
    }

}
