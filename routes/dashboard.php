<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "dash" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);


Route::group(['middleware' => ['auth' ] , 'prefix' => 'Dash' , 'namespace' => 'Dash'] , function(){

    Route::get('/dashbord', 'HomeController@index')->name('home');

    Route::resource('/categories', 'categoriesController');

    Route::resource('/tags', 'tagController');

    Route::resource('posts', 'postController');

    Route::get('/posts-withtrashed', 'postController@withtrashed')->name('posts.withtrashed');

    Route::get('/trashed-posts','postController@trashed')->name('trashed.index');

    Route::get('/trashed-posts/{post}','postController@restore')->name('trashed.restore');

    Route::resource('comment', 'CommentController');

    Route::get('/users' , 'UserController@index')->name('users.index');
    Route::post('/users/{user}/make-admin' , 'UserController@makeAdmin')->name('users.make-admin');

    Route::get('/users/profile' , 'UserController@profile')->name('users.profile');
    Route::post('/users/update' , 'UserController@update')->name('users.update');

});


Route::group(['namespace' => 'Dash'] , function(){
    Route::get('/', 'BlogController@index')->name('blog');
    Route::get('/post/{post}', 'BlogController@show')->name('show.post');
    Route::get('/your-profile' , 'BlogController@showProfile')->name('prof')->middleware('auth');
    Route::get('/publisher-profile/{id}' , 'BlogController@publisherprofile')->name('publisher.profile');
});
