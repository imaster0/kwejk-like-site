<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use App\Post;

class PostPanelController extends Controller
{
    public function GetOperation($option, $name){


      $userId = \Auth::User()->id;

      switch($option){
        case "like":
          $row = Vote::where('user_id', $userId)->where('post_id', $name)->first();
          $post = Post::where('id', $name)->first();

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
          $row = Vote::where('user_id', $userId)->where('post_id', $name)->first();
          $post = Post::where('id', $name)->first();

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
          return "User id: " . $userId . ", added post id: " . $name;
        break;
        case "komentarz":
          return "User id: " . $userId . ", commented post id: " . $name;
        break;
        case "udostepnij":
          return "User id: " . $userId . ", shared post id: " . $name;
        break;
        default:
          return "Error, no such operation: " . $option . ", " . $name;
        break;
      }


      return array($post->up, $post->down);
    }
}
