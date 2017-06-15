<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	//czas posta
	public $timestamps = true;

	protected $fillable = [
        'user_id', 'path',
    ];
    //
	public function comments()
    {
        return $this->hasMany('App\Comment');
    }

	public function tags(){
		return $this->belongsToMany('App\Tag', 'post_tag', 'post_id', 'tag_id');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}
}
