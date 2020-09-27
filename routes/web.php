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

Route::get('/', 'HomeController@index')->name('home');

// Auth::routes(['verify' => true]);

// Route::get('activate-account', 'HomeController@notActivatedAccount')->name('account.notactived');

Route::get('/home', 'BookController@index')->name('dashboard');

// Book creation (allowed as guess)
Route::get('/books/wizard', 'WizardController@start')->name('books.wizard');
Route::post('/books/wizard', 'WizardController@generateBookFile')->name('books.generate');

Route::post('/books/update', 'BookController@update')->name('books.update');

Route::post('/sections/upload_images', 'SectionController@uploadSectionImages')->name('section.upload-images');
Route::post('/sections/delete_image', 'SectionController@deleteSectionImage')->name('section.delete-image');
Route::post('/books/sections/update', 'SectionController@updateSections')->name('sections.update');
Route::post('/sections/update', 'SectionController@updateSection')->name('section.update-section');
Route::post('/sections/delete', 'SectionController@deleteSection')->name('section.delete-section');
Route::post('/sections/load_library_content', 'SectionController@loadLibraryContent')->name('section.load-library-content');
Route::post('/sections/num_images', 'ProgressController@getSectionNumImages')->name('section.num-images');

Route::post('/preview/getContent', 'ContentController@getPreviewContent')->name('preview.content');
Route::get('/content/{id}', 'ContentController@getPreviewImage')->name('get.content');
Route::get('/content/{size}/{id}', 'ContentController@getImage')->name('get.content');
// Route::get('/content/{bookUid}/{section}/solutions/{id}', 'ContentController@getDatabaseSolutionsContent')->name('get.database-solutions-content');
// Route::get('/content/{bookUid}/{section}/{size}/{image}', 'ContentController@getContent')->name('get.content');
// Route::get('/content/{bookUid}/{section}/solutions/{size}/{image}', 'ContentController@getSolutionsContent')->name('get.solutions-content');
Route::get('/book/{bookUid}/{date}/{book}', 'BookController@download')->name('get.book');
Route::post('/book/clone', 'CloneController@cloneBook')->name('book.clone');

Route::get('/login', 'AuthenticationController@showLogin')
  ->name('login.form')
  ->middleware('guest');

Route::post('/login', 'AuthenticationController@login')
  ->name('login')
  ->middleware('guest');

Route::post('/logout', 'AuthenticationController@logout')
  ->name('logout');

Route::group(
  [
    'middleware' => ['auth', 'active.user']
  ],
  function () {
    // Books
    Route::get('/books', 'BookController@index')->name('books.index');
    Route::get('/books/{bookId}', 'BookController@edit')->name('books.edit');
    Route::delete('/books/{book}', 'BookController@destroy')->name('books.destroy');
  });


// Test routes: Should be deleted
Route::get('/s3', 'TestController@s3')->name('s3');
Route::get('/fopen', 'TestController@fopen')->name('fopen');
Route::get('/curl', 'TestController@curl')->name('curl');
Route::get('/referer', 'TestController@referer')->name('referer');
Route::get('/internal-referer', 'TestController@internalReferer')->name('internal-referer');
