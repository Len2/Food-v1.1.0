<?php

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





Route::apiResource('address','AddressController');

Route::apiResource('albums','AlbumController');

Route::apiResource('category','CategoryController');

Route::apiResource('ordertask','OrderTasksController');

Route::apiResource('pages','PageController');

Route::apiResource('pagecategories','PageCategoryController');

Route::apiResource('pageusers','PageUserController');

Route::apiResource('products','ProductController');

Route::apiResource('tables','TableController');

Route::apiResource('tasklists','TaskListController');

Route::apiResource('invoices','InvoiceController');

Route::apiResource('reservations','ReservationController');

Route::apiResource('orderProducts','OrderProductsController');

Route::apiResource('userRole', 'UserRoleController');

Route::apiResource('role', 'RoleController');

Route::apiResource('pagerole', 'PageRoleController');

Route::apiResource('pagefollowers', 'PageFollowersController');

Route::apiResource('galleryImage', 'GalleryImageController');

Route::apiResource('user/likes', 'UserLikeController');



Route::apiResource('orders', 'OrderController');

Route::apiResource('offers', 'OfferController');


Route::post('/login', 'Api\Auth\LoginController@login');
Route::get('/refresh', 'Api\Auth\LoginController@refresh');
Route::get('/getUserRole','Api\UserRoleController@self');


Route::get('/user/reservation','Api\ReservationController@self');
Route::post('/user/reservation','Api\ReservationController@store');

Route::post('/signup',[
   'uses' => 'Api\Auth\UserController@signup'
]);
Route::post('/signin',[
    'uses' => 'Api\Auth\UserController@signin'
]);


Route::post('/tasks',[
    'uses' => 'TaskController@index',
    'middleware' => 'jwt.auth'
]);


