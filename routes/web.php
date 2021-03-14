<?php

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


Route::post('/forgetpswrd', 'AdminController@ressetpassword');
Route::get('/changepassword', 'AdminController@updatepassword');
Route::get('/ressetpswrd', 'AdminController@ressetpswdview');
Route::post('/changepassword', 'AdminController@postupdatepassword');



Route::get('/forget', 'AuthController@forgotPasswordView');
Route::post('/sendforget', 'AuthController@sendForgotPassword');

Route::get('/register', 'AuthController@register');
Route::post('/register', 'AuthController@postRegister');
Route::get('thank_you', function () {
    $data['title'] = 'Content Buddy | Thank You';
    return view('frontend.thank_you', $data);
});

Route::get('/forgotPassword', 'AuthController@forgotPasswordView');
Route::post('/forgotPassword', 'AuthController@sendForgotPassword');

//Route::get('/error_template', 'AuthController@errorTemplate');
//Route::get('/success_template', 'AuthController@errorSuccess');

Route::get('/reset_password/{id?}', 'AuthController@resetPasswordView');
Route::post('/reset_password', 'AuthController@postResetPassword');
Route::get('/verify_email/{id}', 'AuthController@verifyEmail');
Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => ['nocache','auth','AuthenticateUser']], function() {

    Route::get('/user_dashboard', 'UserController@dashboard');
    
    Route::get('/edit_profile', 'UserController@profileView');
    Route::post('/update_profile', 'UserController@updateProfile');
    
    Route::post('/user_add_item', 'UserController@addItem');
    Route::post('/user_edit_item', 'UserController@editItem');
    Route::post('/user_del_item', 'UserController@deleteItem');
    
    Route::get('/user_change_password', 'UserController@changePasswordView');
    Route::post('/user_change_password', 'UserController@changePassword');
    
    Route::get('/item_detail/{id}', 'UserController@itemDetail');
    Route::get('/details/{type}/{id}', 'UserController@ItemDetailView');
     
    Route::post('/add_item_label', 'UserController@addLabel');
    Route::post('/edit_label', 'UserController@editLabel');
    
    Route::post('/add_photos', 'UserController@addPhotos'); 
    Route::post('/upload_group_photos', 'UserController@uploadGroupPhoto'); 
    
    Route::post('/upload_item_photos', 'UserController@uploadItemPhoto'); 
    Route::post('/add_to_group', 'UserController@addToGroup');
    
    Route::get('/mange_group', 'UserController@mangeGroups');
    Route::post('/create_group', 'UserController@addGroup'); 
    Route::get  ('/mange_groups', 'UserController@manageGroups');
    
    
    Route::post('/delete_record', 'UserController@deleteRecord');
});



Route::group(['middleware' => ['nocache']], function() {
    //user web login
    Route::get('/login', 'AuthController@login');
    Route::post('/login', 'AuthController@postLogin');
    //Admin Login
    Route::get('/admin', 'AdminController@loginView');
    Route::get('/admin_login', 'AdminController@loginView');
    Route::get('/', 'AuthController@login');
    
});
Route::post('/admin_login', 'AdminController@adminLogin');
Route::post('/forgot_password', 'AdminController@postForgotPassword');


Route::group(['middleware' => ['nocache','admin']], function() {


    Route::get('dashboard', 'AdminController@dashboard');
    Route::get('change_password', 'AdminController@changePasswordView');
    Route::post('/change_password', 'AdminController@changePassword');

    Route::get('/profile', 'AdminController@profile');
    Route::post('/profile', 'AdminController@updateProfile');

    Route::get('/add_room/{room_id?}/{clone?}', 'AdminManagementController@addRoom');
    Route::post('/add_room', 'AdminManagementController@postRoom');
    Route::get('/manage_rooms', 'AdminManagementController@manageRooms');

    Route::get('/add_user/{user_id?}/{clone?}', 'AdminManagementController@addUser');
    Route::post('/add_user', 'AdminManagementController@postUser');
    
    Route::get('/edit_adjuster/{user_id}', 'AdminManagementController@editAdjuster');
    
    Route::get('/manage_users/{type?}', 'AdminManagementController@manageUsers');
//    Route::get('/user_items/{id}', 'AdminManagementController@userItems');

    Route::get('/manage_adjuster', 'AdminManagementController@manageAdjuster');

    Route::get('/add_item/{user_id?}/{item_id?}/{clone?}', 'AdminManagementController@addItems');
    Route::post('/add_item', 'AdminManagementController@postItems');
//    Route::get('/admin_delete_item/{user_id?}/{item_id?}', 'AdminManagementController@adminDeleteItem');
    Route::get('/manage_items/{id}', 'AdminManagementController@manageItems');
    Route::get('/view_item/{id}', 'AdminManagementController@viewItem');

    Route::get('/manage_photos', 'AdminManagementController@managePhotos');
    Route::get('/view_photos/{id}', 'AdminManagementController@viewPhotos');
    
    Route::get('/admin_label_view', 'AdminManagementController@LabelView');
    Route::post('/admin_add_label', 'AdminManagementController@submitLabel');
//    Route::get('/admin_edit_label', 'AdminManagementController@editLabelView');
//    Route::post('/admin_edit_label', 'AdminManagementController@addLabel');
    Route::get('/manage_labels/{id}', 'AdminManagementController@manageLabels');

    Route::get('/add_group/{id?}/{clone?}', 'AdminManagementController@addGroup');
    Route::post('/add_group', 'AdminManagementController@postGroup');
    Route::get('/view_group/{id}', 'AdminManagementController@viewGroup');
    Route::get('/manage_groups', 'AdminManagementController@manageGroup');

    Route::post('/download', 'AdminManagementController@downloadXlsFile');
//    Route::get('/download_xls/{id}', 'AdminManagementController@downloadXlsFile');

    Route::post('/approve_user', 'AdminManagementController@approveUser');
    Route::post('/block_user', 'AdminManagementController@blockUser');

    Route::post('/update_status', 'AdminManagementController@updateStatus');
    
    Route::get('/claim_my_content/{id}', 'AdminManagementController@claimContentMail');

    /*
     * Pages
     */
    Route::get('/about_us', 'AdminManagementController@aboutUs');
    Route::post('/about_us', 'AdminManagementController@postAboutUs');

    Route::get('/privacy_policy', 'AdminManagementController@privacyPolicy');
    Route::post('/privacy_policy', 'AdminManagementController@postprivacyPolicy');

    Route::get('/terms_condition', 'AdminManagementController@termsCondition');
    Route::post('/terms_condition', 'AdminManagementController@posttermsCondition');


    /*
     * Delete common routes
     */
    Route::post('/delete_item', 'AdminManagementController@deleteItem');
});

Route::get('admin_logout', function() {
    \Illuminate\Support\Facades\Auth::guard('admin')->logout();
    return redirect('admin');
});
Route::get('pdf_view', function() {
    return view('admin.pdf');
});
