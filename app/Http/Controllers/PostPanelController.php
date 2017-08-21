<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use App\Post;
use App\Ulubione;

class PostPanelController extends Controller
{
    public function GetOperation($option, $name){


      $userId = \Auth::User()->id;
      $row = Vote::where('user_id', $userId)->where('post_id', $name)->first();
      $post = Post::where('id', $name)->first();

      switch($option){
        case "like":


          if(isset($row)){
            if($row->value == 1){
              $post->up--;
              $row->value = 0;
            }
            elseif($row->value == -1){
              $post->up++;
              $post->down--;
              $row->value = 1;
            }
            else{
              $post->up++;
              $row->value = 1;
            }
            $post->save();
            $row->save();
          }
          else{
            Vote::create([
              'user_id' => $userId,
              'post_id' => $name,
              'value' => 1
            ]);
            $post->up++;
            $post->save();
            $row->save();
          }
        break;

        case "dislike":

          if(isset($row)){
            if($row->value == 1){
              $post->up--;
              $post->down++;
              $row->value = -1;
            }
            elseif($row->value == -1){
              $post->down--;
              $row->value = 0;
            }
            else{
              $post->down++;
              $row->value = -1;
            }
            $post->save();
            $row->save();
          }
          else{
            Vote::create([
              'user_id' => $userId,
              'post_id' => $name,
              'value' => -1
            ]);
            $post->down++;
            $post->save();
            $row->save();
          }
        break;
        case "dodaj":
          $ulu = Ulubione::where('user_id', $userId)->where('post_id', $name)->first();
          if(!isset($ulu)){
            Ulubione::create([
              'user_id' => $userId,
              'post_id' => $name,
            ]);
          }
          else{
            $ulu->delete();
          }
        //  return "User id: " . $userId . ", added post id: " . $name;
        break;

        default:
        break;
      }


      return array($post->up, $post->down);
    }
}
