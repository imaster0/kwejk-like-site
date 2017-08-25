@extends('layout.posts')

<?php $tags = App\Tag::all();
	if(isset($_GET["tag"])) $tag = $_GET["tag"];
	else $tag = "all";
 ?>

@section('strona')
<?php $strona = 'top'; ?>
@endsection

@section('data')
<?php
if($tag =='all')  $posts = App\Post::where('verified', true)->orderByRaw('(up - down) desc')->orderBy('up', 'desc')->orderBy('created_at', 'desc')->paginate(10);

else $posts = App\Tag::where('name', $tag)->first()->posts()->where('verified', true)->orderByRaw('(up - down) desc')->orderBy('up', 'desc')->orderBy('created_at', 'desc')->paginate(10);->paginate(10);
?>
@endsection
