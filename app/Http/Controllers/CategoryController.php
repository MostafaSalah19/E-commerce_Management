<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
//use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::query()->get();
        return CategoryResource::collection($category)->additional(['success' => true]);

    }

    public function store(StoreCategoryRequest  $request)
    {
        $data = $request->validated();

        $category = Category::query()->create($data);

        return new CategoryResource($category)
            ->additional(['success' => true])
            ->response()->setStatusCode(201);
    }

    public function show($id)
    {
        $category = Category::query()->find($id);
        return (new CategoryResource($category)
            ->additional(['success' => true]));
    }

    public function update(StoreCategoryRequest $request, $id)
    {
        $category = Category::query()->findOrFail($id);

        $category->update($request->validated());

        return (new CategoryResource($category)
            ->additional(['success' => true]));
    }

    public function destroy($id)
    {
        $category = Category::query()->findOrFail($id);

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted'
        ]);
    }
}
