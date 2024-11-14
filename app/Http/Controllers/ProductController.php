<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = Product::all()->makeHidden(['created_at', 'updated_at']);
        return response()->json(["data" => $products, "status" => 200]);
    }

    public function store(Request $request)
    {
        $product = $this->productRepository->create([
            "name" => $request->name,
            "price" => $request->price,
            "stock" => $request->stock,
            "description" => $request->description
        ]);

        return response()->json(["data" => $product, "message" => "Product created successfully", "status" => 200,]);
    }

    public function show($id)
    {
        $product = $this->productRepository->find($id)->makeHidden(['created_at', 'updated_at']);
        return response()->json(["data" => $product, "status" => 200]);
    }

    public function update($id, Request $request)
    {
        $product = $this->productRepository->update($id, [
            "name" => $request->name,
            "price" => $request->price,
            "stock" => $request->stock,
            "description" => $request->description
        ]);

        return response()->json(["data" => $product, "message" => "Product updated successfully", "status" => 200,]);
    }

    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return response()->json(["message" => "Product deleted successfully", "status" => 200]);
    }

}
