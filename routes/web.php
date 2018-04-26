<?php
/**
 * Misc. pages
 */
Route::get('/', 'PageController@welcome');
Route::get('/about', 'PageController@about');
Route::get('/contact', 'PageController@contact');


/**
 * Books
 */
# CREATE
# Show the form to add a new book
Route::get('/books/create', 'BookController@create');

# Process the form to add a new book
Route::post('/books', 'BookController@store');

# READ
# Show a listing of all the books
Route::get('/books', 'BookController@index');

# Show an individual book
Route::get('/books/{id}', 'BookController@show');

# UPDATE
# Show the form to edit a specific book
Route::get('/books/{id}/edit', 'BookController@edit');

# Process the form to edit a specific book
Route::put('/books/{id}', 'BookController@update');

# DELETE
# Show the page to confirm deletion of a book
Route::get('/books/{id}/delete', 'BookController@delete');

# Process the deletion of a book
Route::delete('/books/{id}', 'BookController@destroy');

# MISC
# Search books
# TODO: Update to query database instead of books.json file
Route::get('/books/search', 'BookController@search');


/**
 * Practice
 */
Route::any('/practice/{n?}', 'PracticeController@index');


/**
 * Example routes shown at the end of Week 6 and Week 8 lectures
 */
Route::get('/trivia', 'TriviaController@index');
Route::get('/trivia/result', 'TriviaController@result');
