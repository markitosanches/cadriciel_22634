<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CustomAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', [BlogPostController::class, 'index'])->name('blog.index')->middleware('auth');
Route::get('/blog/{blogPost}', [BlogPostController::class, 'show'])->name('blog.show')->middleware('auth');
Route::get('/blog-create', [BlogPostController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('/blog-create', [BlogPostController::class, 'store']);
Route::get('/blog-edit/{blogPost}', [BlogPostController::class, 'edit'])->name('blog.edit');
Route::put('/blog-edit/{blogPost}', [BlogPostController::class, 'update']);
Route::delete('/blog-edit/{blogPost}', [BlogPostController::class, 'destroy'])->name('blog.delete');
Route::get('/query', [BlogPostController::class, 'query']);
Route::get('/page', [BlogPostController::class, 'page']);

Route::get('/registration', [CustomAuthController::class, 'create'])->name('user.create');
Route::post('/registration', [CustomAuthController::class, 'store']);
Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('/login', [CustomAuthController::class, 'authentication']);
Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');
Route::get('/user-list', [CustomAuthController::class, 'userList'])->name('user.list');
