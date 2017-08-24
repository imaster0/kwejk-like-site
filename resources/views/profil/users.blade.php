@extends('layout.template')


@section('strona')
<?php $strona = 'profil'; ?>
@endsection

@section('content')
	<!----------------------------------------------------------------------->


	<!--  CONTENT -->
	<div class="container-fluid">
			<form role="form" method="POST">
					{{csrf_field()}}
				<?php $users = \App\User::all(); ?>
				<div class="row">
					<div class="col-xs-3">
						(ID) USERNAME
					</div>
					<div class="col-xs-3">
						CREATED
					</div>
					<div class="col-xs-3">
						UPDATED
					</div>
					<div class="col-xs-3">
						IS ADMIN?
					</div>
				@foreach($users as $user)  <!-- USERS TABLE -->
					<div class="col-xs-3">
						({{$user->id}}) {{$user->name}}</div>
						 <div class="col-xs-3">
							{{$user->created_at}}</div>
							 <div class="col-xs-3">
								{{$user->updated_at}}</div>
								 <div class="col-xs-3">
									@if($user->role == 1)
										<input type="checkbox" name="{{$user->id}}" checked />
									 @else
									 	<input type="checkbox" name="{{$user->id}}" />
									  @endif</div>
									<br/>
				@endforeach
				<!-- BTN -->
				<input style="margin-top: 50px; margin-bottom: 50px;" class="btn btn-primary" type="submit" value="Update" />
				<a class="btn btn-default" href="{{url(url()->previous())}}">
						Cofnij
				</a>
			</form>
		</div>
	</div>
@endsection
