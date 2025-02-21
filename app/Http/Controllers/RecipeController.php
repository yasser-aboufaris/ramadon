<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Category; 

class RecipeController extends Controller
{
    
    public function index()
    {
        $recipes = Recipe::with('category')->get(); 
        $categories = Category::all();
    
        return view('recipes', compact('recipes', 'categories'));
    }
    

        public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'content' => 'required|string',
        'category_id' => 'required|exists:categories,id',
    ]);

    Recipe::create([
        'name' => $request->name,
        'description' => $request->description,
        'content' => $request->content,
        'category_id' => $request->category_id,
    ]);

    return redirect()->back();
}

public function filterByCategory($category_id)
{
    $recipes = Recipe::with('category')
        ->whereHas('category', function($query) use ($category_id) {
            $query->where('id', $category_id);
        })
        ->get();
    
    $categories = Category::all();
    $currentCategory = Category::findOrFail($category_id);

    return view('filter', compact('recipes', 'categories', 'currentCategory'));
}

}
