<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SubCategoryController;

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
    return view('frontend.homepage');
})->name('frontend');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// * PROFILE ROUTES
Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
Route::put('/profile-update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::patch('/password-update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');


Route::prefix('/backend/categories')->name("category.")->controller(CategoryController::class)->group(
    function () {

        Route::get('/',  'viewCategory')->name('show');
        Route::post('/store', 'storeCategory')->name('store');
        Route::get('/edit/{slug}', 'editCategory')->name("edit");
        Route::put('/update/{slug}', 'updateCategory')->name("update");
        Route::delete('/delete/{id}', 'deleteCategory')->name("delete");
    }
);


//* url, name, controller
Route::prefix('/backend/sub-categories')->name('subcategory.')->controller(SubCategoryController::class)->group(function () {
    Route::get('/', 'viewSubCategory')->name('view');
    Route::post('/store', 'storeSubCategory')->name('store');
    Route::get('/get-all-sub-category', 'getSubCategory')->name('get');
});

//* POST GROUP
Route::prefix('/backend/posts')->name('post.')->controller(PostController::class)->group(function () {
    Route::get('/', 'addPost')->name('add');
    Route::post('/store', 'storePost')->name('store');
    Route::get('/all', 'getAllPost')->name('all');
});
