<?php

namespace App\Http\Controllers;

use App\GDText\Box;
use App\GDText\Color;

use App\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class PostController extends Controller
{


    //
	public function add(Request $request){

		$this->validator($request->all())->validate();
		$this->create($request->all());

		if(!empty($request->tagi)) $this->addTags($request->tagi);

		return redirect('/');
	}

	  protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:50',
            'content' => 'required|string|max:600',
        ]);
    }

    protected function create(array $data)
    {
			//post frame
			$img = \Image::canvas(768, 500, '#ffffff');
			$img->rectangle(2.5, 2.5, 768-2.5, 500-2.5, function($draw){
				$draw->border(5, '#000');
			});
			// draw filled red rectangle
			$img->rectangle(768-25, 30, 768, 130, function ($draw) {
			    $draw->background('#000');
			});
			$img->save('imgs/shittty.png');  //random name or something

			$im = imagecreatefrompng ('imgs/shittty.png');
			//Topic
			$box = new Box($im);
			$box->setFontFace('fonts/arialbd.ttf'); // http://www.dafont.com/franchise.font
			$box->setFontColor(new Color(0, 0, 0));
			$box->setFontSize(40);
			$box->setBox(50, 50, 768-100, 90);
			$box->setTextAlign('left', 'top');
			$box->draw($data["title"]);

			//content
			$box = new Box($im);
			$box->setFontFace('fonts/arial.ttf'); // http://www.dafont.com/franchise.font
			$box->setFontColor(new Color(0, 0, 0));
			$box->setFontSize(24);
			$box->setBox(50, 100, 768-100, 500-200);
			$box->setTextAlign('center', 'center');
			$box->draw($data["content"]);
			imagepng($im, 'imgs/shittty.png');




        return Post::create([
						'user_id' => \Auth::user()->id,
            'path' => 'imgs/shittty.png',
        ]);
    }

		protected function addTags(array $data){
			foreach($data as $d){
				\DB::table('post_tag')->insert([
					'post_id' => Post::all()->last()->id,
					'tag_id' => \App\Tag::where('name', $d)->first()->id,
				]);
			}
		}
}
