@extends('mainPage')
@section('content')


<div id="global">
    <div class="container-fluid" id="vue-avaliacao">
        <div class="panel panel-default">
            <div class="panel-heading">
            	<h3 class="text-center"> Enquetes</h3>
            </div> 
            <div class="panel-body">
            	<div class="row">
					<form name="enqFormAdd" method="POST" action="{{route('enquete.save')}}">
						@csrf
						<div class="col-md-12 text-center">
							@if($errors->all())
								@foreach($errors->all() as $err)
									<div class="alert alert-danger" role="alert">
									  {{$err}}
									</div>
								@endforeach
							@endif
						</div>
						<div class="col-md-12">
							<div class="form-group">
							<label for="titulo">Titulo:</label>
							<input id="titulo" class="form-control" type="text" name="titulo" placeholder="Informe o Título da Enquete" value="{{$enquete->titulo}}" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label for="dt_inicio">Data de Inicio:</label>
							<input id="dt_inicio"class="form-control" type="date" name="dt_inicio" value="{{$enquete->start_date}}" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label for="dt_fim">Data de Término:</label>
							<input id="dt_fim"class="form-control" type="date" name="dt_fim" value="{{$enquete->end_date}}" required>
							</div>
						</div>
						<div class="col-md-6">
							<label for="titulo">Respostas(Minimo 3):</label>
							<span id="addOpt" class="btn btn-sm btn-success">+</span>
							<br>
							<div class="">
								<div class="formRespostas">
									@foreach($respostas as $r)
									<div class="form-group">						
										<div id="respostas_adicionais_{{$r->id}}" class="input-group">
											<input type="text" class="form-control" name="opcoes[]" placeholder="" value="{{$r->resposta}}">
												<span class="input-group-btn">
													<button class="opcoes btn btn-danger" type="button" onclick="$('#respostas_adicionais_{{$r->id}}').remove()">
															X
													</button>
												</span>
										</div>
									</div>
									@endforeach
								</div>
							</div>						
						</div>
						<div class="col-md-12 text-center">
							<button type="submit" class="btn btn-lg btn-primary">
								Salvar
							</button>	
						
						</div>

					</form>
            	</div>
            </div>
        </div>
    </div>
</div>

@include('enquete.components.scripts')
<script type="text/javascript"
		src="{{URL::asset('http://localhost/sistema-votacao/public/')}}js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
	var respostas_adicionais = 0;
	$('#addOpt').click(()=>{
		//let str = "<input id=\"\" type=\"text\" name=\"opcoes[]\"><br><br>";
		let str = `	<div class="form-group">						
		<div id="new_respostas_adicionais_${respostas_adicionais}" class="input-group">
			<input type="text" class="form-control" name="opcoes[]" placeholder="">
				<span class="input-group-btn">
					<button class="opcoes btn btn-danger" type="button" onclick="$('#new_respostas_adicionais_${respostas_adicionais}').remove()">
						X
					</button>
				</span>
		</div></div>`;
		$('.formRespostas').append(str);
		respostas_adicionais += 1;
	});
</script>

@endsection
