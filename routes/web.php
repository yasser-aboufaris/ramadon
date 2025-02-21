<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Controllers\CommentController;
use App\Models\Recipe;
use App\Models\Category; 
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
Route::post('/posts/add', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/delete', [PostController::class, 'destroy'])->name('posts.destroy');
Route::post('/comment/add', [CommentController::class, 'store'])->name('comment.add');
Route::delete('/comment/{id}' , [CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/recipes'  , [RecipeController::class,'index']);
Route::post('/recipes/add'  , [RecipeController::class,'store']);
Route::get('/recipes/{category_id}/category', [RecipeController::class, 'filterByCategory']);




