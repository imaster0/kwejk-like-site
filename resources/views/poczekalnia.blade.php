@extends('layout.posts')

@section('fbtags')
<meta property="og:type"          content="article" />
<meta property="og:title"         content="nacoto.pl - codziennie nowe posty" />
<meta property="og:site_name"         content="www.nacoto.pl" />
<meta property="og:image" content="{{asset('imgs/main.png')}}" />
<meta property="og:description"   content="Lajfhaki, pomysły, inspiracje, ciekawostki - wszystko to w formie memów!" />
<meta name="Description" content="Lajfhaki, pomysły, inspiracje, ciekawostki - wszystko to w formie memów! \n słowa kluczowe: śmieszne, edukujące, szokujące, pouczające, wartościowe, użyteczne, wiedza.">
@endsection

<?php $tags = App\Tag::all();
	if(isset($_GET["tag"])) $tag = $_GET["tag"];
	else $tag = "all";
 ?>

@section('strona')
<?php $strona = 'poczekalnia'; ?>
@endsection

@section('data')
<?php
if($tag =='all')  $posts = App\Post::where('verified', false)->orderBy('created_at', 'desc')->paginate(10);
else $posts = App\Tag::where('name', $tag)->first()->posts()->where('verified', false)->orderBy('created_at', 'desc')->paginate(10);
?>
@endsection
