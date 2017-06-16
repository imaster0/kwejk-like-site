<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Co uważasz?</title>

        <!-- Fonts & Styles -->
	    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset(' vendor/font-awesome/css/font-awesome.min.css') }} " rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.css') }}" type="text/css">
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css">

		<!-- Scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/app.js') }}"></script>

    </head>
    <body>
		<div id="wrapper">
			<!-- MENUBAR -->
			<nav id="header" class="container">
				<div class="c-menu navbar navbar-default navbar-fixed-top">
					<div class="container">
							<div class="navbar-header">
								<div class="navbar-brand">
									<a href="/"> <img src="{{ asset('imgs/template/logo_big.png') }}" style="height: 34px;" alt="CoTYnaTo?" /></a>
								</div>
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
									<span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
								</button>
							</div>

							<!-- PRZYCISKI MENU -->
							<div id="navbar-menu" class="collapse navbar-collapse" role="menu">





                  @yield('strona')


									<ul class="nav navbar-nav navbar-right c-menu-first" role="menu">
                    <li @if($strona=='glowna') class="active" @endif><a href="/">Strona Główna</a></li>
                    <li @if($strona=='poczekalnia') class="active" @endif><a href="/poczekalnia">Poczekalnia</a></li>
                    @if(Auth::guest())
                    <li @if($strona=='login') class="active" @endif><a href="/login">Zaloguj</a></li>
  									<li @if($strona=='register') class="active" @endif><a href="/register">Zarejestruj</a></li>
                    @else
										<li>
										<a href="/profile"> {{ Auth::user()->name }}  </a>
										</li>
										<li @if($strona=='dodaj') class="active" @endif>
										<a href="/dodaj"> Dodaj  </a>
										</li>
										<li>
											<a href="{{ route('logout') }}"
												onclick="event.preventDefault();
														 document.getElementById('logout-form').submit();">
												Wyloguj
											</a>

											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												{{ csrf_field() }}
											</form>
										</li>
									</ul>
								</li>
								@endif
							</div>
        </div>

          					<!-- DRUGIE MENU (SUBMENU z kategoriami) -->
        	@yield('ndbar')
				</div>
			</nav>

			<!----------------------------------------------------------------------->

      <section id="content" class="main_content">
				@yield('content')
			</section>

			<footer id="footer" class="well">
				<div class="container">
					<div class="row">
						<div class="col-xs-6 text-left">kontakt: imaster0x@gmail.com</div>
						<div class="col-xs-6 text-right">2017</div>
					</div>
				</div>
			</footer>
		</div>
    </body>
</html>
