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

				<div class="panel panel-default">
	                    <div class="panel-heading">Apuração</div>	
	               	<table class="table table-bordered">
	                    <tbody>
		                    @foreach($respostas as $r)
		                        <tr>
		                            <td style="white-space:nowrap">{{$r->resposta}}</td>
		                            <td style="width:100%">
		                                <div class="progress">
		                                    <div class="progress-bar progress-bar-info" style="width:{{$r->votacao_porcentagem}}%"></div>
		                                </div>
		                            </td>
		                            <td> {{intval($r->votacao_porcentagem)}}%</td>
		                        </tr>
		                    @endforeach
	                    </tbody>
	                </table>
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
