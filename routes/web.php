<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminDashboardController;

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

Route::get('/', [WelcomeController::class, 'load'])->name('welcome');

// USER DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'load'])->middleware(['user'])->name('dashboard');

// USER DASHBOARD
Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth'])->name('admin');

// ADMIN DASHBOARD
Route::get('/admin_dashboard', [AdminDashboardController::class, 'load'])->middleware(['admin'])->name('admin_dashboard');

Route::get('/users1/{test}', function($test){
	return view('users', ['test'=>$test]);
});

Route::get('/test', function(){
	return view('test');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Route::middleware('auth')->group(function(){
//     Route::get('/posts', [PostController::class])->name('posts.index');
//     Route::get('/posts/create', [PostController::class])->name('posts.create');
//     Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
//     Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
//     Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
//     Route::view('/admin', 'admin')->name('admin');
// });


Route::group(['prefix'=>'/posts'], function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');

    Route::get('/comments', [CommentController::class], 'index')->name('comments.index');

    Route::get('/create', [PostController::class, 'create'])->middleware(['user'])
                ->name('posts.create');

    Route::post('/', [PostController::class, 'store'])->middleware(['user'])
                ->name('posts.store');

    Route::get('/comments/{comment}', [CommentController::class, 'show'])->name('comments.show');

    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->middleware(['user'])
                ->name('comments.edit');

    Route::put('/comments/{comment}/update', [CommentController::class, 'update'])->middleware(['user'])
                ->name('comments.update');
    Route::group(['prefix'=>'/{post}'], function(){

        Route::get('/edit', [PostController::class, 'edit'])->middleware(['user'])
                    ->name('posts.edit');

        Route::put('/update', [PostController::class, 'update'])->middleware(['user'])
                    ->name('posts.update');

        Route::get('/', [PostController::class, 'show'])->name('posts.show');

        Route::get('/like', [LikeController::class, 'like'])->middleware(['user'])
                 ->name('like');

        Route::delete('/', [PostController::class, 'destroy'])->middleware(['user'])
                 ->name('posts.destroy');

        Route::group(['prefix' => '/comments'], function(){


            Route::get('/create', [CommentController::class, 'create'])->middleware(['user'])
                ->name('comments.create');

            Route::post('/', [CommentController::class, 'store'])->middleware(['user'])
                ->name('comments.store');

            Route::delete('/{comment}', [CommentController::class, 'destroy'])->middleware(['user'])
                ->name('comments.destroy');
        });
    });


});


require __DIR__.'/auth.php';

Auth::routes();
