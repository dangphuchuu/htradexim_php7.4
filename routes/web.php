<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\LogosController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\FootersController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CharityController;

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
Route::prefix('admin')->group(function(){
    Route::get('/login',[UserController::class, 'getLogin']);
    Route::post('/login',[UserController::class, 'postLogin']);
    Route::get('/logout',[UserController::class, 'getLogout']);
});
Route::middleware('admin')->group(function()
{
    Route::prefix('admin')->group(function()
    {
        Route::get('/',[CategoriesController::class, 'list']);
       
        Route::prefix('categories')->group(function()
        {
            Route::get('/list',[CategoriesController::class,'list']);
            Route::get('/add',[CategoriesController::class,'getAdd']);
            Route::post('/add',[CategoriesController::class,'postAdd']);
            Route::get('/edit/{id}',[CategoriesController::class,'getEdit']);
            Route::post('/edit/{id}',[CategoriesController::class,'postEdit']);
        });
        Route::prefix('products')->group(function()
        {
            Route::get('/list',[ProductsController::class,'list']);
            Route::get('/add',[ProductsController::class,'getAdd']);
            Route::post('/add',[ProductsController::class,'postAdd']);
            Route::get('/edit/{id}',[ProductsController::class,'getEdit']);
            Route::post('/edit/{id}',[ProductsController::class,'postEdit']);
        });
        Route::prefix('videos')->group(function()
        {
            Route::get('/list',[VideosController::class,'list']);
            Route::get('/add',[VideosController::class,'getAdd']);
            Route::post('/add',[VideosController::class,'postAdd']);
            Route::get('/edit/{id}',[VideosController::class,'getEdit']);
            Route::post('/edit/{id}',[VideosController::class,'postEdit']);
        });
        Route::prefix('profiles')->group(function()
        {
            Route::get('/list',[ProfilesController::class,'list']);
            Route::get('/add',[ProfilesController::class,'getAdd']);
            Route::post('/add',[ProfilesController::class,'postAdd']);
            Route::get('/edit/{id}',[ProfilesController::class,'getEdit']);
            Route::post('/edit/{id}',[ProfilesController::class,'postEdit']);
            Route::get('/delete/{id}',[ProfilesController::class,'getDelete']);
        });
        Route::prefix('charity')->group(function()
        {
            Route::get('/list',[CharityController::class,'list']);
            Route::get('/add',[CharityController::class,'getAdd']);
            Route::post('/add',[CharityController::class,'postAdd']);
            Route::get('/addvideo',[CharityController::class,'getAddVideo']);
            Route::post('/addvideo',[CharityController::class,'postAddVideo']);
            Route::get('/edit/{id}',[CharityController::class,'getEdit']);
            Route::post('/edit/{id}',[CharityController::class,'postEdit']);
            Route::get('/editvideo/{id}',[CharityController::class,'getEditVideo']);
            Route::post('/editvideo/{id}',[CharityController::class,'postEditVideo']);
            Route::get('/delete/{id}',[CharityController::class,'getDelete']);
            Route::get('/deletevideo/{id}',[CharityController::class,'getDeleteVideo']);
        });
        Route::prefix('logos')->group(function()
        {
            Route::get('/',[LogosController::class,'getEdit']);
            Route::post('/',[LogosController::class,'postEdit']);
        });
        Route::prefix('banners')->group(function()
        {
            Route::get('/',[BannersController::class,'getEdit']);
            Route::post('/',[BannersController::class,'postEdit']);
        });
        Route::prefix('footers')->group(function()
        {
            Route::get('/',[FootersController::class,'getEdit']);
            Route::post('/',[FootersController::class,'postEdit']);
        });
    });
});
Route::get('/', [PagesController::class, 'profile']);
Route::get('/products/{id}_{name}.html',[PagesController::class, 'products']);
Route::get('/charity.html',[PagesController::class, 'charity']);
Route::delete('ajax/delete_products/{id}',[ ProductsController::class, 'delete_products']);
Route::delete('ajax/deleteall_products',[ ProductsController::class, 'deleteall_products']);
Route::delete('ajax/delete_categories/{id}',[ CategoriesController::class, 'delete_categories']);
Route::delete('ajax/deleteall_categories',[ CategoriesController::class, 'deleteall_categories']);
Route::delete('ajax/delete_videos/{id}',[ VideosController::class, 'delete_videos']);
Route::delete('ajax/deleteall_videos',[ VideosController::class, 'deleteall_videos']);
Route::delete('ajax/delete_profiles/{id}',[ ProfilesController::class, 'delete_profiles']);
Route::delete('ajax/deleteall_profiles',[ ProfilesController::class, 'deleteall_profiles']);
Route::delete('ajax/delete_charity/{id}',[ CharityController::class, 'delete_charity']);
Route::delete('ajax/deleteall_charity',[ CharityController::class, 'deleteall_charity']);
Route::delete('ajax/delete_charity_videos/{id}',[ CharityController::class, 'delete_charity_videos']);
Route::delete('ajax/deleteall_charity_videos',[ CharityController::class, 'deleteall_charity_videos']);