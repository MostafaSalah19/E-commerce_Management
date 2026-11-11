<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
//use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::query()->get();
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        Product::query()->create($data);

        return response()->json([
            'success'=> true,
        ], 201);
    }

    public function show($id)
    {
        return Product::query()->find($id);
    }

    public function update(StoreProductRequest $request, $id)
    {
        $product = Product::query()->findOrFail($id);

        $data = $request->validated();

        $product->update($data);

        return response()->json([
            'success' => true
        ], 201);
    }

    public function destroy($id)
    {
        $product = Product::query()->findOrFail($id);

        $product->delete();

        return response()->json([
            'success'=> true
        ], 201);
    }
}
