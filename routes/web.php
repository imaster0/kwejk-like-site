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

Route::middleware('auth')->group(function(){
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
	
	Route::get('/profil/delete', function(){
			return view('profil.delete');
	});
	Route::post('/profil/delete', "PanelController@delete");

	// /dodaj
	Route::get('dodaj', function(){
		return view('dodaj');
	})->name('dodaj');

	// obsługa formularza dodawania posta
	Route::post('dodaj', 'PostController@add');

	Route::post('user/{option?}/{name?}', 'PostPanelController@GetOperation');


	Route::get('ver/{id?}', 'AdminPanel@verify')->middleware('role:admin');
	Route::get('del/{id?}', 'AdminPanel@delete')->middleware('role:admin');
	Route::get('profil/users', function(){
		return view('profil.users');
	})->middleware('role:admin');
	Route::post('profil/users', 'AdminPanel@update')->middleware('role:admin');

	Route::post('on/{id?}', 'CommentController@addNew');
});

Route::get('on/{id?}', function($id){
	return view("on", ["postid" => $id]);
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
Route::get('poczekalnia', function(){
	return view('poczekalnia');
});



//LOGOWANIE, REJESTRACJA
Auth::routes();

Route::get('layout/noexist', function(){
	return view('layout.noexist');
});

Route::get('{sth?}', function($sth=null){
	return view("layout.noexist");
})->where('sth', '.*');
