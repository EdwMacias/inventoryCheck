<?php

namespace App\Utils;

use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class TablesServerSide
{
    protected $table;
    protected $campos;
    protected Request $request;
    private $totalRecords;
    private $filterRecords;
    private $drawn;
    public function __construct(string $table, Request $request, array $campos)
    {
        $this->campos = $campos;
        $this->table = $table;
        $this->request = $request;
    }

    public function createTable()
    {

        $query = \DB::table($this->table)->select($this->campos);

        $this->setTotalRecords($query->count());

        $this->setDrawn(intval($this->request->input("draw", 1)));

        $campos = $this->getCampos();

        if ($this->request->has('search') && $this->request->input('search.value')) {
            $searchValue = $this->request->input('search.value');
            $campos = $this->campos;
            $query->where(function ($q) use ($searchValue, $campos) {
                foreach ($campos as $campo) {
                    $q->orWhere($campo, 'LIKE', "%$searchValue%");
                }
            });
        }

        $this->setfilterRecords($query->count());

        $columns = [];

        for ($i = 0; $i < sizeof($campos); $i++) {
            $columns[] = ['db' => $campos[$i], 'dt' => $i];
        }

        if ($this->request->has('order')) {
            foreach ($this->request->input('order') as $order) {
                $columnIndex = $order['column'];
                $columnName = $columns[$columnIndex]['db'];
                $direction = $order['dir'];
                $query->orderBy($columnName, $direction);
            }
        }

        $start = $this->request->input('start', 0);
        $length = $this->request->input('length', 10);

        if ($length != -1) {
            $query->offset($start)->limit($length);
        }

        return $query;
    }

    public function getterTable(Builder $query)
    {
        $data = $query->select($this->campos);

        return json_encode([
            "draw" => $this->drawn,
            "recordsTotal" => $this->totalRecords,
            "recordsFiltered" => $this->filterRecords,
            "data" => $data->get(),
        ]);
    }

    private function setTotalRecords($totalRecords)
    {
        $this->totalRecords = $totalRecords;
    }
    private function setfilterRecords($filterRecords)
    {
        $this->filterRecords = $filterRecords;
    }

    private function setDrawn($drawn)
    {
        $this->drawn = $drawn;
    }

    /**
     * Get the value of campos
     */
    public function getCampos()
    {
        return $this->campos;
    }

    /**
     * Set the value of campos
     *
     * @return  self
     */
    public function setCampos($campos)
    {
        $this->campos = $campos;

        return $this;
    }

    /**
     * Get the value of table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set the value of table
     *
     * @return  self
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }
}
