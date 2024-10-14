<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BrochureController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PaginasController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('blog.inicio');
// });

// Auth::routes();

//esto ayuda desactivar el registro de otros usuarios
Auth::routes(['register' => false]);
Route::get('/home', [LeadController::class, 'index'])->name('home');

Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    });


    //login
    Route::get('/product', [ProductController::class, 'index'])->name('products');
    Route::post('/product', [ProductController::class, 'store'])->name('create-product');
    Route::get('/product/{id}', [ProductController::class, 'productSelected']);

    Route::put('/update/product', [ProductController::class, 'update'])->name('update-product');
    Route::put('/enable/product', [ProductController::class, 'enable'])->name('enable-product');
    Route::delete('/product/{id}', [ProductController::class, 'destroyProduct'])->name('destroy-product');

    Route::post('/upload/image/product', [ProductController::class, 'uploadImageProduct']);

    Route::post('/image/product/disable', [ProductController::class, 'disableImageProduct']);
    Route::get('/selected/product/image/{id}', [ProductController::class, 'selectedImageProduct']);
    Route::put('/selected/product/image/{id}', [ProductController::class, 'selectedImageProduct']);
    Route::delete('/image/{id}',[ProductController::class,'destroyImage']);

    Route::post('/upload/service/product', [ProductController::class, 'storeInclude']);
    Route::post('/service/disable',[ProductController::class,'disableInclude']);

    Route::get('/selected/recommendation/{id}',[ProductController::class,'selectedRecommendation']);
    Route::post('/upload/recommendation/product',[ProductController::class, 'storeRecommendation']);

    Route::get('/selected/include/{id}',[ProductController::class,'selectedInclude']);

    Route::get('/selected/recommendation/{id}',[ProductController::class,'selectedRecommendation']);

    Route::delete('/recommendation/{id}', [ProductController::class, 'deleteRecommendation']);
    Route::delete('/service/{id}', [ProductController::class, 'destroyService']);


    Route::get('/brochures', [BrochureController::class, 'index'])->name('brochures');
    Route::post('/brochures', [BrochureController::class, 'store'])->name('create-brochure');
    Route::get('/brochure/{id}', [BrochureController::class, 'brochureSelected'])->name('selected-brochure');
    Route::put('/update/brochure', [BrochureController::class, 'update'])->name('update-brochure');
    Route::put('/enable/brochure', [BrochureController::class, 'enable'])->name('enable-brochure');
    Route::put('/disable/brochure', [BrochureController::class, 'disable'])->name('disable-brochure');
    Route::delete('/brochure/{id}', [BrochureController::class, 'destroyBrochure'])->name('destroy-brochure');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/category', [CategoryController::class, 'store'])->name('create-category');
    Route::get('/selected/category/{id}', [CategoryController::class, 'brochureSelected'])->name('selected-category');
    Route::put('/update/category', [CategoryController::class, 'update'])->name('update-category');
    Route::put('/enable/category', [CategoryController::class, 'enable'])->name('enable-category');
    Route::put('/disable/category', [CategoryController::class, 'disable'])->name('disable-category');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/user', [UserController::class, 'store'])->name('create-user');
    Route::get('/selected/user/{id}', [UserController::class, 'userSelected'])->name('selected-user');
    Route::put('/update/user', [UserController::class, 'update'])->name('update-user');
    Route::put('/enable/user/{id}', [UserController::class, 'enable'])->name('enable-user');
    Route::put('/disable/user/{id}', [UserController::class, 'disable'])->name('disable-user');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('destroy-user');
});

//user
Route::get('/', [PaginasController::class, 'inicio'])->name('inicio');
Route::get('/brochure', [PaginasController::class, 'brochure'])->name('brochure');
Route::get('/nosotros', [PaginasController::class, 'nosotros'])->name('nosotros');
Route::get('/preguntas', [PaginasController::class, 'preguntas'])->name('preguntas-frecuentes');
Route::get('/contactanos', [PaginasController::class, 'contactanos'])->name('contactanos');
// Route::get('/detalle/{id}',[PaginasController::class,'detalle'])->name('detalle');
Route::post('/contact', [PaginasController::class, 'sendEmail'])->name('contact.send');
Route::get('/leads', [LeadController::class, 'index'])->name('leads');
Route::post('/leads', [LeadController::class, 'store'])->name('create-lead');
Route::get('/productos/{id}',[PaginasController::class,'detalle'])->name('product');
