<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function find($id);
    public function decrementStock($id,$qty);
    public function incrementStock($id, $quantity);

}
