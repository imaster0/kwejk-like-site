<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model{

	//czas utworzenia/edycji posta, edytowalne pola
	public $timestamps = true;
	protected $fillable = ['user_id', 'path',];

	//komentarze odpowiadające temu postowi
	public function comments(){
      return $this->hasMany('App\Comment');
  }

	//tagi odpowiadające temu postowi
	public function tags(){
		return $this->belongsToMany('App\Tag', 'post_tag', 'post_id', 'tag_id');
	}

	//użytkownik - autor posta
	public function user(){
		return $this->belongsTo('App\User');
	}

}
