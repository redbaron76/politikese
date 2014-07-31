@extends('default')

@section('layout')
	
	<h1 class="page-header">
		Nuovo tag
		{{ link_to_route('tags.index', 'Lista tags', null, ['class' => 'btn btn-primary pull-right']) }}
	</h1>
	
	@if ($errors->any())
	<ul class="list-unstyled">
	{{ implode('', $errors->all('<li class="error"><div class="alert alert-danger" role="alert">:message</div></li>')) }}
	</ul>
	@endif
	
	@if(isset($tag))
	{{ Form::model($tag, ['method' => 'PATCH', 'route' => ['tags.update', $tag['id']]]) }}
	@else
	{{ Form::open(['route' => 'tags.store']) }}
	@endif

	<div class="form-group">
		{{ Form::label('text', 'Tag') }}
		{{ Form::text('text', Input::old('text'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off']) }}
	</div>

	<div class="form-group submit">
		{{ Form::submit('Salva', ['class' => 'btn btn-primary']) }}
		{{ link_to_route('tags.index', 'Indietro', null, ['class' => 'btn btn-default']) }}
	</div>

	{{ Form::close() }}

@stop

@section('footer-js')
	@parent
	{{ HTML::script('js/tags/edit.js') }}
@stop