<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPanel extends Controller
{
    //
    public function verify($sth){
      $thepost = \App\Post::where("id", $sth)->first();
      $thepost->verified = true;
      $thepost->save();

      return redirect()->back();
    }

    public function  delete($sth){
      $thepost = \App\Post::where("id", $sth)->first();
      $thepost->delete();
      return redirect()->back();
    }
}
