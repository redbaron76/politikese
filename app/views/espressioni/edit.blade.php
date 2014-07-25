@extends('default')

@section('layout')
	
	<h1 class="page-header">
		Nuova espressione
		{{ link_to_route('espressioni.index', 'Lista espressioni', null, ['class' => 'btn btn-primary pull-right']) }}
	</h1>
	
	@if ($errors->any())
	<ul class="list-unstyled">
	{{ implode('', $errors->all('<li class="error"><div class="alert alert-danger" role="alert">:message</div></li>')) }}
	</ul>
	@endif

	{{ Form::model($espressione, ['method' => 'PATCH', 'route' => ['espressioni.update', $espressione['id']]]) }}

	<div class="form-group">
		{{ Form::label('text', 'Espressione') }}
		{{ Form::text('text', Input::old('text'), ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('genere', 'Genere') }}
		<div class="checkbox">
			<label class="radio-inline">
				{{ Form::radio('genere', 'm') }} Maschile
			</label>
			<label class="radio-inline">
				{{ Form::radio('genere', 'f') }} Femminile
			</label>
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('numero', 'Numero') }}
		<div class="checkbox">
			<label class="radio-inline">
				{{ Form::radio('numero', 's') }} Singolare
			</label>
			<label class="radio-inline">
				{{ Form::radio('numero', 'p') }} Plurale
			</label>
		</div>
	</div>
	
	<div class="form-group submit">
		{{ Form::submit('Salva', ['class' => 'btn btn-primary']) }}
		{{ link_to_route('espressioni.index', 'Indietro', null, ['class' => 'btn btn-default']) }}
	</div>

	{{ Form::close() }}

@stop