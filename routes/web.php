<?php

use App\Http\Controllers\PhotosController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::get('/contactus', function () {
    return view('contactus');
});

Route::get('/areas', function () {
    return view('areas');
});

//project routes

Route::get('/projects', 'ProjectsController@Index');

Route::get('/projects/create', 'ProjectsController@Create');

Route::post('/projects/create', 'ProjectsController@Store');

Route::get('/projects/delete/{id}', 'ProjectsController@Delete');

Route::delete('/projects/delete', 'ProjectsController@Remove');

Route::get('/projects/edit/{id}', 'ProjectsController@Edit');

Route::post('/projects/edit', 'ProjectsController@Update');

Route::get('/projects/{id}', 'ProjectsController@Details');


//Album routes

Route::get('/areas', 'AlbumsController@Index')->name('AlbumIndex');

Route::get('/album/admin', 'AlbumsController@Admin')->name('AlbumAdmin');

Route::post('/album/store', 'AlbumsController@Store')->name('CreateAlbumFunc');

Route::get('/album/{id}', 'AlbumsController@Show')->name('AlbumDetails');

Route::post('/album/edit', 'AlbumsController@Update')->name('AlbumUpdate');

Route::get('/album/edit/{id}', 'AlbumsController@Edit')->name('AlbumEdit');

Route::get('/album/delete/{id}', 'AlbumsController@Delete')->name('AlbumDelete');

Route::delete('/album/delete', 'AlbumsController@Remove')->name('AlbumRemove');



//Photos routes

Route::get('/photo/add/{id}', 'PhotosController@Add');

Route::post('/photo/store', 'PhotosController@Store');

Route::post('/photo/{id}', 'PhotosController@Show');

Route::delete('/photo/delete', 'PhotosController@Delete');

//Data Entries routes

Route::get('/dataentry/create/{id}', 'ProjectsController@createEntry');

Route::post('/dataentry/store', 'ProjectsController@storeDataEntry');

Route::get('/dataentry/editentry/{id}', 'ProjectsController@editEntry');

Route::post('/dataentry/editentry/', 'ProjectsController@updateEntry');

Route::get('/dataentry/deleteentry/{id}', 'ProjectsController@deleteEntry');

Route::delete('/dataentry/deleteentry', 'ProjectsController@removeEntry');
