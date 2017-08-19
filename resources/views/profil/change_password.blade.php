@extends('layout.template')


@section('strona')
<?php $strona = 'profil'; ?>
@endsection

@section('ndbar')

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
											<!-- do poprawienia -->
											<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
													<label for="name" class="col-md-4 control-label">Stare hasło</label>

													<div class="col-md-6">
															<input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required autofocus>

															@if ($errors->has('password'))
																	<span class="help-block">
																			<strong>{{ $errors->first('password') }}</strong>
																	</span>
															@endif
													</div>
											</div>
											<div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
													<label for="newpassword" class="col-md-4 control-label">Nowe hasło</label>

													<div class="col-md-6">
															<input id="newpassword" type="password" class="form-control" name="newpassword" value="{{ old('newpassword') }}" required autofocus>

															@if ($errors->has('newpassword'))
																	<span class="help-block">
																			<strong>{{ $errors->first('newpassword') }}</strong>
																	</span>
															@endif
													</div>
											</div>
											<div class="form-group{{ $errors->has('newpassword_confirmation') ? ' has-error' : '' }}">
													<label for="newpassword_confirmation" class="col-md-4 control-label">Powtórz nowe hasło</label>

													<div class="col-md-6">
															<input id="newpassword_confirmation" type="password" class="form-control" name="newpassword_confirmation" value="{{ old('newpassword_confirmation') }}" required autofocus>

															@if ($errors->has('newpassword_confirmation'))
																	<span class="help-block">
																			<strong>{{ $errors->first('newpassword_confirmation') }}</strong>
																	</span>
															@endif
													</div>
											</div>
											<div class="form-group">
													<div class="col-md-6 col-md-offset-4">
															<button type="submit" class="btn btn-primary">
																	Zmień hasło
															</button>
													</div>
											</div>
											<!-- -->
	                </form>
	            </div>
          </div>
	    </div>
	</div>
@endsection
