<?php

namespace App\DTOs\Datatable;

class DatatableDTO
{
    public  $data;
    public int $draw;
    public int $recordsTotal;
    public int $recordsFiltered;

    public function __construct()
    {
        $this->data = [];
        $this->draw = 0;
        $this->recordsTotal = 0;
        $this->recordsFiltered = 0;
    }
}
