Route::get('sign/in', 'SessionsController@create');
Route::post('sign/in', 'SessionsController@store');
Route::get('sign/out', 'SessionsController@destroy');
