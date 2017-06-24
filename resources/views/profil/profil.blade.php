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
            	<div class="panel-heading">Twój profil ({{ Auth::User()->name }})</div>

							<div class="panel-body text-center">
	                <ul>
										<li><a> Ulubione posty </a></li>
										<li><a> Zmień hasło </a></li>
										<li><a> Zmień email </a></li>
										<li><a> Usuń konto </a></li>
									</ul>
	            </div>
          </div>
	    </div>
	</div>
@endsection
