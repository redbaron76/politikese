@extends('default')

@section('layout')
	
	<h1 class="page-header">
		({{ $espressioni->getTotal() }}) Espressioni
		{{ link_to_route('espressioni.create', 'Nuova espressione', null, ['class' => 'btn btn-primary pull-right']) }}
	</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Espressione</th>
				<th>Genere</th>
				<th>Numero</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@foreach($espressioni as $espressione)
			<tr>
				<td>{{ $espressione['text'] }}</td>
				<td>{{ $espressione['genere'] }}</td>
				<td>{{ $espressione['numero'] }}</td>
				<td class="actions">
					{{ link_to_route('espressioni.edit', 'modifica', ['id' => $espressione['id']], ['class' => 'btn btn-xs btn-primary']) }}
					{{ Form::open(['method' => 'DELETE', 'route' => ['espressioni.destroy', $espressione['id']]]) }}
                        {{ Form::submit('elimina', ['class' => 'btn btn-xs btn-danger pl-ask']) }}
                    {{ Form::close() }}					
				</td>
			</tr>
		    @endforeach
	    </tbody>
	</table>

    {{ $espressioni->links() }}

@stop