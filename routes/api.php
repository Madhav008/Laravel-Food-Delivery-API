<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RestaurantsController;
use App\Http\Controllers\UserController;
use App\Models\Checkout;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'auth:sanctum'], function () {
    //All secure URL's
    // Route::apiResource('articles', ArticleController::class);

    Route::get("user", [UserController::class, 'user']);
    Route::put("user", [UserController::class, 'update']);

    Route::post("imageUpload", [ImageController::class, 'upload']);
    // Route::apiResource('orderItem', OrderItemController::class);
    Route::apiResource('order', CheckoutController::class);
    Route::apiResource('favorite', FavoriteController::class);
    Route::apiResource("addtocart", CartController::class);

    Route::get("logout", [UserController::class, 'logout']);
});

Route::group(['prefix' => 'auth'], function () {
    // Register
    Route::post("/register", [UserController::class, 'register']);
    //Login
    Route::post("/login", [UserController::class, 'index']);
});

Route::apiResource('products', ProductsController::class);
Route::apiResource('restaurants', RestaurantsController::class);
Route::apiResource('category', CategoryController::class);
Route::get("/category/product/{id}", [CategoryController::class, 'showProductbyCategory']);
