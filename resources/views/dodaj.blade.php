@extends('layout.template')



@section('content')
<div class="container-fluid">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Dodaj</div>
                <div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="{{ route('dodaj') }}">
                        {{ csrf_field() }}
						
						<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Tytuł</label>

                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Treść</label>

                            <div class="col-md-8">
								<textarea id="content" name="content" type="text" class="form-control" rows="5" value="{{ old('content') }}" required autofocus></textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Nowy post
                                </button>
                            </div>
                        </div>
						
						</form>
                </div>
        </div>
    </div>
</div>
@endsection
