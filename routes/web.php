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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('activate-account', 'HomeController@notActivatedAccount')->name('account.notactived');

Route::get('/home', 'BookController@index')->name('dashboard');

// Book creation (allowed as guess)
Route::get('/books/wizard', 'WizardController@start')->name('books.wizard');
Route::post('/books/wizard', 'WizardController@generateBookFile')->name('books.generate');

Route::post('/sections/upload_images', 'SectionController@uploadSectionImages')->name('section.upload-images');
Route::post('/sections/delete_image', 'SectionController@deleteSectionImage')->name('section.delete-image');

Route::post('/preview/getContent', 'ContentController@getPreviewContent')->name('preview.content');
Route::get('/content/{bookUid}/{section}/{size}/{image}', 'ContentController@getContent')->name('get.content');
Route::get('/content/{bookUid}/{section}/solutions/{size}/{image}', 'ContentController@getSolutionsContent')->name('get.solutions-content');
Route::get('/book/{bookUid}/{date}/{book}', 'BookController@download')->name('get.book');

Route::group(
  [
    'middleware' => ['verified', 'active.user']
  ],
  function () {
    // Books
    Route::get('/books', 'BookController@index')->name('books.index');
    Route::get('/books/{bookId}', 'BookController@edit')->name('books.edit');
    Route::delete('/books/{book}', 'BookController@destroy')->name('books.destroy');
  });
