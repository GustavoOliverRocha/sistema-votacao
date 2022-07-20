@extends('mainPage')
@section('content')
<a href="{{route('enquete.form')}}">Adicionar Enquete</a>
<table border="1px">
	<thead>
		<th>ID</th>
		<th>Titulo</th>
		<th>Inicio</th>
		<th>Fim</th>
		<th>Estado</th>
		<th colspan="2">Ação</th>
	</thead>
	<tbody>
		@foreach($enquete as $e)
			<tr>
				<td>{{ $e->id }}</td>
				<td>
					<a href="{{route('enquete.answers',['enq_id' => $e->id])}}">
						{{ $e->titulo }}
					</a>
				</td>
				<td>{{ $e->start_date }}</td>
				<td>{{ $e->end_date }}</td>

				@if($e->start_date > date('Y-m-d'))
					<td style="color: red;">Não Iniciada</td>
				@elseif($e->end_date < date('Y-m-d'))
					<td style="color: green;">Finalizada</td>
				@else	
					<td style="color: blue;">Em andamento</td>
				@endif

				<td>
					<a href="{{route('enquete.editForm',['enq_id' => $e])}}">
						Editar
					</a>
				</td>
				<td>
					<form method="POST" action="{{route('enquete.destroy',['enq_id' => $e])}}">
						@csrf
						@method('DELETE')
						<button type="submit">Excluir</button>
					</form>
						
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endsection