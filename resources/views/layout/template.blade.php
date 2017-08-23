<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel='shortcut icon' type='image/png' href='/favicon.png' />

      <title>nacoto.pl - najlepsze pomysły i lajfhaki w sieci</title>

      <!-- Fonts & Styles -->
      <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }} " rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.css') }}" type="text/css">
	    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css">
      <!-- fb metas -->
      <meta property="og:type"          content="article" />
      <meta property="og:title"         content="nacoto.pl - zobacz więcej " />
      <meta property="og:description"   content="Lajfhaki, pomysły, inspiracje - wszystko to w formie krótkich memów!" />

    </head>
    <body>

  		<div id="wrapper">
  			<!-- MENUBAR -->
  			<nav id="header" class="container">
  				<div class="c-menu navbar navbar-default navbar-fixed-top">
  					<div class="container">
  							<div class="navbar-header">
  								<div class="navbar-brand"> <!-- LOGO -->
  									<a href="/"> <img src="{{ asset('imgs/template/logo_28.png') }}" style="height: 20px; margin-top: 15px; margin-left: 15px;" alt="nacoto.pl - strona zawierająca lajfhaki, pomysły, inspiracje w formie memów" /></a>
  								</div>
  								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
  									<span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
  								</button>
  							</div>

  							<!-- PRZYCISKI MENU -->
  							<div id="navbar-menu" class="collapse navbar-collapse" role="menu">
                    @yield('strona')   <!-- jaka to strona -->
  									<ul class="nav navbar-nav navbar-right c-menu-first" role="menu">
                      <li @if($strona=='glowna') class="active" @endif><a href="/">Strona Główna</a></li>
                      <li @if($strona=='top') class="active" @endif><a href="/top">TOP</a></li>
                      <li @if($strona=='poczekalnia') class="active" @endif><a href="/poczekalnia">Poczekalnia</a></li>
                      @if(Auth::guest())
                      <li @if($strona=='login') class="active" @endif><a href="/login">Zaloguj</a></li>
    									<li @if($strona=='register') class="active" @endif><a href="/register">Zarejestruj</a></li>
                      @else
  										<li class="dropdown @if($strona=='dodaj' or $strona=='profil') active @endif">
  										  <a class="dropdown-toggle"  data-toggle="dropdown"> {{ Auth::user()->name }} <span class="caret"></span> </a>

                        <ul class="dropdown-menu">
                          <li>
      										<a href="/dodaj"> Nowy post  </a>
      										</li>
                          <li>
      										<a href="/profil"> Mój profil  </a>
      										</li>
                          @if(\Auth::User()->role == 1)
                          <li>
                            <a href="profil/users"> Userzy </a>
                          </li>
                          @endif
                          <li class="divider"></li>
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


  									</ul>
  								</li>
  								@endif
  							</div>
          </div>

        <!-- DRUGIE MENU (SUBMENU z kategoriami) -->
          	@yield('ndbar')
  				</div>
  			</nav>

        <!-- CONTENT -->
        <section id="content" class="main_content">
  				@yield('content')
  			</section>

        <!-- STOPKA -->
  			<footer id="footer" class="well">
  				<div class="container">
  					<div class="row">
  						<div class="col-xs-6 text-left">kontakt: imaster0x@gmail.com</div>
  						<div class="col-xs-6 text-right">2017</div>
  					</div>
  				</div>
  			</footer>
  		</div>


      <!-- Scripts -->

      <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('js/app.js') }}"></script>
      <script>
      var thisUrl = "/";
      var token = '{{ Session::token() }}';
      </script>


    </body>
</html>
