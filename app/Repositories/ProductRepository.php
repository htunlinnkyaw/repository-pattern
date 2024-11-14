<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\BaseRepository;

class ProductRepository implements BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = Product::class;
    }

    public function find($id)
    {
        $product = $this->model::find($id);
        return $product;
    }
    public function create(array $data)
    {
        $product = $this->model::create($data);
        return $product;
    }
    public function update($id, array $data)
    {
        $product = $this->model::find($id);
        $product->update($data);
        return $product;
    }
    public function delete($id)
    {
        $product = $this->model::find($id);
        $product->delete();
    }
}

