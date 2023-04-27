@extends('mainPage')
@section('content')
<!--<a href="{{route('enquete.form')}}">Adicionar Enquete</a>
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
</table>-->



<div id="global">
    <div class="container-fluid" id="vue-avaliacao">
        <div class="panel panel-default">
            <div class="panel-heading">
            	<h3 class="text-center"> Enquetes</h3>
            </div> 
            <div class="panel-body">
                <!--<a class="btn btn-primary" href="{{route('enquete.form')}}" >
                	<i class="fa fa-arrow-left"></i> Adicionar Enquete
                </a>-->
                <input type="hidden" name="grade_id" id="grade_id" value="${grade_id}">
                <div v-if="error == 'true'">
                    <br>
                    <h3 class="text-center text-uppercase text-danger">
                        <strong></strong>
                    </h3>
                    <br>
                </div>
                <div  v-if="error == 'false'">
                    <table id="avaliacoes-grid" class="table table-striped table-responsive text-center">
                        <thead>
							<th class="text-center">Titulo</th>
							<th class="text-center">Inicio</th>
							<th class="text-center">Fim</th>
							<th class="text-center">Estado</th>
							<th colspan="2" class="text-center">Ação</th>
                        </thead>
                        <tbody>
                        @foreach($enquete as $e)
                        <tr id="avaliacao.avaliacao_id">
							<td>
								<a href="{{route('enquete.answers',['enq_id' => $e->id])}}">
									{{ $e->titulo }}
								</a>
							</td>
							<td>{{ \Carbon\Carbon::parse($e->start_date)->format('d/m/Y')  }}</td>
							<td>{{ \Carbon\Carbon::parse($e->end_date)->format('d/m/Y')  }}</td>
							<td>
								@if($e->start_date > date('Y-m-d'))
									<span style="color: red;">Não Iniciada</span>
								@elseif($e->end_date < date('Y-m-d'))
									<span style="color: green;">Finalizada</span>
								@else	
									<span style="color: blue;">Em andamento</span>
								@endif
							</td>
                            <td class=""> 
                                <a class="protip btn btn-warning btn-sm btn-editar-aluno" href="{{route('enquete.apuracao',['enq_id' => $e])}}"
                                   data-pt-title="Apuração"
                                   data-pt-scheme="dark"
                                   data-pt-position="top"
                                   data-pt-animate="zoomIn"
                                >
                                    <i class="fa fa-list-ol"></i> <span class="visible-xs">Apuração</span>
                                </a>   
                                <a class="protip btn btn-primary btn-sm btn-editar-aluno" href="{{route('enquete.editForm',['enq_id' => $e])}}"
                                   data-pt-title="Editar"
                                   data-pt-scheme="dark"
                                   data-pt-position="top"
                                   data-pt-animate="zoomIn"
                                >
                                    <i class="fa fa-edit"></i> <span class="visible-xs">Editar</span>
                                </a>
                                <a class="protip hidden-xs btn btn-danger btn-sm btn-remove-aluno"
                                   data-pt-title="Remover"
                                   data-pt-scheme="dark"
                                   data-pt-position="top"
                                   data-pt-animate="zoomIn"
                                >
                                    <i class="fa fa-remove"></i>
                                </a>
								<!--<form method="POST" action="{{route('enquete.destroy',['enq_id' => $e])}}">
									@csrf
									@method('DELETE')
									<button type="submit">Excluir</button>
								</form>-->
                            </td>
                        </tr>
                        @endforeach
                        </tbody> 
                    </table>
                </div>
            </div>
        </div>
    </div> 
    <footer class="cm-footer"><span class="pull-left hidden-xs">Conectado como ${usuario_nome}</span><span class="pull-right">&copy; ${config_author}</span></footer>
</div>
@include('enquete.components.scripts')
<script src="{{env('APP_URL')}}/jquery/protip-tooltip/protip.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $.protip();
        $('#menu-lista-enquete').addClass('active');
    });
</script>
@endsection