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
            	<div class="panel-heading">Twój profil</div>

							<div class="panel-body">
	                <form class="form-horizontal" role="form" method="POST">
	                    {{ csrf_field() }}
											<!-- do poprawienia -->
											<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
													<label for="name" class="col-md-4 control-label">Stare hasło</label>

													<div class="col-md-6">
															<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

															@if ($errors->has('name'))
																	<span class="help-block">
																			<strong>{{ $errors->first('name') }}</strong>
																	</span>
															@endif
													</div>
											</div>
											<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
													<label for="name" class="col-md-4 control-label">Nowe hasło</label>

													<div class="col-md-6">
															<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

															@if ($errors->has('name'))
																	<span class="help-block">
																			<strong>{{ $errors->first('name') }}</strong>
																	</span>
															@endif
													</div>
											</div>
											<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
													<label for="name" class="col-md-4 control-label">Powtórz nowe hasło</label>

													<div class="col-md-6">
															<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

															@if ($errors->has('name'))
																	<span class="help-block">
																			<strong>{{ $errors->first('name') }}</strong>
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
