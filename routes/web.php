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


//TEST

// usage inside a laravel route
Route::get('/test', function()
{
	$img = Image::make(storage_path()."/imgs/shittty.png");
	return $img->response('png');
});
///----------------------------



Route::get('/q={tag?}', function($tag = 'all') {
	return view('mainpage', ['tag' =>$tag]);
});



Route::get('/', function () {
	$tag = 'all';
    return view('mainpage', ['tag' =>$tag]);
});


Route::get('/users', function(){
	$users = App\User::all();
	foreach($users as $user){
		$roles =  $user->roles()->get();
		echo $user->username . ": ";
		foreach($roles as $role){
			echo $role->name . ", ";
		}
		echo "<br>";
	}

});

Route::get('dodaj', function(){
	return view('dodaj');
})->name('dodaj');

Route:: get('poczekalnia', function(){
	$tag = 'all';
	return view('poczekalnia', ['tag' => $tag]);
});

Route::post('dodaj', 'PostController@add');



//LOGOWANIE, REJESTRACJA
Auth::routes();
