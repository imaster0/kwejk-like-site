@extends('layout.template')

@section('strona')
<?php $strona = 'poczekalnia'; ?>
@endsection

@section('ndbar')
<div class="c-submenu row">
	<div class="container">

			<?php $tags = App\Tag::all(); ?>


			<ul class="nav nav-pills">
				<li <?php if($tag == 'all') echo ' class="active" '; ?> ><a href="/">#wszystko</a></li>
				@foreach($tags as $t)
					<li <?php if($tag == $t->name) echo ' class="active" '; ?> ><a href="/q={{$t->name}}">#{{$t->name}}</a></li>
				@endforeach
			</ul>
		</div>
</div>
@endsection

@section('content')
	<!----------------------------------------------------------------------->

	<!-- RANKING -->
	<div id="ranking">
			<div id="ranking-container" class="row text-center">
				<div class="col-md-8">
					<h4> AKTUALNOŚCI </h4>
					<p class="c-opis">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit.
					Ut maximus velit quis semper eleifend. Morbi finibus suscipit
					fringilla. Quisque ullamcorper, lacus et hendrerit commodo, sem lectus
					feugiat ex, non efficitur purus nisl a enim. Aliquam erat volutpat.
					</p>
					<p class="c-temat-dnia alert alert-info">
						#TEMAT_DNIA: Na co komu dziś wczorajszy dzień?
					</p>
			</div>
				<div class="col-md-4" style="border-left: 1px solid white;">
				<h4>TOP 5 MIESIĄCA</h4> <br />
					-------------------- <br />
					-------------------- <br />
					-------------------- <br />
					-------------------- <br />
					-------------------- <br />
				</div>
		</div>
	</div>

	<!--  CONTENT -->
	<div id="content">
			<!-- POSTY -->
			<?php

			if($tag =='all')  $posts = App\Post::where('verified', false)->orderBy('created_at', 'desc')->get();
			else $posts = App\Tag::where('name', $tag)->first()->posts()->where('verified', false)->orderBy('created_at', 'desc')->get();
			?>

			<!-- TEST GRAFIKA -->
			<?php

			function drawBorder(&$img, &$color, $thickness = 5)
			{
			    $x1 = 0;
			    $y1 = 0;
			    $x2 = ImageSX($img) - 1;
			    $y2 = ImageSY($img) - 1;

			    for($i = 0; $i < $thickness; $i++)
			    {
			        ImageRectangle($img, $x1++, $y1++, $x2--, $y2--, $color);
			    }
			}


			$im = @imagecreate(768, 500)
			    or die("Cannot Initialize new GD image stream");

			// Colors
			$white = imagecolorallocate($im, 255, 255, 255);
			$black = imagecolorallocate($im, 0, 0, 0);
			drawBorder($im, $black);

			// Replace path by your own font path
			$arial_font = 'fonts/arial.ttf';
			$arialbd_font = 'fonts/arialbd.ttf';

			//Logo
			imagefilledrectangle($im, 768-20, 25, 768, 105, $black);
			imagettftext($im, 10, 90, 763, 102, $white, $arialbd_font, 'cotynato.eu');
			//Title
			imagettftext($im, 32, 0, 40, 80, $black, $arialbd_font, 'Testing...');
			//content
			use App\GDText\Box;
			use App\GDText\Color;

			$box = new Box($im);
			$box->setFontFace('fonts/arial.ttf');
			$box->setFontColor(new Color(0, 0, 0));
			$box->setFontSize(26);
			$box->setBox(140, 140, 768-280, 500-240);
			$box->setTextAlign('center', 'center');
			$box->draw("Lorem ipsum");


			imagepng($im, "shittty.png");
			imagedestroy($im);
			?>
			<!-- TEST TEST TEST -->


				@foreach($posts as $post)

						<div class="c-post">
							<div class="row c-post-top">
								<div class="col-md-9 col-xs-8">
									<div class="tag-bar">

										<?php
											$tags = $post->tags()->get();
										?>


										<b>#na_temat</b>
										@foreach($tags as $t)
										 #{{$t->name}}
										@endforeach
									</div>
								</div>
								<div class="col-md-3 col-xs-4">
									<div class="c-post-author">
										{{$post->created_at->format('d/m/Y')}}<br/>
										{{$post->user->name}}
									</div>
								</div>
							</div>





							<div class="container-fluid c-post-frame">
								<div class="c-post-header">
									 {{ $post->title }}
								</div>
								<div class="c-post-content">

										{{ $post->content }}

								</div>
							</div>
							<!-- Panel dolny posta  -->

								<div class="c-post-panel">
									<!-- <div class="row "> <h1> A Ty? Co uważasz? </h1> </div> -->
									<!-- Ocena: {{ $post->up }}/{{ $post->down }}
									<button class="btn btn-success"><span class="glyphicon glyphicon-chevron-up"></span></button>
									<button class="btn btn-danger"><span class="glyphicon glyphicon-chevron-down"></span></button>
									<button class="btn btn-info btn-comment"><span class="glyphicon glyphicon-comment"></span></button>
									-->
									<div class="row">
										<ul class="list-inline">
											<li>odpowiedz</li>
											<li>+dodaj</li>
											<li><span class="text-success">zgadzam się</span></li>
											<li><span class="text-danger">nie zgadzam się</span></li>
											<li>udostępnij</li>
										</ul>
									</div>
							</div>
						</div>
				@endforeach

	</div>
@endsection
