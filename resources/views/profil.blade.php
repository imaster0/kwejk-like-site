@extends('layout.template')


@section('ndbar')
<div class="c-submenu row">
	<div class="container">							
		<!--		<a href="#">#polityka</a>
				<a href="#">#cośtam</a> 
				<a href="#">#wszystko</a>
		-->
			<ul class="nav nav-pills">
				<li <?php if($tag == 'all') echo ' class="active" '; ?> ><a href="/">#wszystko</a></li>
				<li <?php if($tag == 'politics') echo ' class="active" '; ?>><a href="/q=politics">#polityka</a></li>
				<li <?php if($tag == 'culture') echo ' class="active" '; ?>><a href="/q=culture">#kultura</a></li>
				<li <?php if($tag == 'technics') echo ' class="active" '; ?>><a href="/q=technics">#technika</a></li>
				<li <?php if($tag == 'everyday_life') echo ' class="active" '; ?>><a href="/q=everyday_life">#życie_codzienne</a></li>
			</ul>
		</div>
</div>
@endsection

@section('content')
	<!----------------------------------------------------------------------->
	
	<!-- RANKING -->
	<div id="ranking">
		<div class="container-fluid">
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
	</div>

	<!--  CONTENT -->
	<div id="content">
			<!-- POSTY -->
			<?php $posts = App\Post::all() ; ?>
		
				@foreach($posts as $post)
				<div class="c-post">
					<div class="row">
						<div class="c-post-header">
							<div class="col-md-6  col-sm-6 col-xs-6 c-post-author">Dodano przez  {{$post->user->name}}</div>
							<div class="col-md-6 col-sm-6 col-xs-6  c-post-date text-right"> ?data? </div>
						</div>
					</div>
					
					<div class="c-post-content">
						<div class="row">
							<h3> {{ $post->title }} </h3>
						</div>

						<div class="row">
							
								{{ $post->content }}
							
						</div>
					</div>
					<!-- Panel dolny posta  -->
					<div class="row align-bottom">
						<div class="c-post-panel">
							<button class="btn btn-success"><span class="glyphicon glyphicon-chevron-up"></span></button> 
							<button class="btn btn-danger"><span class="glyphicon glyphicon-chevron-down"></span></button>
							<button class="btn btn-info btn-comment"><span class="glyphicon glyphicon-comment"></span></button>
						</div>
					</div>
				</div>
				@endforeach
			
	</div>
@endsection
