<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\userController;
use App\Http\Controllers\admin\articleController;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\dashboardController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
})->middleware('guest');

Route::get('/about', function () {
    return view('about', ['nama' => 'Muhammad Ifan', 'title' => 'About']);
})->middleware('guest');

Route::get('/posts', function () {
    return view('posts', ['title' => 'Blog', 'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(6)->withQueryString()]);
})->middleware('guest');

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', ['title' => 'Single Post', 'post' => $post]);
})->middleware('guest');

Route::get('/authors/{user:username}', function (User $user) {
    // $post = $user->posts->load('category', 'author');
    return view('posts', ['title' => count($user->posts) . ' Article by  ' . $user->name, 'posts' => $user->posts]);
})->middleware('guest');

Route::get('/categories/{category:slug}', function (Category $category) {
    // $post = $category->posts->load('category', 'author');
    return view('posts', ['title' => 'Articles in :  ' . $category->name, 'posts' => $category->posts]);
})->middleware('guest');

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
})->middleware('guest');

// admin routes



Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

// Route::group(['middleware' => 'PreventBackHistory'], function () {

//     // Auth::routes();
Route::middleware(['auth', 'NoChace'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // article routes
    Route::get('/article', [articleController::class, 'index'])->name('article');

    Route::post('/save', [articleController::class, 'store'])->name('article.post');

    Route::get('/create-article', [articleController::class, 'create']);

    Route::get('/edit-article/{post:title}', [articleController::class, 'edit']);

    Route::put('/article/{post:id}', [articleController::class, 'update'])->name('article.update');

    Route::delete('/article/{id}', [articleController::class, 'destroy'])->name('article.delete');

    // article routes
    Route::get('/article', [articleController::class, 'index'])->name('article');

    Route::post('/save', [articleController::class, 'store'])->name('article.post');

    Route::get('/create-article', [articleController::class, 'create']);

    Route::get('/edit-article/{post:title}', [articleController::class, 'edit']);

    Route::put('/article/{post:id}', [articleController::class, 'update'])->name('article.update');

    Route::delete('/article/{id}', [articleController::class, 'destroy'])->name('article.delete');

    // category routes

    Route::get('/category', [categoryController::class, 'index'])->name('category');

    Route::get('/create-category', [categoryController::class, 'create']);

    Route::post('/category', [categoryController::class, 'store'])->name('category.post');

    Route::get('/edit-category/{category:slug}', [categoryController::class, 'edit']);

    Route::put('/update/{category:id}', [categoryController::class, 'update'])->name('category.update');

    Route::delete('/category/{id}', [categoryController::class, 'destroy'])->name('category.delete');

    // user routes

    Route::get('/user', [userController::class, 'index'])->name('user');

    Route::get('/create-user', [userController::class, 'create']);

    Route::post('/user', [userController::class, 'store'])->name('user.post');

    Route::get('/edit-user/{user:name}', [userController::class, 'edit']);

    Route::put('/user/{user:id}', [userController::class, 'update'])->name('user.update');

    Route::delete('/user/{id}', [userController::class, 'destroy'])->name('user.delete');

    Route::post('/logout', [AuthController::class, 'logout']);
});
// });
Route::get('/login', [AuthController::class, 'index'])->middleware('guest')->name('login');
