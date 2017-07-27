@extends('layout.posts')

<?php $tags = App\Tag::all();
	if(isset($_GET["tag"])) $tag = $_GET["tag"];
	else $tag = "all";
	$nobar = true;
 ?>

@section('strona')
<?php $strona = 'profil'; ?>
@endsection

@section('data')
<?php
 	$posts = \Auth::User()->ulubione()->orderBy('created_at', 'desc')->paginate(10);
?>

@endsection
