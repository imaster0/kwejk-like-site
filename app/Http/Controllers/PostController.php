<?php

namespace App\Http\Controllers;

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
        return Post::create([
			'user_id' => \Auth::user()->id,
            'title' => $data['title'],
            'content' => $data['content'],
        ]);
    }

		protected function addTags(array $data){
			foreach($data as $d){
				\DB::table('post_tag')->insert([
					'post_id' => Post::all()->last()->id,
					'tag_id' => \App\Tag::where('name', $d)->get()->first()->id,
				]);
			}
		}
}
