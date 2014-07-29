@extends('default')

@section('layout')
	
	<h1 class="page-header">
		({{ $verbi->getTotal() }}) Verbi
		{{ link_to_route('verbi.create', 'Nuovo verbo', null, ['class' => 'btn btn-primary pull-right']) }}
	</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Infinito</th>
				<th>Declinazioni</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@foreach($verbi as $verbo)
			<tr>
				<td>{{ $verbo['infinito'] }}</td>
				<td>{{ $verbo['presente1s'] .' '. $verbo['presente3s'] .' '. $verbo['presente1p'] .' '. $verbo['presente3p'] .'<br>'. $verbo['passato1s'] .' '. $verbo['passato3s'] .' '. $verbo['passato1p'] .' '. $verbo['passato3p'] .'<br>'. $verbo['riflessivo1s'] .' '. $verbo['riflessivo3s'] .' '. $verbo['riflessivo1p'] .' '. $verbo['riflessivo3p'] .'<br>'. $verbo['congiuntivo1s'] .' '. $verbo['congiuntivo3s'] .' '. $verbo['congiuntivo1p'] .' '. $verbo['congiuntivo3p'] .'<br>'. $verbo['partpresente'] .' '. $verbo['partpassato'] .'<br>'. $verbo['gerundio'] }}</td>
				<td class="actions">
					{{ link_to_route('verbi.edit', 'modifica', ['id' => $verbo['id']], ['class' => 'btn btn-xs btn-primary']) }}
					{{ Form::open(['method' => 'DELETE', 'route' => ['verbi.destroy', $verbo['id']]]) }}
                        {{ Form::submit('elimina', ['class' => 'btn btn-xs btn-danger pl-ask']) }}
                    {{ Form::close() }}					
				</td>
			</tr>
		    @endforeach
	    </tbody>
	</table>

    {{ $verbi->links() }}

@stop