@extends('default')

@section('layout')
	
	<h1 class="page-header">
		({{ $espressioni->getTotal() }}) Espressioni
		{{ link_to_route('espressioni.create', 'Nuova espressione', null, ['class' => 'btn btn-primary pull-right']) }}
	</h1>

	<table class="table">
		<thead>
			<tr>		
				<th>Preposizioni</th>
				<th>Articoli</th>				
				<th>Espressione</th>
				<th>Tags</th>
				<th>G</th>
				<th>N</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@foreach($espressioni as $espressione)
			<tr>				
				<td>
					@foreach($espressione['preposizioni'] as $preposizione)
						<span class="label label-default">{{ $preposizione['text'] }}</span>
					@endforeach
				</td>
				<td>
					@foreach($espressione['articoli'] as $articolo)
						<span class="label label-default">{{ $articolo['text'] }}</span>
					@endforeach
				</td>				
				<td>{{ $espressione['text'] }}</td>
				<td>
					@foreach($espressione['tags'] as $tag)
						<span class="label label-default">{{ $tag['text'] }}</span>
					@endforeach
				</td>
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