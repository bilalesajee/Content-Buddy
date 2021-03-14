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

// to be moved under an Auth Middleware ---- Test Stage
Route::post('/read', 'AdminManagementController@readPostXlsx');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'middleware' => ['headersmid', 'checkAppKey']], function () {

    Route::post('/register', 'ApiAuthController@postRegister');
    Route::post('/check_email', 'ApiAuthController@checkEmail');
    Route::post('/login', 'ApiAuthController@postLogin');
    Route::post('/forgetpassword', 'ApiAuthController@forgetPasswordMail');


    Route::group(['middleware' => ['checkSession']], function () {

        Route::get('/all_rooms', 'ApiController@allRooms');
        Route::get('/all_items', 'ApiController@allItems');
        Route::get('/all_groups', 'ApiController@allGroups');
        Route::get('/all_photos', 'ApiController@allPhotos');
        Route::get('/all_non_group_photos', 'ApiController@allNonGroupPhotos');
        Route::get('/all_multi_label_phoos', 'ApiController@allMultiLabelPhotos');
        
        Route::post('/add_item', 'ApiController@addItem');
        Route::get('/item_detail/{id}', 'ApiController@itemDetail');
        Route::post('/edit_item', 'ApiController@editItem');
        Route::post('/delete_item', 'ApiController@deleteItem');
        Route::post('/delete_item_content', 'ApiController@deleteItemContent');
        
        Route::post('/update_profile', 'ApiController@updateProfile');
        
        Route::post('/add_photo', 'ApiController@addPhoto');
        Route::get('/photo_detail/{id}', 'ApiController@photoDetail');
        Route::post('/add_multi_label_photo', 'ApiController@addMultiLabelPhoto');
        
        
        Route::post('/add_label', 'ApiController@addLabel');
        Route::post('/add_label_only', 'ApiController@addLabelOnly');
        Route::post('/edit_label', 'ApiController@editLabel');
        Route::post('/delete_label', 'ApiController@deleteLabel');
        
        Route::post('/craete_group', 'ApiController@createGroup');
        Route::post('/add_group_photos', 'ApiController@addGroupPhotos');
        Route::post('/move_group_photos', 'ApiController@moveGroupPhotos');
        Route::get('/group_detail/{id}', 'ApiController@groupDetail');
        Route::post('/update_group', 'ApiController@updateGroup');
        Route::post('/delete_group', 'ApiController@deleteGroup');
        
        Route::post('/search', 'ApiController@seacrh');
        
        Route::post('/change_password', 'ApiController@changePassword');
        Route::post('/claim_content', 'ApiController@claimContentMail');
        Route::post('/logout', 'ApiAuthController@logout');
    });
});
