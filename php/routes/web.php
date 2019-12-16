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

Auth::routes();

Route::resource('/', IndexController::class, ['only' => 'index']);

//類型
Route::group(['prefix' => 'category'], function() {
    Route::get('{category?}', ['uses' => 'CategoryController@index', 'as' => 'category.list']);
});

//產品
Route::group(['prefix' => 'product'], function() {
    Route::get('{id}', ['uses' => 'ProductController@index', 'as' => 'product.detail']);
});

//客服
Route::group(['prefix' => 'cs'], function() {
    Route::get('contact', ['uses' => 'CustomerServiceController@contact_form', 'as' => 'cs.contact']);
    Route::get('faqs', ['uses' => 'CustomerServiceController@faqs_list', 'as' => 'cs.faqs']);
});

//購物車
Route::group(['prefix' => 'cart'], function() {
    Route::get('/', ['uses' => 'CartController@showCart', 'as' => 'cart.show']);
    Route::post('add', ['uses' => 'CartController@addCart', 'as' => 'cart.add']);
});

//會員專區
Route::group(['prefix' => 'member'], function() {
    Route::get('/', ['uses' => 'MemberController@index', 'as' => 'member']);
    Route::get('info', ['uses' => 'MemberController@member_detail', 'as' => 'member.info.detail']);
    Route::get('wish', ['uses' => 'MemberController@wish_list', 'as' => 'member.wish.list']);
    Route::get('product', ['uses' => 'MemberController@product_list', 'as' => 'member.product.list']);
    Route::get('order', ['uses' => 'MemberController@order_list', 'as' => 'member.order.list']);
    Route::get('order/{id}/detail', ['uses' => 'MemberController@order_detail', 'as' => 'member.order.detail']);
});


