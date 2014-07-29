@extends('default')

@section('layout')
	
	<h1 class="page-header">
		({{ $tags->getTotal() }}) Tags
		{{ link_to_route('tags.create', 'Nuovo tag', null, ['class' => 'btn btn-primary pull-right']) }}
	</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Tags</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@foreach($tags as $tag)
			<tr>
				<td>{{ $tag['text'] }}</td>
				<td class="actions">
					{{ link_to_route('tags.edit', 'modifica', ['id' => $tag['id']], ['class' => 'btn btn-xs btn-primary']) }}
					{{ Form::open(['method' => 'DELETE', 'route' => ['tags.destroy', $tag['id']]]) }}
                        {{ Form::submit('elimina', ['class' => 'btn btn-xs btn-danger pl-ask']) }}
                    {{ Form::close() }}					
				</td>
			</tr>
		    @endforeach
	    </tbody>
	</table>

    {{ $tags->links() }}

@stop