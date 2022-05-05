<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('shops')->when($request->search, function ($q, $value) { 
            $q->where('name', 'LIKE','%'.$value.'%');
       })->latest()->get();


        return response()->json([
            'status' => true,
            'message' => 'successfully',
            'data' => CategoryResource::collection($categories)
        ]);
    }
}
