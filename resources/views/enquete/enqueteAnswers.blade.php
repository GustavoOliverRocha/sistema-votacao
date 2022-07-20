@extends('mainPage')
@section('content')

<a href="{{route('enquete.show')}}">Voltar</a>

<h2>{{$enquete->titulo}}</h2>

<h4>Inicio: {{$enquete->start_date}}</h4>

<h4>Fim: {{$enquete->end_date}}</h4>

<form method="POST" action="{{route('opcao.votar')}}">
	@csrf

	<div id="opcoes">
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
	</div>

	@if($enquete->end_date < date('Y-m-d') || $enquete->start_date > date('Y-m-d'))
			<button disabled>
				Confirmar
			</button>
	@else
			<button>
				Confirmar
			</button>
	@endif
</form>

<script type="text/javascript"
		src="{{URL::asset('http://localhost/sistema-votacao/public/')}}js/jquery-3.6.0.min.js">
</script>
<script type="text/javascript">

	const atualizarRespostas = ()=>{
		$.ajax({
			url:'http://localhost/sistema-votacao/public/opcao/renderiza/{{$enquete->id}}',
			type: 'GET',
			success: (response)=>{
				$('#opcoes').html(response);
			}
		});
	}
	setInterval(atualizarRespostas, 5500);
</script>
@endsection
