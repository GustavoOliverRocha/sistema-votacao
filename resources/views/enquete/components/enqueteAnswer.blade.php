@foreach($respostas as $r)
	<input id="resposta_{{$r->id}}" type="radio" name="enq_resposta" value="{{$r->id}}">
	<label for="resposta_{{$r->id}}">
		{{$r->resposta}}<br>votos: {{$r->votacoes}}
	</label>
	<br>
	<br>
@endforeach


