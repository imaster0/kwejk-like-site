@extends('layout.template')

<?php $tags = App\Tag::all();
	if(isset($_GET["tag"])) $tag = $_GET["tag"];
	else $tag = "all";
 ?>

@section('ndbar')
@if(!isset($nobar))
<style>
@media screen and (max-width: 1199px){
	body{
		margin-top: 90px;
	}
}

@media screen and (max-width: 607px){
	body{
		margin-top: 120px;
	}
}

@media screen and (max-width: 426px){
	body{
		margin-top: 150px;
	}
}

@media screen and (max-width: 356px){
	body{
		margin-top: 180px;
	}
}
</style>
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
					<h4> AKTUALNOŚCI </h4>
					<p class="c-opis">
						Na następnej stronie znajdziesz znany ci obraz ukazujący paryski salon pani Geoffrin.
						Jak widzisz goście gawędzą ze sobą. Napisz pod ilustracją, przy numerze każdej postaci, czy jej wypowiedź jest zgodna z ideami oświecenia czy nie. Wszystkie decyzje uzasadnij.
					</p>
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
							<div class="col-md-9 col-xs-7">
								<div class="tag-bar">

									<?php $tags = $post->tags()->get(); ?>

									<b>#na_temat</b>
									@foreach($tags as $t)
									 #{{$t->name}}
									@endforeach
								</div>
							</div>
							<div class="col-md-3 col-xs-5">
								<div class="text-right">
									{{$post->created_at->format('d/m/Y')}}<br/>
									@if($post->user != null){{$post->user->name}} @else nieznany @endif
								</div>
							</div>
						</div>


						<div class="c-post-image"><img src="{{asset($post->path)}}" alt="{{htmlspecialchars($post->title)}}; {{htmlspecialchars($post->description)}}" /></div>

						<!-- Panel dolny posta  -->

							<div  class="c-post-panel row">
                  <ul class="list-inline text-left">
									  <li>

                          <a id="like" class="post-button @if(\Auth::Guest() != true) pst-btn @endif"  name="{{$post->id}}" title="Lubię to!" href="{{url('login')}}">
                            <!-- <svg   width="26px" height="26px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
                            <circle cx="16" cy="16" r="16" fill="#fff" />
                            <path d="M12.799,13.567l6.217,-7.589c0,0 1.989,-0.978 2.137,0.796c0.126,1.508 -2.269,5.597 -1.773,6.697l5.38,0c3.691,2.344 -1.731,12.82 -4.889,12.82l-6.646,0c-0.543,0 -0.983,-0.44 -0.983,-0.983l0,-10.855c0,-0.39 0.228,-0.727 0.557,-0.886Z" fill="#000"/>
                            <path d="M11.09,14.843c0,-0.702 -0.57,-1.272 -1.272,-1.272l-2.546,0c-0.702,0 -1.272,0.57 -1.272,1.272l0,10.175c0,0.703 0.57,1.273 1.272,1.273l2.546,0c0.702,0 1.272,-0.57 1.272,-1.273l0,-10.175Z" fill="#000" />
                            </svg> -->

														<svg width="28px" height="28px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
														<circle cx="16" cy="16" r="16" fill="#fff" />
														<g>
														<path d="M13.709,14.169l3.394,-6.321c0,0 1.299,-0.6 1.986,0.667c0.328,0.605 0.199,1.444 -0.001,2.892c-0.301,2.176 -0.347,1.887 -0.347,2.507l5.137,0c2.988,1.898 -1.401,10.38 -3.959,10.38l-5.38,0c-0.439,0 -0.796,-0.357 -0.796,-0.796l0,-8.788c0,-0.316 -0.021,-0.341 -0.034,-0.541Z" style="fill:none;stroke:#fff;stroke-width:2px;"/>
														<path d="M11.24,15.025c0,-0.568 -0.462,-1.03 -1.031,-1.03l-2.06,0c-0.569,0 -1.031,0.462 -1.031,1.03l0,8.238c0,0.569 0.462,1.031 1.031,1.031l2.06,0c0.569,0 1.031,-0.462 1.031,-1.031l0,-8.238Z" style="fill:none;stroke:#fff;stroke-width:2px;"/>
														</g>
														</svg>

                         </a>
    									    <span id="like-btn-{{$post->id}}" class="post-btn-tag">{{$post->up}}</span>
                    </li>
                    <li>
											  <a id="dislike" class="post-button @if(\Auth::Guest() != true) pst-btn @endif"   name="{{$post->id}}" title="Nie lubię tego" href="{{url('login')}}">
                          <!-- <svg width="26px" height="26px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
                          <circle cx="16" cy="16" r="16" fill="#fff" />
                          <path d="M12.799,18.433c-0.329,-0.159 -0.557,-0.496 -0.557,-0.886l0,-10.855c0,-0.543 0.44,-0.983 0.983,-0.983l6.646,0c3.158,0 8.58,10.476 4.889,12.82l-5.38,0c-0.496,1.1 1.899,5.189 1.773,6.697c-0.148,1.774 -2.137,0.796 -2.137,0.796l-6.217,-7.589Z" fill="#000"/>
                          <path d="M11.09,17.157c0,0.702 -0.57,1.272 -1.272,1.272l-2.546,0c-0.702,0 -1.272,-0.57 -1.272,-1.272l0,-10.175c0,-0.703 0.57,-1.273 1.272,-1.273l2.546,0c0.702,0 1.272,0.57 1.272,1.273l0,10.175Z" fill="#000"/>
                          </svg> -->

													<svg width="28px" height="28px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
													<circle cx="16" cy="16" r="16" fill="#fff" />
													<g>
													<path d="M13.709,17.831l3.394,6.321c0,0 1.299,0.6 1.986,-0.667c0.328,-0.605 0.199,-1.444 -0.001,-2.892c-0.301,-2.176 -0.347,-1.887 -0.347,-2.507l5.137,0c2.988,-1.898 -1.401,-10.38 -3.959,-10.38l-5.38,0c-0.439,0 -0.796,0.357 -0.796,0.796l0,8.788c0,0.316 -0.021,0.341 -0.034,0.541Z" style="fill:none;stroke:#fff;stroke-width:2px;"/>
													<path d="M11.24,16.975c0,0.568 -0.462,1.03 -1.031,1.03l-2.06,0c-0.569,0 -1.031,-0.462 -1.031,-1.03l0,-8.238c0,-0.569 0.462,-1.031 1.031,-1.031l2.06,0c0.569,0 1.031,0.462 1.031,1.031l0,8.238Z" style="fill:none;stroke:#fff;stroke-width:2px;"/>
													</g>
													</svg>
                        </a>
											<span id="dislike-btn-{{$post->id}}" class="post-btn-tag">{{$post->down}}</span>

                  </li>
								</ul>
								<ul class="list-inline text-right">
                    <li>
											<?php if(\Auth::Guest() != true ) $ulu = \App\Ulubione::where('user_id', \Auth::User()->id)->where('post_id', $post->id)->first(); ?>
											<a class="post-button @if(\Auth::Guest() != true) pst-btn @endif @if(isset($ulu)) selected @endif"  id="dodaj" name="{{$post->id}}" title="@if(isset($ulu)) Usuń z ulubionych @else Dodaj do ulubionych @endif" href="{{url('login')}}">
                        <!-- <svg   width="26px" height="26px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
                        <circle cx="16" cy="16" r="16" fill="#fff" />
                        <path d="M5.664,14.203l8.539,0l0,-8.539l3.594,0l0,8.539l8.539,0l0,3.594l-8.539,0l0,8.539l-3.594,0l0,-8.539l-8.539,0l0,-3.594Z" fill="#fff"  />
                        </svg> -->
												<svg width="28px" height="28px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;">
												<circle cx="16" cy="16" r="16" fill="#fff" />
												<path d="M16,10.76c1.739,-3.304 5.217,-3.304 6.956,-1.652c1.739,1.652 1.739,4.956 0,8.261c-1.217,2.478 -4.347,4.956 -6.956,6.608c-2.609,-1.652 -5.739,-4.13 -6.956,-6.608c-1.739,-3.305 -1.739,-6.609 0,-8.261c1.739,-1.652 5.217,-1.652 6.956,1.652Z" style="fill:none;stroke:#fff;stroke-width:2px;"/>
												</svg>
											</a>
                  </li>
                    <li>
												<?php $pomLink = "on/" . $post->id; ?>
                        <a class="post-button"  id="komentarz" name="{{$post->id}}" title="Komentarze ({{DB::table('comments')->where('post_id', $post->id)->count()}})" href="{{url($pomLink)}}">
                        <!-- <svg  width="26px" height="26px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;">

                        <circle cx="16" cy="16" r="16" fill="#fff" />
                        <clipPath id="_clip1"><rect id="odpowiedz1" x="0" y="0" width="32" height="32"/></clipPath>
                        <g clip-path="url(#_clip1)">
                        <path d="M15.927,22.21l-0.322,-4.421l6.975,-12.462l3.938,2.204l-6.859,12.049l-3.732,2.63" fill="#fff" />
                        <path d="M5.482,26.286c0,0 0.942,-7.521 4.532,-2.129c3.447,5.176 3.55,0.85 4.551,0.311" stroke="#fff" style="fill:none;stroke-width:2px;" />
                        </g>
                        </svg> -->
												<svg width="28px" height="28px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;">
												<circle cx="16" cy="16" r="16" fill="#fff" />
												<clipPath id="_clip1">
												<rect id="odpowiedz1" x="0" y="0" width="32" height="32"/>
												</clipPath>
												<g clip-path="url(#_clip1)">
												<path d="M24.247,10.64c0,-1.593 -1.294,-2.887 -2.887,-2.887l-10.72,0c-1.593,0 -2.887,1.294 -2.887,2.887l0,5.772c0,1.593 1.294,2.887 2.887,2.887l0.444,0l-0.032,4.948l4.536,-4.948l5.772,0c1.593,0 2.887,-1.294 2.887,-2.887l0,-5.772Z" style="fill:none;stroke:#fff;stroke-width:2px;"/>
												</g>
												</svg>

                        </a>

                    </li>
                    <li>
											<a class="post-button"  id="udostepnij" name="{{$post->id}}" title="Udostępnij" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fimaster0.nazwa.pl%2Fon%2F{{$post->id}}&amp;src=sdkpreparse">  <!-- TO CHANGE -->
                        <!-- <svg  width="26px" height="26px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
                        <circle cx="16" cy="16" r="16" fill="#fff" />
                        <path d="M19.014,9.097l0,-3.478l9.134,6.099l-9.134,6.098l0,-3.292c-10.976,-0.392 -11.085,8.625 -11.085,8.625c0,0 -0.951,-12.881 11.085,-14.052Z" fill="#fff" />
                        <path d="M3.852,7.718l2.302,0l0,16.361l16.653,0l0,2.302l-18.955,0l0,-18.663Z" fill="#fff" />
                        </svg> -->

												<svg width="28px" height="28px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
												<circle cx="16" cy="16" r="16" fill="#fff" />
												<path d="M16.931,10.997l0,-3.291l8.644,5.771l-8.644,5.771l0,-3.115c-10.385,-0.371 -10.489,8.161 -10.489,8.161c0,0 -0.899,-12.189 10.489,-13.297Z" style="fill:none;stroke:#fff;stroke-width:2px;"/>
												</svg>
											</a>
                    </li>
                  </ul>
							</div>
            </div>
			@endforeach
				<div class="text-center"> {{ $posts->links() }} </div>
	</div>


@endsection
