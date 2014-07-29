@extends('default')

@section('layout')
	
	<h1 class="page-header">
		Nuovo avverbio
		{{ link_to_route('avverbi.index', 'Lista avverbi', null, ['class' => 'btn btn-primary pull-right']) }}
	</h1>
	
	@if ($errors->any())
	<ul class="list-unstyled">
	{{ implode('', $errors->all('<li class="error"><div class="alert alert-danger" role="alert">:message</div></li>')) }}
	</ul>
	@endif
	
	@if(isset($avverbio))
	{{ Form::model($avverbio, ['method' => 'PATCH', 'route' => ['avverbi.update', $avverbio['id']]]) }}
	@else
	{{ Form::open(['route' => 'avverbi.store']) }}
	@endif

	<div class="form-group">
		{{ Form::label('text', 'Avverbio') }}
		{{ Form::text('text', Input::old('text'), ['class' => 'form-control']) }}
	</div>

	<div class="form-group" rel="tags">
		{{ Form::label('tags', 'Tags') }}
		<select name="tags[]" class="form-control select-tags" multiple="multiple" placeholder="Aggiungere i tags appropriati per questa avverbio">
			@if(isset($avverbio->tags))
			@foreach($avverbio->tags as $tag)
			<option value="{{ $tag['id'] }}" selected="selected">{{ $tag['text'] }}</option>
			@endforeach
			@endif
		</select>
	</div>	
	<div class="form-group submit">
		{{ Form::submit('Salva', ['class' => 'btn btn-primary']) }}
		{{ link_to_route('avverbi.index', 'Indietro', null, ['class' => 'btn btn-default']) }}
	</div>

	{{ Form::close() }}

@stop

@section('footer-js')
	@parent
	{{ HTML::script('js/avverbi/edit.js') }}
@stop