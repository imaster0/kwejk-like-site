@extends('layout.template')


@section('strona')
<?php $strona = 'profil'; ?>
@endsection

@section('content')
	<!----------------------------------------------------------------------->
	@if (session('mess'))
	    <div class="alert alert-info">
	        {{ session('mess') }}
	    </div>
	@endif

	<!--  CONTENT -->
	<div class="container-fluid">
	    <div class="row">
          <div class="panel panel-default">
            	<div class="panel-heading">Mój profil ({{ Auth::User()->name }}) </div>
							<div class="panel-body">
	                <form class="form-horizontal" role="form" method="POST">
	                    {{ csrf_field() }}
											<div class="form-group text-center">
												<h1> Czy na pewno chcesz usunąć konto? </h1>
											</div>

											<div class="form-group">
													<div class="col-md-6 col-md-offset-4">
															<button type="submit" class="btn btn-danger">
																	Tak, usuń
															</button>
															<a class="btn btn-success" href="{{url('/')}}">
																	Nie, cofnij
															</a>
													</div>
											</div>
											<!-- -->
	                </form>
	            </div>
          </div>
	    </div>
	</div>
@endsection
