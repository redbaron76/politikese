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
	
	@if(isset($espressione))
	{{ Form::model($espressione, ['method' => 'PATCH', 'route' => ['espressioni.update', $espressione['id']]]) }}
	@else
	{{ Form::open(['route' => 'espressioni.store']) }}
	@endif

	<div class="form-group">
		{{ Form::label('text', 'Espressione') }}
		{{ Form::text('text', Input::old('text'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off']) }}
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
	<div class="form-group" rel="articoli">
		{{ Form::label('articoli', 'Articoli') }}
		<select name="articoli[]" class="form-control select-articoli" multiple="multiple" placeholder="Aggiungere gli articoli appropriati per questa espressione">
			@if(isset($espressione->articoli))
			@foreach($espressione->articoli as $articolo)
			<option value="{{ $articolo['id'] }}" selected="selected">{{ $articolo['text'] }}</option>
			@endforeach
			@endif
		</select>
	</div>
	<div class="form-group" rel="preposizioni">
		{{ Form::label('preposizioni', 'Preposizioni') }}
		<select name="preposizioni[]" class="form-control select-preposizioni" multiple="multiple" placeholder="Aggiungere le preposizioni più appropriate per questa espressione">
			@if(isset($espressione->preposizioni))
			@foreach($espressione->preposizioni as $preposizione)
			<option value="{{ $preposizione['id'] }}" selected="selected">{{ $preposizione['text'] }}</option>
			@endforeach
			@endif
		</select>
	</div>
	<div class="form-group" rel="tags">
		{{ Form::label('tags', 'Tags') }}
		<select name="tags[]" class="form-control select-tags" multiple="multiple" placeholder="Aggiungere i tags appropriati per questa espressione">
			@if(isset($espressione->tags))
			@foreach($espressione->tags as $tag)
			<option value="{{ $tag['id'] }}" selected="selected">{{ $tag['text'] }}</option>
			@endforeach
			@endif
		</select>
	</div>	
	<div class="form-group submit">
		{{ Form::submit('Salva', ['class' => 'btn btn-primary']) }}
		{{ link_to_route('espressioni.index', 'Indietro', null, ['class' => 'btn btn-default']) }}
	</div>

	{{ Form::close() }}

@stop

@section('footer-js')
	@parent
	{{ HTML::script('js/espressioni/edit.js') }}
@stop