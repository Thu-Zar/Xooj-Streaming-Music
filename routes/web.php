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


Route::get('/backend', function () {
    return view('backend.dashboard');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/ajaxSong', 'AjaxController@songUpdate');
Route::post('/ajaxArtist', 'AjaxArtistController@artistUpdate');
Route::post('/ajaxAlbum', 'AjaxAlbumController@albumUpdate');
Route::post('/ajaxSongCount', 'AjaxSongCountController@countUpdate');


Route::resource('/index','IndexController');

Route::resource('/song','SongController');
Route::resource('/art','IndexArtistController');
Route::get('/songs/{id}','SongController@download')->name('songs.download');

Route::resource('/artist','ArtistController');
Route::get('/artists/{id}','ArtistController@search')->name('artists.search');
Route::get('/artistsearch/{id}','ArtistController@download')->name('artistsearch.download');

Route::resource('/genre','GenreController');

Route::resource('/album','AlbumController');
Route::get('/albums/{id}','AlbumController@search')->name('albums.search');
Route::get('/albumsearch/{id}','AlbumController@download')->name('albumsearch.download');

Route::resource('/favourite','FavouriteControlle');
Route::get('/search', 'SearchController@search');
Route::post('/searches', 'SearchdatabaeController@searches')->name('searches');
Route::post('/searchartist', 'SearchdatabaeController@searchartists')->name('searchartists');
Route::post('/searchalbum', 'SearchdatabaeController@searchalbums')->name('searchalbums');	


