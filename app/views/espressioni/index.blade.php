@extends('default')

@section('layout')
	
	<h2 class="page-header">Espressioni</h2>

	{{ $espressioni->links() }}

	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Testo</th>
				<th>Genere</th>
				<th>Numero</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@foreach($espressioni as $espressione)
			<tr>
				<td>{{ $espressione['id'] }}</td>
				<td>{{ $espressione['text'] }}</td>
				<td>{{ $espressione['genere'] }}</td>
				<td>{{ $espressione['numero'] }}</td>
				<td>
					{{ link_to_route('espressioni.edit', 'modifica', ['id' => $espressione['id']], ['class' => 'btn btn-xs btn-primary']) }}
					{{ link_to_route('espressioni.destroy', 'elimina', ['id' => $espressione['id']], ['class' => 'btn btn-xs btn-danger']) }}
				</td>
			</tr>
		    @endforeach
	    </tbody>
	</table>

    {{ $espressioni->links() }}

@stop