<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
//use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        return Category::query()->get();

    }

    public function store(StoreCategoryRequest  $request)
    {
        $data = $request->validated();

        Category::query()->create($data);

        return response()->json([
           'success'=> true,
        ], 201);
    }

    public function show($id)
    {
        return Category::query()->find($id);
    }

    public function update(StoreCategoryRequest $request, $id)
    {
        $category = Category::query()->findOrFail($id);

        $category->update($request->validated());

        return response()->json([
            'success' => true
        ], 201);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json([
            'success' => true
        ], 201);
    }
}
