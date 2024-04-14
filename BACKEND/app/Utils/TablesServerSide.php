<?php

namespace App\Utils;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class TablesServerSide
{
    protected $table;
    protected $campos;
    private $totalRecords;
    private $filterRecords;
    private $drawn;
    public function __construct(string $table, array $campos)
    {
        $this->campos = $campos;
        $this->table = $table;
    }

    public function createTable()
    {

        $query = \DB::table($this->getTable());

        $rquest = Request::capture();

        $this->setTotalRecords($query->count());

        $this->setDrawn(intval($rquest->input("draw", 1)));

        $campos = $this->getCampos();

        if ($rquest->has('search') && $rquest->input('search.value')) {
            $searchValue = $rquest->input('search.value');
            $query->where(function ($q) use ($searchValue, $campos) {
                $q->orWhere($campos, 'LIKE', "%$searchValue%");
            });
        }

        $this->setfilterRecords($query->count());

        $columns = [];

        for ($i = 0; $i < sizeof($campos); $i++) {
            $columns[] = ['db' => $campos[$i], 'dt' => $i];
        }

        if ($rquest->has('order')) {
            foreach ($rquest->input('order') as $order) {
                $columnIndex = $order['column'];
                $columnName = $columns[$columnIndex]['db'];
                $direction = $order['dir'];
                $query->orderBy($columnName, $direction);
            }
        }

        $start = $rquest->input('start', 0);
        $length = $rquest->input('length', 10);

        if ($length != -1) {
            $query->offset($start)->limit($length);
        }

        return $query;
    }

    public function getterTable(Builder $query)
    {
        $data = $query->select($this->getCampos());
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
