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
}
