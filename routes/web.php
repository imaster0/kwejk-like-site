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


//TEST roles
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
//-------------




Route::get('/q={tag?}', function($tag = 'all') {
	return view('mainpage', ['tag' =>$tag]);
});


Route::middleware(['auth'])->group(function(){
	//profil
	Route::get('/profil', function(){
		return view('profil.profil');
	});
	Route::get('/profil/ulubione', function(){
		$tag = 'all';
		return view('profil.ulubione', ['tag' => $tag]);
	});
	Route::get('/profil/pwchange', function(){
		return view('profil.change_password');
	});
	Route::get('/profil/emchange', function(){
		return view('profil.change_email');
	});
	// /dodaj
	Route::get('dodaj', function(){
		return view('dodaj');
	})->name('dodaj');
	// obsługa formularza dodawania posta
	Route::post('dodaj', 'PostController@add');
});


Route::get('/', function () {
	$tag = 'all';
    return view('mainpage', ['tag' =>$tag]);
});

// /poczekalnia
Route:: get('poczekalnia', function(){
	$tag = 'all';
	return view('poczekalnia', ['tag' => $tag]);
});


//LOGOWANIE, REJESTRACJA
Auth::routes();
