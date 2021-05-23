<?php

use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\SupplierController;
use App\Models\QuarantineWastage;
use Illuminate\Http\Request;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers\API')->group(function () {

    Route::apiResource('products', 'ProductController');
    Route::apiResource('categories', 'CategoryController');
    Route::apiResource('suppliers','SupplierController');
    Route::apiResource('buyers', 'BuyerController');
    Route::get('products/supplier/{supplierId}', 'ProductController@getProductsBySupplierId');
    Route::get('products/categories/{categoryId}', 'ProductController@getProductsByCategoryId');
    Route::apiResource('volumetricvalue', 'VolumetricCheckController');
    Route::apiResource('supplier-orders', 'SupplierOrderController');
    Route::get('supplier-orders/invoice/{id}', 'SupplierOrderController@getSupplierInvoice');
    Route::apiResource('supplier-order-details', 'SupplierOrderDetailController');
    Route::apiResource('suppliersDeliveryDetails', 'SupplierDeliveryDetailsController');
    Route::apiResource('volumetricValue', 'VolumetricCheckController');
    Route::apiResource('payment-options', 'PaymentOptionController');
    Route::apiResource('orders','OrderController');
    Route::apiResource('wastages','WastageController');
    
    Route::get('getsupplier/{productid}', 'SupplierController@getSupplierByProductId');
    Route::apiResource('cost', 'VolumetricCheckController');
    Route::apiResource('buyer-order', 'BuyerOrderController');
    Route::apiResource('buyer-order-details', 'BuyerOrderDetailController');

    //Admin Routes start here
    Route::group(['middleware' => ['auth:api', 'role:admin']], function () {
    Route::apiResource('users', 'UsersManagementController');
    
    });
     //Admin Routes end here
    
    //Registration and authentication routes
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'RegisterController@login');
    
});



