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

Route::get('/', 'HomeController@index')->name('mainhome');


Route::get('posts', 'PostController@index')->name('post.index');
Route::get('post/{slug}', 'PostController@details')->name('post.details');

Route::get('/category/{slug}', 'PostController@postByCategory')->name('category.posts');
Route::get('/tag/{slug}', 'PostController@postByTag')->name('tag.posts');

Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');

Route::get('/search', 'SearchController@search')->name('search');

Route::get('/migrate', function () {
    try{
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }catch(Exception $ex){
        return $ex->getMessage();
    }
    return "OK";
});

Auth::routes();


Route::group(['middleware' => ['auth']], function () {

    Route::post('comment/{post}', 'CommentController@store')->name('comment.store');
});


Route::group(
    ['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']],
    function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('settings', 'SettingsController@index')->name('settings');
        Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
        Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

        Route::resource('tag', 'TagController');
        Route::resource('category', 'CategoryController');
        Route::resource('post', 'PostController');
        Route::resource('plugin', 'PluginController');

        Route::get('pending/post', 'PostController@pending')->name('post.pending');
        Route::put('post/{id}/approve', 'PostController@approval')->name('post.approve');

        Route::get('pending/plugin', 'PluginController@pending')->name('plugin.pending');
        Route::put('plugin/{id}/approve', 'PluginController@approval')->name('plugin.approve');

        Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');

        Route::get('/subscriber', 'SubscriberController@index')->name('subscriber.index');
        Route::delete('/subscriber/{subscriber}', 'SubscriberController@destroy')->name('subscriber.destroy');

        Route::get('comments/', 'CommentController@index')->name('comment.index');
        Route::delete('comments/{id}', 'CommentController@destroy')->name('comment.destroy');

        Route::get('author', 'AuthorController@index')->name('author.index');
        Route::delete('author/{id}', 'AuthorController@destroy')->name('author.destroy');
        
        Route::get('dev', 'DevController@index')->name('dev.index');
        Route::delete('dev/{id}', 'DevController@destroy')->name('dev.destroy');

        
    }
);
Route::group(['prefix' => 'artisan'],function(){
            
    Route::get('/migrate', function () {
        Artisan::call('migrate');
        Artisan::call('db:seed');
        
    });
    
    Route::get('/storagelink', function () {
        Artisan::call('storage:link');
        return "OK";
    });
});

Route::group(
    ['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']],
    function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('settings', 'SettingsController@index')->name('settings');
        Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
        Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

        Route::resource('post', 'PostController');



        Route::get('comments/', 'CommentController@index')->name('comment.index');
        Route::delete('comments/{id}', 'CommentController@destroy')->name('comment.destroy');
    }
);

Route::group(
    ['as' => 'dev.', 'prefix' => 'dev', 'namespace' => 'Dev', 'middleware' => ['auth', 'dev']],
    function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('settings', 'SettingsController@index')->name('settings');
        Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
        Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

        Route::resource('post', 'PostController');
        Route::resource('plugin', 'PluginController');


        Route::get('comments/', 'CommentController@index')->name('comment.index');
        Route::delete('comments/{id}', 'CommentController@destroy')->name('comment.destroy');
    }
);


View::composer('layouts.frontend.partial.footer', function ($view) {
    $categories = App\Category::all();
    $view->with('categories', $categories);
});
