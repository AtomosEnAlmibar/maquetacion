<?php

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
Route::group(['prefix' => 'admin'], function () {

    Route::get('/menus/item/index/{language?}/{item?}', 'App\Http\Controllers\Admin\MenuItemController@index')->name('menus_item_index');
    Route::get('/menus/item/create/{language?}', 'App\Http\Controllers\Admin\MenuItemController@create')->name('menus_item_create');
    Route::delete('/menus/item/delete/{item?}', 'App\Http\Controllers\Admin\MenuItemController@destroy')->name('menus_item_destroy');
    Route::get('/menus/item/edit/{item?}', 'App\Http\Controllers\Admin\MenuItemController@edit')->name('menus_item_edit');
    Route::post('/menus/item/store', 'App\Http\Controllers\Admin\MenuItemController@store')->name('menus_item_store'); 
    Route::post('/menus/item/reordermenu', 'App\Http\Controllers\Admin\MenuItemController@orderItem')->name('menus_reorder');
    
    Route::resource('menus', 'App\Http\Controllers\Admin\MenuController', [
        'names' => [
            'index' => 'menus',
            'create' => 'menus_create',
            'store' => 'menus_store',
            'destroy' => 'menus_destroy',
            'edit' => 'menus_edit',
        ]
    ]);

    Route::get('/image/delete/{image?}', 'App\Vendor\Image\Image@destroy')->name('delete_image');
    Route::get('/image/temporal/{image?}', 'App\Vendor\Image\Image@showTemporal')->name('show_temporal_image_seo');
    Route::get('/image/{image}', 'App\Vendor\Image\Image@show')->name('show_image_seo');
    Route::post('/image/seo', 'App\Vendor\Image\Image@storeSeo')->name('store_image_seo');

    Route::get('/tags/import', 'App\Http\Controllers\Admin\LocaleTagController@importTags')->name('tags_import');
    Route::get('/tags/{group}/{key}', 'App\Http\Controllers\Admin\LocaleTagController@edit')->name('tags_edit');
    Route::get('/tags', 'App\Http\Controllers\Admin\LocaleTagController@destroy')->name('tags_destroy');
    Route::get('/tags', 'App\Http\Controllers\Admin\LocaleTagController@index')->name('tags');
    Route::post('/tags', 'App\Http\Controllers\Admin\LocaleTagController@store')->name('tags_store');

    Route::resource('leechs', 'App\Http\Controllers\Admin\LeechController', [
        'names' => [
            'index' => 'leechs',
            'create' => 'leechs_create',
            'store' => 'leechs_store',
            'destroy' => 'leechs_destroy',
            'show' => 'leechs_show',
        ]
    ]);

    Route::get('/sliders/filter/{filters?}', 'App\Http\Controllers\Admin\SliderController@filter')->name('sliders_filter');
    Route::resource('sliders', 'App\Http\Controllers\Admin\SliderController', [
        'names' => [
            'index' => 'sliders',
            'create' => 'sliders_create',
            'edit' => 'sliders_edit',
            'store' => 'sliders_store',
            'destroy' => 'sliders_destroy',
            'show' => 'sliders_show',
        ]
    ]);

    Route::resource('contactos', 'App\Http\Controllers\Admin\ContactController', [
        'parameters' => [
            'contactos' => 'contact', 
        ],
        'names' => [
            'index' => 'contacts',
            'create' => 'contacts_create',
            'store' => 'contacts_store',
            'destroy' => 'contacts_destroy',
            'edit' => 'contacts_edit',
        ]
    ]);

    Route::resource('faqs/categorias', 'App\Http\Controllers\Admin\FaqCategoryController', [
        'parameters' => [
            'categorias' => 'faq_category', 
        ],
        'names' => [
            'index' => 'faq_categories',
            'create' => 'faq_categories_create',
            'edit' => 'faq_categories_edit',
            'store' => 'faq_categories_store',
            'destroy' => 'faq_categories_destroy',
            'show' => 'faq_categories_show',
        ]
    ]);

    Route::get('/faqs/filter/{filters?}', 'App\Http\Controllers\Admin\FaqController@filter')->name('faqs_filter');

    //Route::get('/faqs/json', 'App\Http\Controllers\Admin\FaqController@indexJson')->name('faqs_json');
    Route::resource('faqs', 'App\Http\Controllers\Admin\FaqController', [
        'names' => [
            'index' => 'faqs',
            'create' => 'faqs_create',
            'store' => 'faqs_store',
            'destroy' => 'faqs_destroy',
            'show' => 'faqs_show',
        ]
    ]);   
    
    Route::resource('usuarios', 'App\Http\Controllers\Admin\UserController', [
        'parameters' => [
            'usuarios' => 'user', 
        ],
        'names' => [
            'index' => 'users',
            'create' => 'users_create',
            'store' => 'users_store',
            'destroy' => 'users_destroy',
            'show' => 'users_show',
        ]
    ]);

    Route::resource('clientes', 'App\Http\Controllers\Admin\ClientController', [
        'parameters' => [
            'clientes' => 'client', 
        ],
        'names' => [
            'index' => 'clients',
            'create' => 'clients_create',
            'edit' => 'clients_edit',
            'store' => 'clients_store',
            'destroy' => 'clients_destroy',
            'show' => 'clients_show',
        ]
    ]);

    Route::resource('direcciones', 'App\Http\Controllers\Admin\DirectionController', [
        'parameters' => [
            'direcciones' => 'direction', 
        ],
        'names' => [
            'index' => 'directions',
            'create' => 'directions_create',
            'edit' => 'directions_edit',
            'store' => 'directions_store',
            'destroy' => 'directions_destroy',
            'show' => 'directions_show',
        ]
    ]);
});

Route::post('/fingerprint', 'App\Http\Controllers\Front\FingerprintController@store')->name('front_fingerprint');

Route::get('/faqs','App\Http\Controllers\Front\FaqController@index');
Route::get('/shop','App\Http\Controllers\Front\ShopController@index');
Route::get('/shop/product','App\Http\Controllers\Front\ProductController@index');

Route::get('/login', 'App\Http\Controllers\Front\LoginController@index')->name('front_login');
Route::post('/login', 'App\Http\Controllers\Front\LoginController@login')->name('front_login_submit');