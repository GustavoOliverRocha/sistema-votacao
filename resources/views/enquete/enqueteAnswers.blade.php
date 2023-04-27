@extends('mainPage')
@section('content')
<div id="global">
    <div class="container-fluid" id="vue-avaliacao">
        <div class="panel panel-default">
            <div class="panel-heading">
            	<h3 class="text-center"> Votação</h3>
            </div> 
            <div class="panel-body">
			<h4 class="text-center">
				Data: {{\Carbon\Carbon::parse($enquete->start_date)->format('d/m/Y')}} até {{\Carbon\Carbon::parse($enquete->end_date)->format('d/m/Y')}}
			</h4>
			<h2 class="text-center">{{$enquete->titulo}}</h2>
			<div>
				<table class="table table-bordered">
					<form method="POST" action="{{route('opcao.votar')}}">
					@csrf
					<tbody>
						@foreach($respostas as $r)
						<tr>
							<td style="width: 80%">	
								<label for="resposta_{{$r->id}}">
									{{$r->resposta}}<!--<br>votos: {{$r->votacoes}}-->
								</label>
							</td>
							<td>
							    @if($enquete->end_date < date('Y-m-d') || $enquete->start_date > date('Y-m-d'))
							    	<input id="resposta_{{$r->id}}" type="radio" disabled>
							    @else
									<input id="resposta_{{$r->id}}" type="radio" name="enq_resposta" value="{{$r->id}}">
								@endif							
							</td>


							<br>
							<br>
						</tr>
						@endforeach
					</tbody>
					</form>
				</table>
				<!--<div id="opcoes">
					@foreach($respostas as $r)

					    @if($enquete->end_date < date('Y-m-d') || $enquete->start_date > date('Y-m-d'))
					    	<input id="resposta_{{$r->id}}" type="radio" disabled>
					    @else
							<input id="resposta_{{$r->id}}" type="radio" name="enq_resposta" value="{{$r->id}}">
						@endif

						<label for="resposta_{{$r->id}}">
							{{$r->resposta}}<br>votos: {{$r->votacoes}}
						</label>
						<br>
						<br>
					@endforeach
				</div>-->

				@if($enquete->end_date < date('Y-m-d') || $enquete->start_date > date('Y-m-d'))
						<button disabled>
							Confirmar
						</button>
				@else
						<button>
							Confirmar
						</button>
				@endif
			</div>
			


</div>


</div>
</div>
</div>
</div>

<script type="text/javascript"
		src="{{URL::asset('http://localhost/sistema-votacao/public/')}}js/jquery-3.6.0.min.js">
</script>
<script type="text/javascript">

	/*const atualizarRespostas = ()=>{
		$.ajax({
			url:'http://localhost/sistema-votacao/public/opcao/renderiza/{{$enquete->id}}',
			type: 'GET',
			success: (response)=>{
				$('#opcoes').html(response);
			}
		});
	}
	setInterval(atualizarRespostas, 5500);*/
</script>
@endsection
