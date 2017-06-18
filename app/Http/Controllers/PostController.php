<?php

namespace App\Http\Controllers;

use App\GDText\Box;
use App\GDText\Color;

use App\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class PostController extends Controller{

	  // Dodawanie nowego posta
		public function add(Request $request){
			// sprawdzanie, czy podano tytuł i treść
			$this->validator($request->all())->validate();
			// tworzenie
			$this->create($request->all());
			// dodawanie tagów, jeśli są użyte
			if(!empty($request->tagi)) $this->addTags($request->tagi);
			//powrót do strony głównej
			return redirect('/');
		}

		// Sprawdzanie posta
	  protected function validator(array $data){
        return Validator::make($data, [
            'title' => 'required|string|max:50',
            'content' => 'required|string|max:600',
        ]);
    }

		// Tworzenie posta w bazie
    protected function create(array $data){
			//nowy post zapisujemy w bazie, bez ścieżki pliku
			$posted = new Post();
			$posted->user_id = \Auth::user()->id;
			$posted->path = "";
			$posted->save();
			//wygenerowany post dostaje id, którym nazwiemy nowy plik
			$path = 'imgs/posts/' . $posted->id . '.png';
			$posted->path = $path;
			$posted->save(); //zapisujemy jeszcze raz
			//tworzymy nowy post (jako obrazek .png)
			createNewPost($path);
    }

		//Nowy post jako obrazek .png
		protected function createNewPost(){
			//tworzymy pusty obrazek, dodajemy tło i ramkę na środek
			$img = \Image::canvas(768, 500, '#ffffff');
			$bg = \Image::make('imgs/template/post_text2.png')->resize(768, 500);
			$img->insert($bg, 'center');
			$img->save($path);  //zapisujemy na ścieżce $path
			//otwieramy poprzednio utworzony obrazek
			$im = imagecreatefrompng ($path);
			//Topic - dodajemy temat
			$box = new Box($im);
			$box->setFontFace('fonts/arialbd.ttf'); // czcionka: pogrubiony Arial
			$box->setFontColor(new Color(0, 0, 0));
			$box->setFontSize(40);
			$box->setBox(50, 50, 768-100, 90);
			$box->setTextAlign('left', 'top');
			$box->draw($data["title"]);
			//Content - dodajemy treść
			$box = new Box($im);
			$box->setFontFace('fonts/arial.ttf'); 	// czcionka: zwykły Arial
			$box->setFontColor(new Color(0, 0, 0));
			$box->setFontSize(24);
			$box->setBox(50, 100, 768-100, 500-200);
			$box->setTextAlign('center', 'center');
			$box->draw($data["content"]);
			imagepng($im, $path); //zapisanie na ścieżce $path
		}

		//Dodawanie tagów do posta
		protected function addTags(array $data){
			foreach($data as $d){
				\DB::table('post_tag')->insert([
					'post_id' => Post::all()->last()->id,
					'tag_id' => \App\Tag::where('name', $d)->first()->id,
				]);
			}
		}
}
