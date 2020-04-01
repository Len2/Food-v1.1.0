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

//Simple User Route
Route::post('/signup',[
   'uses' => 'Api\ACL\LoginController@signup'
]);
Route::post('/signin',[
    'uses' => 'Api\ACL\LoginController@signin'
]);

//Route::get('/pageOwnerRegister',[
//    'uses' => 'Api\ACL\UserController@getIDPageOwner'
//]);

Route::post('/registerPageOwner',[
    'uses' => 'Api\ACL\UserController@registerPageOwner'
]);


Route::group(['middleware' => ['jwt.auth']], function() {
    Route::apiResource('users','Api\ACL\UserController');

    Route::apiResource('roles','Api\ACL\RoleController');

    Route::apiResource('pages','PageController');  //,['except' => ['update']]


    Route::apiResource('products','ProductController');

    Route::apiResource('category','CategoryController');

    Route::apiResource('galleryImages', 'GalleryImageController');


//    Route::apiResource('address','AddressController');
//
//    Route::apiResource('albums','AlbumController');
//


//
//    Route::apiResource('ordertask','OrderTasksController');
//
//    Route::apiResource('pagecategories','PageCategoryController');
//
//    Route::apiResource('pageusers','PageUserController');
//

//
//    Route::apiResource('tables','TableController');
//
//    Route::apiResource('tasklists','TaskListController');
//
//    Route::apiResource('invoices','InvoiceController');
//
//    Route::apiResource('reservations','ReservationController');
//
//    Route::apiResource('orderProducts','OrderProductsController');
//
//    Route::apiResource('pagerole', 'PageRoleController');
//
//    Route::apiResource('pagefollowers', 'PageFollowersController');
//

//
//    Route::apiResource('user/likes', 'UserLikeController');



//    Route::apiResource('orders', 'OrderController');
//
//    Route::apiResource('offers', 'OfferController');



   // Route::apiResource('tasks','TaskController');

    /*Route::group(['middleware' => ['role:Admin']], function () {
    });*/
});

/*Route::group(['middleware' => ['auth:api']], function() {

  });*/


