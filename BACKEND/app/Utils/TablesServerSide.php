<?php

namespace App\Utils;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TablesServerSide
{
    protected string $table;
    protected string $sql;
    protected array $campos;
    protected Request $request;
    private int $totalRecords;
    private int $filterRecords;
    private int $drawn;

    public function __construct(string $sqlOrTable, Request $request, array $campos)
    {
        $this->campos = $campos;
        $this->table = $sqlOrTable;
        $this->request = $request;
    }

    public function crateBySql(): Builder
    {
        $query = DB::table(DB::raw("({$this->table}) as sub"))
            ->select($this->campos);

        $this->setTotalRecords($query->count());
        $this->setDrawn((int) $this->request->input("draw", 1));

        if ($this->request->has('search') && $this->request->input('search.value')) {
            $searchValue = $this->request->input('search.value');
            $query = $this->applySearchFilter($query, $searchValue);
        }

        $this->setFilterRecords($query->count());

        if ($this->request->has('order')) {
            $query = $this->applyOrder($query);
        }

        $start = (int) $this->request->input('start', 0);
        $length = (int) $this->request->input('length', 10);

        if ($length != -1) {
            $query->offset($start)->limit($length);
        }

        return $query;
    }
    public function createTable(): Builder
    {
        $query = DB::table($this->table)->select($this->campos);

        $this->setTotalRecords($query->count());
        $this->setDrawn((int) $this->request->input("draw", 1));

        if ($this->request->has('search') && $this->request->input('search.value')) {
            $searchValue = $this->request->input('search.value');
            $query = $this->applySearchFilter($query, $searchValue);
        }

        $this->setFilterRecords($query->count());

        if ($this->request->has('order')) {
            $query = $this->applyOrder($query);
        }

        $start = (int) $this->request->input('start', 0);
        $length = (int) $this->request->input('length', 10);

        if ($length != -1) {
            $query->offset($start)->limit($length);
        }

        return $query;
    }

    public function getterTable(Builder $query): string
    {
        $data = $query->get();

        return json_encode([
            "draw" => $this->drawn,
            "recordsTotal" => $this->totalRecords,
            "recordsFiltered" => $this->filterRecords,
            "data" => $data,
        ]);
    }

    private function setTotalRecords(int $totalRecords): self
    {
        $this->totalRecords = $totalRecords;
        return $this;
    }

    private function setFilterRecords(int $filterRecords): self
    {
        $this->filterRecords = $filterRecords;
        return $this;
    }

    private function setDrawn(int $drawn): self
    {
        $this->drawn = $drawn;
        return $this;
    }

    private function applySearchFilter(Builder $query, string $searchValue): Builder
    {
        return $query->where(function ($q) use ($searchValue) {
            foreach ($this->campos as $campo) {
                $q->orWhere($campo, 'LIKE', "%$searchValue%");
            }
        });
    }

    private function applyOrder(Builder $query): Builder
    {
        $columns = $this->getColumns();

        foreach ($this->request->input('order') as $order) {
            $columnIndex = (int) $order['column'];
            $columnName = $columns[$columnIndex]['db'];
            $direction = $order['dir'];
            $query->orderBy($columnName, $direction);
        }

        return $query;
    }

    private function getColumns(): array
    {
        $columns = [];

        foreach ($this->campos as $index => $campo) {
            $columns[] = ['db' => $campo, 'dt' => $index];
        }

        return $columns;
    }

    /**
     * Get the value of campos
     */
    public function getCampos(): array
    {
        return $this->campos;
    }

    /**
     * Set the value of campos
     *
     * @return self
     */
    public function setCampos(array $campos): self
    {
        $this->campos = $campos;
        return $this;
    }

    /**
     * Get the value of table
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * Set the value of table
     *
     * @return self
     */
    public function setTable(string $table): self
    {
        $this->table = $table;
        return $this;
    }
}
