<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

/*
* Books endpoints.
*/
Route::get('books', ['middleware' => 'oauth',
    'uses' => 'BookController@getAll']);
Route::get('books/{id}', ['middleware' => 'oauth',
    'uses' => 'BookController@get']);

/*
* Borrowed books endpoints.
*/
Route::post('borrowed-books', ['middleware' => 'oauth',
    'uses' => 'BorrowedBookController@borrow']);
Route::get('borrowed-books', ['middleware' => 'oauth',
    'uses' => 'BorrowedBookController@get']);
Route::put('borrowed-books/{id}/return', ['middleware' => 'oauth',
    'uses' => 'BorrowedBookController@returnBook']);

/*
* Sales endpoints.
*/
Route::post('sales', ['middleware' => 'oauth',
    'uses' => 'SalesController@buy']);
Route::get('sales', ['middleware' => 'oauth',
    'uses' => 'SalesController@getAll']);
Route::get('sales/{id}', ['middleware' => 'oauth',
    'uses' => 'SalesController@get']);