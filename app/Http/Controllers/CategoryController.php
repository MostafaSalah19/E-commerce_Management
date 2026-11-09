<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::query()->get();

        return $category;
    }

    public function store(Request  $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::query()->create($data);

        return response()->json([
           'success'=> true,
        ], 201);
    }

    public function show($id)
    {
        $category = Category::find($id);
        return $category;
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->update($request->validate(['name' => 'required|string|max:255',]));

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
