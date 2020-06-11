<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
});

Route::post('/signup',[
   'uses' => 'Api\ACL\LoginController@signup'
]);
Route::post('/signin',[
    'uses' => 'Api\ACL\LoginController@signin'
]);

Route::post('/registerPageOwner',[
    'uses' => 'Api\ACL\UserController@registerPageOwner'
]);

Route::group(['middleware' => ['assign.guard:user_pages']],function ()
{
    Route::post('/userpageLogin',[
        'uses' => 'Api\ACL\LoginController@signin'
    ]);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('/create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});


//Route::group(['middleware' => ['assign.guard:user_pages','jwt.auth']],function ()
//{
//
//});

Route::group(['middleware' => ['jwt.auth']], function() {

    Route::apiResource('users','Api\ACL\UserController');

    Route::apiResource('roles','Api\ACL\RoleController');

    Route::get('/permissions/{guard_name?}', [
        'uses' => 'Api\ACL\RoleController@showPermission',
    ]);

    Route::apiResource('pages','PageController');

    Route::post('/pay',[
        'uses' => 'PaymentController@postCheckout'
    ]);

    Route::apiResource('products','ProductController');

    Route::apiResource('category','CategoryController');

    Route::apiResource('galleryImages', 'GalleryImageController');

    Route::apiResource('address','AddressController');

    Route::apiResource('userPages','Api\ACL\UserPageController');

    Route::apiResource('task/lists','TaskListController');

    Route::apiResource('invoices','InvoiceController');

    Route::apiResource('reservations','ReservationController',['except' => ['store']]);

    Route::apiResource('orders', 'OrderController',['except' => ['store','destroy']]);

    Route::apiResource('carts', 'CartController',['except' => ['store','destroy']]);

    Route::apiResource('tasks','TaskController');

    //  Route::apiResource('pagefollowers', 'PageFollowersController');
    //  Route::apiResource('user/likes', 'UserLikeController');
    /*Route::group(['middleware' => ['role:Admin']], function () {
    });*/
});


