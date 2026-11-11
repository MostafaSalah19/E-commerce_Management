<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
//use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::query()->with('category:id,name')->get();
        return ProductResource::collection($product)->additional(['success'=>true]);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        $product = Product::query()->create($data);

        return new ProductResource($product->load('category'))
            ->additional(['success'=>true])
            ->response()->setStatusCode(201);
    }

    public function show($id)
    {
        $product = Product::query()->find($id);

        return new ProductResource($product->load('category'))
            ->additional(['success'=>true]);
    }

    public function update(StoreProductRequest $request, $id)
    {
        $product = Product::query()->findOrFail($id);

        $data = $request->validated();

        $product->update($data);

        return new ProductResource($product->load('category'))
            ->additional(['success'=>true]);
    }

    public function destroy($id)
    {
        $product = Product::query()->findOrFail($id);

        $product->delete();

        return response()->json([
            'success'=> true,
            'message'=>'Deleted'
        ]);
    }
}
