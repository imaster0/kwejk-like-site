@extends('layout.template')


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

			if($tag =='all')  $posts = App\Post::orderBy('created_at', 'desc')->get();
			else $posts = App\Tag::where('name', $tag)->first()->posts()->orderBy('created_at', 'desc')->get();
			?>

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
