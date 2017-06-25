@extends('layout.template')


@section('strona')
<?php $strona = 'profil'; ?>
@endsection

@section('ndbar')

@endsection

@section('content')
	<!----------------------------------------------------------------------->


	<!--  CONTENT -->
	<div class="container-fluid">
	    <div class="row">
          <div class="panel panel-default">
            	<div class="panel-heading">Mój profil ({{ Auth::User()->name }})</div>

							<div class="panel-body text-center">
	                <ul>
										<li><a href="profil/ulubione"> Moje posty </a></li>
										<li><a href="profil/pwchange"> Zmień hasło </a></li>
										<li><a href="profil/emchange"> Zmień email </a></li>
										<li><a href="#"> Usuń konto </a></li>
									</ul>
	            </div>
          </div>
	    </div>
	</div>
@endsection
