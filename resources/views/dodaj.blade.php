@extends('layout.template')

@section('strona')
<?php $strona = 'dodaj'; ?>
@endsection

@section('content')

@if (session('mess'))
    <div class="alert alert-info">
        {{ session('mess') }}
    </div>
@endif

<div class="container-fluid">
    <div class="row">
          <div class="panel panel-default">
            <div class="panel-heading">Dodaj</div>
            <div class="panel-body">
  						<form class="form-horizontal" role="form" method="POST" action="{{ route('dodaj') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row container-fluid">
                  <?php $tags = App\Tag::all(); ?>
                  <ul class="tag-list list-inline">
                  @foreach($tags as $tag)
                    <!-- <a href="#"><li class="tag-option badge badge-success">{{$tag->name}}<i class="fa fa-plus-circle" aria-hidden="true"></i></li></a> -->
                    <input type="checkbox" name="tagi[]" id="in_{{$tag->name}}" value="{{$tag->name}}" autocomplete="off" />
                    <label class="tag-option badge badge-success noselect" for="in_{{$tag->name}}">
                      {{$tag->name}}
                      <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </label>
                  @endforeach
                  </ul>
                </div>


    						<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-2 control-label">Tytuł</label>

                    <div class="col-md-8">
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" maxlength="100" autofocus>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

    						<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label for="content" class="col-md-2 control-label">Treść</label>

                    <div class="col-md-8">
				                   <textarea id="content" name="content" type="text" class="form-control" rows="5" value="{{ old('content') }}" maxlength="1000" autofocus></textarea>
                          @if ($errors->has('content'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('content') }}</strong>
                              </span>
                          @endif
                    </div>
                </div>
<!-- dodaj obrazek -->
               <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                   <label for="image" class="col-md-2 control-label">Obrazek</label>

                   <div class="col-md-8">
                     <input type="file" name="image" id="image">
                         @if ($errors->has('image'))
                             <span class="help-block">
                                 <strong>{{ $errors->first('image') }}</strong>
                             </span>
                         @endif
                   </div>
               </div>
<!--- -->
              <div class="form-group{{ $errors->has('source') ? ' has-error' : '' }}">
                  <label for="source" class="col-md-2 control-label">Link do źródła</label>

                  <div class="col-md-8">
                    <input type="text" class="form-control" name="source" id="source" value="{{ old('source') }}">
                        @if ($errors->has('source'))
                            <span class="help-block">
                                <strong>{{ $errors->first('source') }}</strong>
                            </span>
                        @endif
                  </div>
              </div>

    						<div class="form-group">
                    <div class="col-md-6 col-md-offset-2">
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
