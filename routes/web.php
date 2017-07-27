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

Route::middleware(['auth'])->group(function(){
	//profil
	Route::get('/profil', function(){
		return view('profil.profil');
	});

	Route::get('/profil/moje', function(){
		return view('profil.moje');
	});

	Route::get('/profil/ulubione', function(){
		return view('profil.ulubione');
	});

	Route::get('/profil/pwchange', function(){
		return view('profil.change_password');
	});

	Route::post('/profil/pwchange', "PanelController@pwchange");

	Route::get('/profil/emchange', function(){
		return view('profil.change_email');
	});

	Route::post('/profil/emchange', "PanelController@emchange");

	// /dodaj
	Route::get('dodaj', function(){
		return view('dodaj');
	})->name('dodaj');
	// obsługa formularza dodawania posta
	Route::post('dodaj', 'PostController@add');

	Route::post('user/{option?}/{name?}', 'PostPanelController@GetOperation');
});


//--- podstrony z postami

// ALL
Route::get('/', function(){
	return view('mainpage');
});
// TOP
Route::get('top', function(){
	return view('top');
});
// POCZEKALNIA
Route:: get('poczekalnia', function(){
	return view('poczekalnia');
});



//LOGOWANIE, REJESTRACJA
Auth::routes();
