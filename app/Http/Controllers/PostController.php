<?php

namespace App\Http\Controllers;

use DateTime;
use App\GDText\Box;
use App\GDText\Color;

use App\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class PostController extends Controller{

	  // Dodawanie nowego posta
		public function add(Request $request){

			$dt = new DateTime();
		$diff = date_create_from_format('Y-m-d H:i:s', $dt->format('Y-m-d H:i:s'))->getTimestamp() - date_create_from_format('Y-m-d H:i:s', \Auth::User()->last_post)->getTimestamp();

		if($diff < 120){
			return redirect('/dodaj')->with('mess','Możesz dodawać posta raz na 2 min! Pozostało '. (120 - $diff) . ' sekund');
		}


			\Auth::User()->last_post = $dt;
			\Auth::User()->save();
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
            'title' => 'nullable|string|max:100',
            'content' => 'nullable|string|max:1000',
						'image' => 'image|mimes:jpg,jpeg,png',
        ]);
    }

		// Tworzenie posta w bazie
    protected function create(array $data){
			//nowy post zapisujemy w bazie, bez ścieżki pliku
			$posted = new Post();
			$posted->user_id = \Auth::user()->id;
			$posted->path = "";
			$posted->title = htmlspecialchars($data["title"]);
			$posted->description = htmlspecialchars($data["content"]);
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
			$post_width = 678;
			if(isset($data["image"])){
				//obrazek pole: szer $post_width // nowy: szer 555px
				//obliczamy wielkość tekstu
				//zeruj


				$title_size = $content_size = 0;

				for($x = 1; $x <= 7; $x++){
					$calc_content[0][$x] = 0;
					$calc_title[0][$x] = 0;
				}
				if(isset($data["content"])) $content_size = 14 - strlen($data["content"])*(16-12)/1000;
				if(isset($data["title"])) $title_size = 25 - strlen($data["title"])*(25-16)/100;
				//liczymy miejsce zajmowane przez tekst
				if(isset($data["content"])) $calc_content = $this->calculateText('fonts/arial.ttf', $content_size, $post_width, 25, $data["content"]);
				if(isset($data["title"]))  $calc_title = $this->calculateText('fonts/arialbd.ttf', $title_size, $post_width, 25, $data["title"]);
				for($x = 1; $x <= 7; $x += 2) $calc_content[0][$x] += $calc_title[0][1];

				$pic_size = getimagesize($data["image"]->path());
				// width/height
				$wh = $pic_size[0]/$pic_size[1];
				$pic_width = ($post_width - 10);
				$pic_height = $pic_width/$wh;

				// if($pic_width > $pic_size[0]){
				// 	$pic_width = $pic_size[0];
				// 	$pic_height = $pic_size[1];
				// }

				for($x = 1; $x <= 7; $x += 2){
					$calc_title[0][$x] += $pic_height;
					$calc_content[0][$x] += $pic_height;
				}

				$post_height =  $calc_content[0][1];
				if($title_size > 0 || $content_size > 0)$post_height =  $calc_content[0][1] + 50;
				$post_height += 27;

				$img = imagecreatetruecolor($post_width, $post_height);

				$white_color = imagecolorallocate ($img, 255, 255, 255);
				$grey_color = imagecolorallocate ($img, 100, 100, 100);
				$black_color = imagecolorallocate ($img, 0, 0, 0);


				//obrazek
				$extension = $data["image"]->extension();
				if($extension == "jpeg" || $extension == "jpg") $picture = imagecreatefromjpeg($data["image"]->path());
				else if($extension == "png") $picture = imagecreatefrompng($data["image"]->path());
				else{ return;}


				imagecopyresized($img, $picture, ($post_width-$pic_width)/2, 5, 0, 0, $pic_width, $pic_height, $pic_size[0], $pic_size[1]);

				//ramka
				if(isset($data["title"]) || isset($data["content"])) $bg = imagefilledrectangle($img, 0, $pic_height, $post_width, $post_height, $white_color);

				$bg = imagefilledrectangle($img, 0, $post_height-27, $post_width, $post_height, $black_color);
				$top_border = imagefilledrectangle($img, 0, 0, $post_width, 5, $black_color);
				$bottom_border = imagefilledrectangle($img, 0, $post_height-6, $post_width, $post_height, $black_color);
				$left_border= imagefilledrectangle($img, 0, 0, 5, $post_height, $black_color);
				$right_border= imagefilledrectangle($img, $post_width-6, 0, $post_width, $post_height, $black_color);

				//logo
				$logo = imagecreatefrompng("imgs/template/logo_post.png");
				imagecopy( $img , $logo , ($post_width-112)/2, $post_height-27, 0, 0, 112, 27);

				//generowanie tekstu
				if(isset($data["title"])) imagettftext ( $img, $title_size, 0, $calc_title[0][0] + 25, $calc_title[0][7]+$title_size, $black_color, "fonts/arialbd.ttf", $calc_title[1]);
				if(isset($data["content"])) imagettftext ( $img, $content_size, 0, $calc_content[0][0] + 25, $calc_content[0][7]+$content_size, $black_color, "fonts/arial.ttf", $calc_content[1]);
				imagepng($img, $path);
				imagedestroy($img);
			}
			else{
				//obliczamy wielkość tekstu
				$content_size = 26 - strlen($data["content"])*(26-14)/1000;
				$title_size = 40 - strlen($data["title"])*(40-26)/100;
				//liczymy miejsce zajmowane przez tekst
				$calc_content = $this->calculateText('fonts/arial.ttf', $content_size, $post_width, 50, $data["content"]);
				$calc_title = $this->calculateText('fonts/arialbd.ttf', $title_size, $post_width, 50, $data["title"]);
				for($x = 1; $x <= 7; $x += 2) $calc_content[0][$x] += $calc_title[0][1];
				$post_height =  $calc_content[0][1] + 100;
				$post_height += 27;

				$img = imagecreatetruecolor($post_width, $post_height);

				$white_color = imagecolorallocate ($img, 255, 255, 255);
				$black_color = imagecolorallocate ($img, 0, 0, 0);

				//ramka
				$bg = imagefilledrectangle($img, 0, 0, $post_width, $post_height, $white_color);
				$bg = imagefilledrectangle($img, 0, $post_height-27, $post_width, $post_height, $black_color);
				$top_border = imagefilledrectangle($img, 0, 0, $post_width, 5, $black_color);
				$bottom_border = imagefilledrectangle($img, 0, $post_height-6, $post_width, $post_height, $black_color);
				$left_border= imagefilledrectangle($img, 0, 0, 5, $post_height, $black_color);
				$right_border= imagefilledrectangle($img, $post_width-6, 0, $post_width, $post_height, $black_color);

				//logo
				$logo = imagecreatefrompng("imgs/template/logo_post.png");
				imagecopy( $img , $logo , ($post_width-112)/2, $post_height-27, 0, 0, 112, 27);

				//generowanie tekstu
				imagettftext ( $img, $title_size, 0, $calc_title[0][0] + 50, $calc_title[0][7]+$title_size, $black_color, "fonts/arialbd.ttf", $calc_title[1]);
				imagettftext ( $img, $content_size, 0, $calc_content[0][0] + 50, $calc_content[0][7]+$content_size, $black_color, "fonts/arial.ttf", $calc_content[1]);
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

		//userform

		public function userform(Request $request){
			print_r($request->all());
			die();
		}
}
