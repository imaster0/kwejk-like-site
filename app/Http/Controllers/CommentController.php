<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function addNew($id, Request $request){
      \App\Comment::create([
        'user_id' => \Auth::User()->id,
        'post_id' => $id,
        'parent_id' => null,
        'content' => $request->content,
      ]);

      return view("on", ["postid" => $id]);
    }
}
