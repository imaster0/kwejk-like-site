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
            'title' => 'required|string|max:100',
            'content' => 'required|string|max:1000',
						'image' => 'image|mimes:jpg,jpeg,png',
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

		private function calculateText($font, $font_size, $img_width, $margin, $text){
			//explode text by words
			$text_a = explode(' ', $text);
			$text_new = '';
			foreach($text_a as $word){
			    //Create a new text, add the word, and calculate the parameters of the text
			    $box = imagettfbbox($font_size, 0, $font, $text_new.' '.$word);
			    //if the line fits to the specified img_width, then add the word with a space, if not then add word with new line
			    if($box[2] > $img_width - $margin*2){
			        $text_new .= "\n".$word;
			    } else {
			        $text_new .= " ".$word;
			    }
			}
			//trip spaces
			for($x = 1; $x <= 7; $x += 2) $box[$x] += $margin+$font_size;

			return array($box, trim($text_new));
		}


		//Nowy post jako obrazek .png
		private function createNewPost($path, array $data){

			if(isset($data["image"])){
				//obrazek pole: 768x432
				//obliczamy wielkość tekstu
				$content_size = 14 - strlen($data["content"])*(16-12)/1000;
				$title_size = 25 - strlen($data["title"])*(25-16)/100;
				//liczymy miejsce zajmowane przez tekst
				$calc_content = $this->calculateText('fonts/arial.ttf', $content_size, 768, 25, $data["content"]);
				$calc_title = $this->calculateText('fonts/arialbd.ttf', $title_size, 768, 25, $data["title"]);
				for($x = 1; $x <= 7; $x += 2) $calc_content[0][$x] += $calc_title[0][1];

				$pic_size = getimagesize($data["image"]->path());
				// width/height
				$wh = $pic_size[0]/$pic_size[1];
				$pic_width = 758;
				$pic_height = 758/$wh;

				for($x = 1; $x <= 7; $x += 2){
					$calc_title[0][$x] += $pic_height;
					$calc_content[0][$x] += $pic_height;
				}
				$post_height =  $calc_content[0][1] + 50;

				$img = imagecreatetruecolor(768, $post_height);

				$white_color = imagecolorallocate ($img, 255, 255, 255);
				$black_color = imagecolorallocate ($img, 0, 0, 0);

				//obrazek
				$extension = $data["image"]->extension();
				if($extension == "jpeg" || $extension == "jpg") $picture = imagecreatefromjpeg($data["image"]->path());
				else if($extension == "png") $picture = imagecreatefrompng($data["image"]->path());
				else{}

				imagecopyresized($img, $picture, (768-$pic_width)/2, 5, 0, 0, $pic_width, $pic_height, $pic_size[0], $pic_size[1]);


				//ramka
				$bg = imagefilledrectangle($img, 0, $pic_height, 768, $post_height, $white_color);
				$top_border = imagefilledrectangle($img, 0, 0, 768, 5, $black_color);
				$bottom_border = imagefilledrectangle($img, 0, $post_height-6, 768, $post_height, $black_color);
				$left_border= imagefilledrectangle($img, 0, 0, 5, $post_height, $black_color);
				$right_border= imagefilledrectangle($img, 762, 0, 768, $post_height, $black_color);

				//logo
				$logo = imagecreatefrompng("imgs/template/logo_post.png");
				imagecopy( $img , $logo , (768-112)/2, $post_height-27, 0, 0, 112, 27);

				//generowanie tekstu
				imagettftext ( $img, $title_size, 0, $calc_title[0][0] + 25, $calc_title[0][7]+36, $black_color, "fonts/arialbd.ttf", $calc_title[1]);
				imagettftext ( $img, $content_size, 0, $calc_content[0][0] + 25, $calc_content[0][7]+24, $black_color, "fonts/arial.ttf", $calc_content[1]);
				imagepng($img, $path);
				imagedestroy($img);
			}
			else{
				//obliczamy wielkość tekstu
				$content_size = 30 - strlen($data["content"])*(30-12)/1000;
				$title_size = 40 - strlen($data["title"])*(40-24)/100;
				//liczymy miejsce zajmowane przez tekst
				$calc_content = $this->calculateText('fonts/arial.ttf', $content_size, 768, 50, $data["content"]);
				$calc_title = $this->calculateText('fonts/arialbd.ttf', $title_size, 768, 50, $data["title"]);
				for($x = 1; $x <= 7; $x += 2) $calc_content[0][$x] += $calc_title[0][1];
				$post_height =  $calc_content[0][1] + 100;

				$img = imagecreatetruecolor(768, $post_height);

				$white_color = imagecolorallocate ($img, 255, 255, 255);
				$black_color = imagecolorallocate ($img, 0, 0, 0);

				//ramka
				$bg = imagefilledrectangle($img, 0, 0, 768, $post_height, $white_color);
				$top_border = imagefilledrectangle($img, 0, 0, 768, 5, $black_color);
				$bottom_border = imagefilledrectangle($img, 0, $post_height-6, 768, $post_height, $black_color);
				$left_border= imagefilledrectangle($img, 0, 0, 5, $post_height, $black_color);
				$right_border= imagefilledrectangle($img, 762, 0, 768, $post_height, $black_color);

				//logo
				$logo = imagecreatefrompng("imgs/template/logo_post.png");
				imagecopy( $img , $logo , (768-112)/2, $post_height-27, 0, 0, 112, 27);

				//generowanie tekstu
				imagettftext ( $img, $title_size, 0, $calc_title[0][0] + 50, $calc_title[0][7]+36, $black_color, "fonts/arialbd.ttf", $calc_title[1]);
				imagettftext ( $img, $content_size, 0, $calc_content[0][0] + 50, $calc_content[0][7]+24, $black_color, "fonts/arial.ttf", $calc_content[1]);
				imagepng($img, $path);
				imagedestroy($img);
			}
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
