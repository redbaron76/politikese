@extends('default')

@section('layout')
	
	<h1 class="page-header">
		({{ $avverbi->getTotal() }}) Avverbi
		{{ link_to_route('avverbi.create', 'Nuovo avverbio', null, ['class' => 'btn btn-primary pull-right']) }}
	</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Avverbi</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@foreach($avverbi as $tag)
			<tr>
				<td>{{ $tag['text'] }}</td>
				<td class="actions">
					{{ link_to_route('avverbi.edit', 'modifica', ['id' => $tag['id']], ['class' => 'btn btn-xs btn-primary']) }}
					{{ Form::open(['method' => 'DELETE', 'route' => ['avverbi.destroy', $tag['id']]]) }}
                        {{ Form::submit('elimina', ['class' => 'btn btn-xs btn-danger pl-ask']) }}
                    {{ Form::close() }}					
				</td>
			</tr>
		    @endforeach
	    </tbody>
	</table>

    {{ $avverbi->links() }}

@stop