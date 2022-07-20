@extends('mainPage')
@section('content')
<a href="{{route('enquete.show')}}"> <<--Voltar para lista</a>
	@if($errors->all())
	<ul style="color: red;">
		@foreach($errors->all() as $err)
			<li>{{$err}}</li>
		@endforeach
	</ul>
	@endif
<form name="enqFormAdd" method="POST" action="{{route('enquete.save')}}">
	@csrf
	<label for="titulo">Titulo:</label>
	<input id="titulo" type="text" name="titulo">
	<br><br>
	<label for="dt_inicio">Data de Inicio:</label>
	<!--<input id="dt_inicio" type="text" name="dt_inicio" placeholder="yyyy-mm-dd" maxlength="10">-->
	<input id="dt_inicio" type="date" name="dt_inicio">
	<br><br>
	<label for="dt_fim">Data de Término:</label>
	<!--<input id="dt_fim" type="text" name="dt_fim" placeholder="yyyy-mm-dd" maxlength="10">-->
	<input id="dt_fim" type="date" name="dt_fim">
	<br><br>
	<label for="titulo">Respostas(Minimo 3):</label>
	<span id="addOpt" class="btn">Adicionar+</span>
	<br>
	<div class="formRespostas">
		<input id="" type="text" name="opcoes[]"><br><br>
		<input id="" type="text" name="opcoes[]"><br><br>
		<input id="" type="text" name="opcoes[]"><br><br>
	</div>
	<br>
	<button type="submit" class="" onclick="()=>{$('[name=enqFormAdd]').submit();}">
		Confirmar
	</button>
</form> 
<script type="text/javascript"
		src="{{URL::asset('http://localhost/sistema-votacao/public/')}}js/jquery-3.6.0.min.js">
		</script>
<script type="text/javascript">

	$('#addOpt').click(()=>{
		let str = "<input id=\"\" type=\"text\" name=\"opcoes[]\"><br><br>";
		$('.formRespostas').append(str);
	});

	$('[name=enqFormAdd]').submit((element)=>{
	});
</script>
@endsection