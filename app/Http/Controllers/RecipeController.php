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
    // Retrieve recipes for the specified category.
    $recipes = Recipe::with('category')
        ->whereHas('category', function($query) use ($category_id) {
            $query->where('id', $category_id);
        })
        ->get();
        
    $recipeCount = $recipes->count();

    $totalRecipes = Recipe::count();

    $categoryPercentage = $totalRecipes > 0 ? round(($recipeCount / $totalRecipes) * 100, 2) : 0;

    $totalCategories = Category::count();
    $averageRecipesPerCategory = $totalCategories > 0 ? round($totalRecipes / $totalCategories, 2) : 0;

    $categories = Category::all();
    $currentCategory = Category::findOrFail($category_id);

    return view('filter', compact(
        'recipes', 
        'categories', 
        'currentCategory', 
        'averageRecipesPerCategory', 
        'categoryPercentage'
    ));
}


}
