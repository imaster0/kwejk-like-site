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

      if (\File::exists($thepost->path)) \File::delete($thepost->path);
      $thepost->delete();
      return redirect()->back();
    }

    public function update(Request $request){
    //  print_r($request->all());
      $table = $request->all();
      $users = \App\User::all();

      foreach($users as $user){
        if(!isset($table[$user->id]) || $table[$user->id] != 'on'){
          $user->role = 0;
          $user->save();
        }
        else{
          $user->role = 1;
          $user->save();
        }
      }
      return redirect()->back();
    }
}
