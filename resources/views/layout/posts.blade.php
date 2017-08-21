@extends('layout.template')

<?php $tags = App\Tag::all();
	if(isset($_GET["tag"])) $tag = $_GET["tag"];
	else $tag = "all";
 ?>

@section('ndbar')
@if(!isset($nobar))
<div class="c-submenu row">
	<div class="container">
			<ul class="nav nav-pills">
				<li <?php if($tag == 'all') echo ' class="active" '; ?> ><a href="?tag=all">#wszystko</a></li>
				@foreach($tags as $t)
					<li <?php if($tag == $t->name) echo ' class="active" '; ?> ><a href='?tag={{$t->name}}'>#{{$t->name}}</a></li>
				@endforeach
			</ul>
		</div>
</div>
@endif
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

			@yield('data')

			@if($posts->count() == 0)
				<h1 style="text-align: center; margin-top: 50px;"><b>BRAK POSTÓW ;(</b></h1><br/>
			@endif

			@foreach($posts as $post)

					<div  class="c-post">
						@if(! \Auth::Guest() )
							@if( \Auth::user()->role == 1 )
									<div class="fluid-container" style="background: white; color: black;">
										<div class="col-xs-6 text-left" style="background: white; color: black;"> <B>ADMIN PANEL</B> </div>
										<div class="col-xs-6 text-right" style="background: white; color: black;"> <B><a class="btn btn-xs" href="../ver/{{$post->id}}"> @if(!$post->verified)[WERYFIKUJ] @else [ODWERYFIKUJ] @endif</a>	<a href="../del/{{$post->id}}" class="btn btn-xs">[USUŃ]</a></B> </div>
									</div>
							@endif
						@endif
						<div class="row c-post-top">
							<div class="col-md-9 col-xs-8">
								<div class="tag-bar">

									<?php $tags = $post->tags()->get(); ?>

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


						<div class="c-post-image"><img src="{{asset($post->path)}}"></img></div>

						<!-- Panel dolny posta  -->

							<div  class="c-post-panel row">
                  <ul class="list-inline text-left">
									  <li>

                          <a class="post-button @if(\Auth::Guest() != true) pst-btn @endif"  id="like" name="{{$post->id}}" title="Lubię to!" href="{{url('login')}}">
                            <svg   width="32px" height="32px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
                            <circle cx="16" cy="16" r="16" fill="#fff" />
                            <path d="M12.799,13.567l6.217,-7.589c0,0 1.989,-0.978 2.137,0.796c0.126,1.508 -2.269,5.597 -1.773,6.697l5.38,0c3.691,2.344 -1.731,12.82 -4.889,12.82l-6.646,0c-0.543,0 -0.983,-0.44 -0.983,-0.983l0,-10.855c0,-0.39 0.228,-0.727 0.557,-0.886Z" fill="#000"/>
                            <path d="M11.09,14.843c0,-0.702 -0.57,-1.272 -1.272,-1.272l-2.546,0c-0.702,0 -1.272,0.57 -1.272,1.272l0,10.175c0,0.703 0.57,1.273 1.272,1.273l2.546,0c0.702,0 1.272,-0.57 1.272,-1.273l0,-10.175Z" fill="#000" />
                            </svg>
                         </a>
    									    <span id="like-btn-{{$post->id}}" class="post-btn-tag">{{$post->up}}</span>
                    </li>
                    <li>
											  <a class="post-button @if(\Auth::Guest() != true) pst-btn @endif"  id="dislike" name="{{$post->id}}" title="Nie lubię tego" href="{{url('login')}}">
                          <svg width="32px" height="32px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
                          <circle cx="16" cy="16" r="16" fill="#fff" />
                          <path d="M12.799,18.433c-0.329,-0.159 -0.557,-0.496 -0.557,-0.886l0,-10.855c0,-0.543 0.44,-0.983 0.983,-0.983l6.646,0c3.158,0 8.58,10.476 4.889,12.82l-5.38,0c-0.496,1.1 1.899,5.189 1.773,6.697c-0.148,1.774 -2.137,0.796 -2.137,0.796l-6.217,-7.589Z" fill="#000"/>
                          <path d="M11.09,17.157c0,0.702 -0.57,1.272 -1.272,1.272l-2.546,0c-0.702,0 -1.272,-0.57 -1.272,-1.272l0,-10.175c0,-0.703 0.57,-1.273 1.272,-1.273l2.546,0c0.702,0 1.272,0.57 1.272,1.273l0,10.175Z" fill="#000"/>
                          </svg>
                        </a>
											<span id="dislike-btn-{{$post->id}}" class="post-btn-tag">{{$post->down}}</span>

                  </li>
								</ul>
								<ul class="list-inline text-right">
                    <li>
											<?php if(\Auth::Guest() != true ) $ulu = \App\Ulubione::where('user_id', \Auth::User()->id)->where('post_id', $post->id)->first(); ?>
											<a class="post-button @if(\Auth::Guest() != true) pst-btn @endif @if(isset($ulu)) selected @endif"  id="dodaj" name="{{$post->id}}" title="@if(isset($ulu)) Usuń z ulubionych @else Dodaj do ulubionych @endif" href="{{url('login')}}">
                        <svg   width="32px" height="32px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
                        <circle cx="16" cy="16" r="16" fill="#fff" />
                        <path d="M5.664,14.203l8.539,0l0,-8.539l3.594,0l0,8.539l8.539,0l0,3.594l-8.539,0l0,8.539l-3.594,0l0,-8.539l-8.539,0l0,-3.594Z" fill="#fff"  />
                        </svg>
											</a>
                  </li>
                    <li>
												<?php $pomLink = "on/" . $post->id; ?>
                        <a class="post-button"  id="komentarz" name="{{$post->id}}" title="Komentarze ({{DB::table('comments')->where('post_id', $post->id)->count()}})" href="{{url($pomLink)}}">
                        <svg  width="32px" height="32px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;">

                        <circle cx="16" cy="16" r="16" fill="#fff" />
                        <clipPath id="_clip1"><rect id="odpowiedz1" x="0" y="0" width="32" height="32"/></clipPath>
                        <g clip-path="url(#_clip1)">
                        <path d="M15.927,22.21l-0.322,-4.421l6.975,-12.462l3.938,2.204l-6.859,12.049l-3.732,2.63" fill="#fff" />
                        <path d="M5.482,26.286c0,0 0.942,-7.521 4.532,-2.129c3.447,5.176 3.55,0.85 4.551,0.311" stroke="#fff" style="fill:none;stroke-width:2px;" />
                        </g>
                        </svg>
                        </a>

                    </li>
                    <li>
											<a class="post-button"  id="udostepnij" name="{{$post->id}}" title="Udostępnij" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=onet.pl"> <!-- TO CHANGE -->
                        <svg  width="32px" height="32px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
                        <circle cx="16" cy="16" r="16" fill="#fff" />
                        <path d="M19.014,9.097l0,-3.478l9.134,6.099l-9.134,6.098l0,-3.292c-10.976,-0.392 -11.085,8.625 -11.085,8.625c0,0 -0.951,-12.881 11.085,-14.052Z" fill="#fff" />
                        <path d="M3.852,7.718l2.302,0l0,16.361l16.653,0l0,2.302l-18.955,0l0,-18.663Z" fill="#fff" />
                        </svg>
											</a>
                    </li>
                  </ul>
							</div>
            </div>
			@endforeach
				<div class="text-center"> {{ $posts->links() }} </div>
	</div>

	<script>
	var thisUrl = "/";
	var token = '{{ Session::token() }}';
	</script>
@endsection
