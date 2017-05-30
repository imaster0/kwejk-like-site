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
}
