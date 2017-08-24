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
							aktualny email: @if(isset(Auth::User()->email)) {{ Auth::User()->email }} @else <i> nie podano </i> @endif
							<div class="panel-body">
	                <form class="form-horizontal" role="form" method="POST">
	                    {{ csrf_field() }}
											<!-- do poprawienia -->
											<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
													<label for="password" class="col-md-4 control-label">Hasło</label>

													<div class="col-md-6">
															<input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required autofocus>

															@if ($errors->has('password'))
																	<span class="help-block">
																			<strong>{{ $errors->first('password') }}</strong>
																	</span>
															@endif
													</div>
											</div>
											<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
													<label for="email" class="col-md-4 control-label">Nowy email</label>

													<div class="col-md-6">
															<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

															@if ($errors->has('email'))
																	<span class="help-block">
																			<strong>{{ $errors->first('email') }}</strong>
																	</span>
															@endif
													</div>
											</div>

											<div class="form-group">
													<div class="col-md-6 col-md-offset-4">
															<button type="submit" class="btn btn-primary">
																	Zmień email
															</button>
															<a class="btn btn-default" href="{{url(url()->previous())}}">
																	Cofnij
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
