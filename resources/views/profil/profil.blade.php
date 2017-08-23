@extends('layout.template')


@section('strona')
<?php $strona = 'profil'; ?>
@endsection

@section('content')
	<!----------------------------------------------------------------------->


	<!--  CONTENT -->
	<div class="container-fluid">
	    <div class="row">
          <div class="panel panel-default">
            	<div class="panel-heading">Mój profil ({{ Auth::User()->name }}) </div>

							<div class="panel-body text-center">

	                <ul class="list-group">
										<li class="list-group-item"><a href="profil/moje"> Moje posty </a></li>
										<li class="list-group-item"><a href="profil/ulubione"> Ulubione posty </a></li>
										<li class="list-group-item"><a href="profil/pwchange"> Zmień hasło </a></li>
										<li class="list-group-item"><a href="profil/emchange"> Zmień email </a></li>
										<li class="list-group-item"><a href="profil/delete"> Usuń konto </a></li>
									</ul>
	            </div>
          </div>
	    </div>
	</div>
@endsection
