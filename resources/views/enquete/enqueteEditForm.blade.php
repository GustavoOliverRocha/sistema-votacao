@extends('mainPage')
@section('content')
<a href="{{route('enquete.show')}}">voltar para lista</a>
	@if($errors->all())
	<ul style="color: red;">
		@foreach($errors->all() as $err)
			<li>{{$err}}</li>
		@endforeach
	</ul>
	@endif
<form method="POST" id="editForm" name="enqFormEdit" action="{{route('enquete.update',['enq_id'=> $enquete->id])}}">
	@csrf
	@method('PUT')
	<label for="titulo">Titulo:</label>
	<input id="titulo" type="text" name="titulo" value="{{$enquete->titulo}}">
	<br>
	<label for="dt_inicio">Data de Inicio:</label>
	<input id="dt_inicio" type="date" name="dt_inicio" value="{{$enquete->start_date}}">
	<br>
	<label for="dt_fim">Data de Término:</label>
	<input id="dt_fim" type="date" name="dt_fim" value="{{$enquete->end_date}}">
	<br>
	<label for="titulo">Respostas(Minimo 3):</label>
	<br>
	<div class="formRespostas">
	@foreach($respostas as $r)
		<div class="opcao">
			<input id="" type="text" name="opcoes[]" value="{{$r->resposta}}">
			<input id="" type="hidden" name="op_id[]" value="{{$r->id}}">
			<button type="submit" onclick="deletarOpcao({{$r->id}})">X</button>
		</div>
	@endforeach
	</div>
	<br>
	<button type="submit" onclick="$('[name=enqFormEdit]').submit()">
		Confirmar
	</button>

</form> 
@foreach($respostas as $r)
			<form name="deleteOpt{{$r->id}}" method="POST" action="{{route('opcao.destroy',['op_id' => $r->id])}}" hidden>
				@csrf
				@method('DELETE')
				<input type="hidden" name="op_id" value="{{$r->id}}">
				<input type="hidden" name="sizeofOpt" value="{{sizeof($respostas)}}">
			</form>
@endforeach
<script type="text/javascript"
		src="{{URL::asset('http://localhost/sistema-votacao/public/')}}js/jquery-3.6.0.min.js">
</script>
<script type="text/javascript">
	const deletarOpcao = (optId)=>{
		$('[name=enqFormEdit]').submit((event)=>{
			event.preventDefault();
		});
		$('[name=deleteOpt'+optId+']').submit();
	}
	
</script>
@endsection