//後台
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {

    #登出入
    Route::group(['middleware' => 'guest:admin'], function() {
        Route::get('login', ['uses' => 'AdminLoginController@showLoginForm', 'as' => 'admin.login.form']);
        Route::post('login', ['uses' => 'AdminLoginController@login', 'as' => 'admin.login']);
    });
    Route::post('logout', ['uses' => 'AdminLoginController@logout', 'as' => 'admin.logout']);


    #功能
    Route::group(['middleware' => 'auth:admin'], function() {
        Route::get('/', ['uses' => 'DashboardController@index', 'as' => 'admin.dashboard']);

        Route::group(['prefix' => 'account_setting'], function() {
            // Account (login account) manage
            Route::get('profile', ['uses' => 'AdminManageController@edit_profile', 'as' => 'admin.setting.profile.show']);
            Route::get('password', ['uses' => 'AdminManageController@edit_password', 'as' => 'admin.setting.password.edit']);
            Route::patch('password', ['uses' => 'AdminManageController@update_password', 'as' => 'admin.setting.password.update']);

            // Accounts manage
            Route::get('accounts', ['uses' => 'AdminManageController@show_accounts', 'as' => 'admin.setting.accounts.show']);
            Route::post('getAccountsData', ['uses' => 'AdminManageController@get_accounts', 'as' => 'admin.setting.accounts.data']);
            Route::get('account/create', ['uses' => 'AdminManageController@create_account', 'as' => 'admin.setting.account.create']);
            Route::post('account/create', ['uses' => 'AdminManageController@store_account', 'as' => 'admin.setting.account.store']);
            Route::get('account/{admin}/edit', ['uses' => 'AdminManageController@edit_account', 'as' => 'admin.setting.account.edit']);
            Route::patch('account/{admin}/edit', ['uses' => 'AdminManageController@update_account', 'as' => 'admin.setting.account.update']);

            // Role manage
            Route::get('roles', ['uses' => 'AdminManageController@show_roles', 'as' => 'admin.setting.roles.show']);
            Route::post('getRolesData', ['uses' => 'AdminManageController@get_roles', 'as' => 'admin.setting.roles.data']);
            Route::get('role/create', ['uses' => 'AdminManageController@role_create', 'as' => 'admin.setting.role.create']);
            Route::get('role/{role}/edit', ['uses' => 'AdminManageController@edit_role', 'as' => 'admin.setting.role.edit']);
            Route::patch('role/{role}/edit', ['uses' => 'AdminManageController@update_role', 'as' => 'admin.setting.role.update']);
        });
        
        Route::group(['prefix' => 'products'], function() {
            Route::get('/', ['uses' => 'ProductController@index', 'as' => 'admin.products.show']);
            Route::get('{product}/detail', ['uses' => 'ProductController@show', 'as' => 'admin.product.detail']);
            Route::patch('{product}/detail', ['uses' => 'ProductController@update', 'as' => 'admin.product.update']);
            Route::post('getProductsData', ['uses' => 'ProductController@getProductsData', 'as' => 'admin.products.data']);
        });

        Route::group(['prefix' => 'attachs'], function() {
            Route::get('{type}', ['uses' => 'AttachController@index', 'as' => 'admin.attachs.show']);
        });

        Route::group(['prefix' => 'users'], function() {
            Route::get('/', ['uses' => 'UserController@index', 'as' => 'admin.users.show']);
            Route::get('create', ['uses' => 'UserController@create', 'as' => 'admin.user.create']);
            Route::post('create', ['uses' => 'UserController@store', 'as' => 'admin.user.store']);
            Route::get('{user}/detail', ['uses' => 'UserController@edit', 'as' => 'admin.user.detail']);
            Route::get('{equip}/equip', ['uses' => 'UserController@edit_user_equip', 'as' => 'admin.user.equip']);
            Route::patch('{user}/detail', ['uses' => 'UserController@update', 'as' => 'admin.user.update']);
            Route::patch('{equip}/equip', ['uses' => 'UserController@update_equip', 'as' => 'admin.user.equip.update']);
            Route::post('getUsersData', ['uses' => 'UserController@getUsersData', 'as' => 'admin.users.data']);

            // get tabs content api
            Route::post('getUserOrders', ['uses' => 'UserController@getUserOrders', 'as' => 'admin.user.orders']);
            Route::post('getUserEquips', ['uses' => 'UserController@getUserEquips', 'as' => 'admin.user.equips']);
            Route::post('getUserHopes', ['uses' => 'UserController@getHopesData', 'as' => 'admin.user.hopes']);
            
            //helper city and dist/area data
            Route::get('getCitys', ['uses' => 'UserController@getCitysData', 'as' => 'admin.citys.data']);
            Route::get('getAreas', ['uses' => 'UserController@getAreasData', 'as' => 'admin.areas.data']);
        });

        Route::group(['prefix' => 'news'], function() {
            Route::get('/', ['uses' => 'NewsController@index', 'as' => 'admin.news.show']);
            Route::get('create', ['uses' => 'NewsController@create', 'as' => 'admin.news.create']);
            Route::post('create', ['uses' => 'NewsController@store', 'as' => 'admin.news.store']);
            Route::get('{news}/detail', ['uses' => 'NewsController@edit', 'as' => 'admin.news.detail']);
            Route::patch('{news}/detail', ['uses' => 'NewsController@update', 'as' => 'admin.news.update']);
            Route::post('getNewsData', ['uses' => 'NewsController@getNewsData', 'as' => 'admin.news.data']);
        });

        Route::group(['prefix' => 'orders'], function() {
            Route::get('/', ['uses' => 'OrderController@index', 'as' => 'admin.orders.show']);
            Route::get('create', ['uses' => 'OrderController@create', 'as' => 'admin.orders.create']);
            Route::post('create', ['uses' => 'OrderController@store', 'as' => 'admin.orders.store']);
            Route::get('{order}/detail', ['uses' => 'OrderController@edit', 'as' => 'admin.order.detail']);
            Route::get('{product}/detail', ['uses' => 'OrderController@edit', 'as' => 'admin.order.product']);
            Route::patch('{order}/detail', ['uses' => 'OrderController@update', 'as' => 'admin.order.update']);
            Route::post('getOrdersData', ['uses' => 'OrderController@getOrdersData', 'as' => 'admin.orders.data']);

            // get tabs content api
            Route::post('getOrderProducts', ['uses' => 'OrderController@getOrderProducts', 'as' => 'admin.order.products']);
        });

        Route::group(['prefix' => 'events'], function() {
            Route::get('/', ['uses' => 'EventController@index', 'as' => 'admin.events.show']);
            Route::get('create', ['uses' => 'EventController@create', 'as' => 'admin.event.create']);
            Route::post('create', ['uses' => 'EventController@store', 'as' => 'admin.event.store']);
            Route::get('{event}/detail', ['uses' => 'EventController@edit', 'as' => 'admin.event.detail']);
            Route::patch('{event}/detail', ['uses' => 'EventController@update', 'as' => 'admin.event.update']);
            Route::post('getEventsData', ['uses' => 'EventController@getEventsData', 'as' => 'admin.events.data']);

            //helper city and dist/area and products with ids data
            Route::get('getCategories', ['uses' => 'EventController@getCategoriesData', 'as' => 'admin.categories.data']);
            Route::get('getSubCategories', ['uses' => 'EventController@getSubCategoriesData', 'as' => 'admin.subCategories.data']);
            Route::get('getProduct/{categoryId}/{subCategoryId}', ['uses' => 'EventController@getProductsData', 'as' => 'admin.product.data']);
        });

        // Route::group(['prefix' => 'service'], function() {
        //     Route::get('/', ['uses' => 'ServiceController@index', 'as' => 'admin.services.show']);
        //     Route::get('create', ['uses' => 'ServiceController@create', 'as' => 'admin.service.create']);
        //     Route::post('create', ['uses' => 'ServiceController@store', 'as' => 'admin.service.store']);
        //     Route::get('{service}/detail', ['uses' => 'ServiceController@edit', 'as' => 'admin.service.detail']);
        //     Route::patch('{service}/detail', ['uses' => 'ServiceController@update', 'as' => 'admin.service.update']);
        //     Route::post('getServicesData', ['uses' => 'ServiceController@getServicesData', 'as' => 'admin.services.data']);
        // });
        
    });
});

// Route::get('/test', 'TestController@index');
// Route::middleware([
//     'web',
//     'auth:admin',
//     '\UniSharp\LaravelFilemanager\Middlewares\MultiUser',
//     '\UniSharp\LaravelFilemanager\Middlewares\CreateDefaultFolder'
//     ])->any('laravel-filemanager/upload', ['uses' => 'TestController@upload'])->name('unisharp.lfm.upload');
// Route::any('laravel-filemanager/upload', ['uses' => 'TestController@upload']);
// Route::get('/equip/{equip}', 'TestController@testRoute')->name('home');
// Route::get('/equip/{user}/user', 'TestController@testUser')->name('user');