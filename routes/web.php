<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function (){
//    return view('welcome');
// });

// User Routes
Route::get('/register', [UserController::class, 'getUserRegisterPage']);

Route::post('/register', [UserController::class, 'userRegister'])->name('user.register');

Route::post('/login', [UserController::class, 'userLogin']);


// Category Routes
Route::get('/categories', [CategoryController::class, 'getAllCategories']);
Route::post('/categories', [CategoryController::class, 'createCategory'])->name('category.create');
Route::get('/change-status', [CategoryController::class, 'changeCategoryStatus']);


// Blog Routes
Route::get('/', [BlogController::class, 'getBlogs']);

Route::get('/create-blog', [BlogController::class, 'getCreateBlogPage']);
Route::post('/blogs', [BlogController::class, 'postBlog'])->name('blog.create');
Route::get('/preview', [BlogController::class, 'previewBlog']);

Route::get('/edit-blog', [BlogController::class, 'getEditBlogPage']);
Route::post('/blogs/{id}', [BlogController::class, 'updateBlog'])->name('blog.edit');

Route::get('/delete-blog', [BlogController::class, 'deleteBlog']);