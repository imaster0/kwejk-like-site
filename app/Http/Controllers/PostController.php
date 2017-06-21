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
			$this->createNewPost($path, $data);
    }


		//Nowy post jako obrazek .png
		private function createNewPost($path, array $data){
			//tworzymy pusty obrazek, dodajemy tło i ramkę na środek
			$img = \Image::canvas(768, 500, '#ffffff');
			$bg = \Image::make('imgs/template/post_text3.png')->fit(768, 500);
			$img->insert($bg, 'center');
			if(isset($data['image'])){
				$img2 = \Image::make($data['image'])->fit(768, 500);
				$ramka = \Image::make('imgs/template/post_text3p.png')->fit(768, 500);
				$img->insert($img2, 'center');
				$img->insert($ramka, 'center');
			}
			$img->save($path);  //zapisujemy na ścieżce $path
			//otwieramy poprzednio utworzony obrazek
			$im = imagecreatefrompng ($path);

			if(isset($data['image'])){
				//Topic - dodajemy temat
				$box = new Box($im);
				$box->setFontFace('fonts/arialbd.ttf'); // czcionka: pogrubiony Arial
				$box->setFontColor(new Color(255, 255, 255));
				$box->setBackgroundColor(new Color(0, 0, 0));
				$box->setFontSize(40);
				$box->setBox(50, 280, 768-100, 90);
				$box->setTextAlign('left', 'top');
				$box->draw($data["title"]);
				//Content - dodajemy treść
				$box = new Box($im);
				$box->setFontFace('fonts/arial.ttf'); 	// czcionka: zwykły Arial
				$box->setFontColor(new Color(255, 255, 255));
				$box->setBackgroundColor(new Color(0, 0, 0));
				$box->setFontSize(24);
				$box->setBox(50, 335, 768-100, 90);
				$box->setTextAlign('left', 'top');
				$box->draw($data["content"]);
			}
			else{
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
			}
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
