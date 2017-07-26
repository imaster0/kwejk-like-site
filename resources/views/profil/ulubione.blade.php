@extends('layout.posts')

<?php $tags = App\Tag::all();
	if(isset($_GET["tag"])) $tag = $_GET["tag"];
	else $tag = "all";
 ?>

@section('strona')
<?php $strona = 'profil'; ?>
@endsection

@section('data')
<?php
if($tag =='all')  $posts = App\User::where('id', \Auth::User()->id)->ulubione()->orderBy('created_at', 'desc')->paginate(10); /* DO EDYCJI RELACJA MIĘDZY ULUBIONE POSTY */
else $posts = App\Tag::where('name', $tag)->first()->posts()->where('user_id', \Auth::User()->id)->ulubione()->orderBy('created_at', 'desc')->paginate(10);
?>
@endsection
