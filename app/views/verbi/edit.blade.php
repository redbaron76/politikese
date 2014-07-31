@extends('default')

@section('layout')
	
	<h1 class="page-header">
		Nuovo verbo
		{{ link_to_route('verbi.index', 'Lista verbi', null, ['class' => 'btn btn-primary pull-right']) }}
	</h1>
	
	@if ($errors->any())
	<ul class="list-unstyled">
	{{ implode('', $errors->all('<li class="error"><div class="alert alert-danger" role="alert">:message</div></li>')) }}
	</ul>
	@endif
	
	@if(isset($verbo))
	{{ Form::model($verbo, ['method' => 'PATCH', 'route' => ['verbi.update', $verbo['id']]]) }}
	@else
	{{ Form::open(['route' => 'verbi.store']) }}
	@endif

	<div class="form-inline">
		<div class="form-group">
			{{ Form::label('text', 'Infinito') }}
			{{ Form::text('infinito', Input::old('infinito'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off']) }}
		</div>
	</div>

	<div class="form-inline">
		<div class="form-group">
			{{ Form::label('text', 'Presente') }}
			{{ Form::text('presente1s', Input::old('presente1s'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '1s']) }}
			{{ Form::text('presente3s', Input::old('presente3s'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '3s']) }}
			{{ Form::text('presente1p', Input::old('presente1p'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '1p']) }}
			{{ Form::text('presente3p', Input::old('presente3p'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '3p']) }}
		</div>
	</div>

	<div class="form-inline">
		<div class="form-group">
			{{ Form::label('text', 'Passato') }}
			{{ Form::text('passato1s', Input::old('passato1s'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '1s']) }}
			{{ Form::text('passato3s', Input::old('passato3s'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '3s']) }}
			{{ Form::text('passato1p', Input::old('passato1p'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '1p']) }}
			{{ Form::text('passato3p', Input::old('passato3p'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '3p']) }}
		</div>
	</div>

	<div class="form-inline">
		<div class="form-group">
			{{ Form::label('text', 'Riflessivo') }}
			{{ Form::text('riflessivo1s', Input::old('riflessivo1s'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '1s']) }}
			{{ Form::text('riflessivo3s', Input::old('riflessivo3s'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '3s']) }}
			{{ Form::text('riflessivo1p', Input::old('riflessivo1p'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '1p']) }}
			{{ Form::text('riflessivo3p', Input::old('riflessivo3p'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '3p']) }}
		</div>
	</div>

	<div class="form-inline">
		<div class="form-group">
			{{ Form::label('text', 'Congiuntivo') }}
			{{ Form::text('congiuntivo1s', Input::old('congiuntivo1s'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '1s']) }}
			{{ Form::text('congiuntivo3s', Input::old('congiuntivo3s'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '3s']) }}
			{{ Form::text('congiuntivo1p', Input::old('congiuntivo1p'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '1p']) }}
			{{ Form::text('congiuntivo3p', Input::old('congiuntivo3p'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => '3p']) }}
		</div>
	</div>

	<div class="form-inline">
		<div class="form-group">
			{{ Form::label('text', 'Participio') }}
			{{ Form::text('partpresente', Input::old('partpresente'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => 'presente']) }}
			{{ Form::text('partpassato', Input::old('partpassato'), ['class' => 'form-control', 'autocorrect' => 'off', 'autocapitalize' => 'off' 'placeholder' => 'passato']) }}
		</div>
	</div>

	<div class="form-inline">
		<div class="form-group">
			{{ Form::label('text', 'Gerundio') }}
			{{ Form::text('gerundio', Input::old('gerundio'), ['class' => 'form-control']) }}
		</div>
	</div>

	<div class="form-group" rel="articoli">
		{{ Form::label('articoli', 'Articoli') }}
		<select name="articoli[]" class="form-control select-articoli" multiple="multiple" placeholder="Aggiungere gli articoli appropriati per questa verbo">
			@if(isset($verbo->articoli))
			@foreach($verbo->articoli as $articolo)
			<option value="{{ $articolo['id'] }}" selected="selected">{{ $articolo['text'] }}</option>
			@endforeach
			@endif
		</select>
	</div>
	<div class="form-group" rel="preposizioni">
		{{ Form::label('preposizioni', 'Preposizioni') }}
		<select name="preposizioni[]" class="form-control select-preposizioni" multiple="multiple" placeholder="Aggiungere le preposizioni più appropriate per questa verbo">
			@if(isset($verbo->preposizioni))
			@foreach($verbo->preposizioni as $preposizione)
			<option value="{{ $preposizione['id'] }}" selected="selected">{{ $preposizione['text'] }}</option>
			@endforeach
			@endif
		</select>
	</div>
	<div class="form-group" rel="tags">
		{{ Form::label('tags', 'Tags') }}
		<select name="tags[]" class="form-control select-tags" multiple="multiple" placeholder="Aggiungere i tags appropriati per questa verbo">
			@if(isset($verbo->tags))
			@foreach($verbo->tags as $tag)
			<option value="{{ $tag['id'] }}" selected="selected">{{ $tag['text'] }}</option>
			@endforeach
			@endif
		</select>
	</div>	
	<div class="form-group submit">
		{{ Form::submit('Salva', ['class' => 'btn btn-primary']) }}
		{{ link_to_route('verbi.index', 'Indietro', null, ['class' => 'btn btn-default']) }}
	</div>

	{{ Form::close() }}

@stop

@section('footer-js')
	@parent
	{{ HTML::script('js/verbi/edit.js') }}
@stop