@extends('layouts/app')

@section('content')

	<div class="row">

			<div class="col-md-12">
				<div class="row">
					<div class="dados_cliente col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading text-center">
								Dados Cliente
							</div>
							<div class="panel-body">

								@if($cliente->ativo == 1)
									<div class="alert alert-success">
										Esse Cliente esta ATIVO
									</div>
								@else
									<div class="alert alert-danger">
										Esse Cliente esta INATIVO
									</div>
								@endif

								<div class="form-group">
									<label>Nome:</label>
									<input class="form-control" type="text" name="name" value="{!!$cliente->nome!!}" disabled>
								</div>

								<div class="form-group">
									<label>CPF:</label>
									<input class="form-control" type="text" name="cpf" value="{{$cliente->CPF}}" disabled>
								</div>
								
							
								@if(isset($cliente->agendaHora[0]->id))
									<div class="alert alert-danger">
										<div class="text-center">
											<strong>Agenda Retorno</strong>
										</div>
										
										<table class="table table-condensed">
											<thead>
												<th >Data Horario</th>
												<th>Agente</th>
												<th class="text-left">Concluir Lembrete</th>
											</thead>
											<tbody>
												@foreach($cliente->agendaHora as $a)
													<tr>
														<td>{{date('d/m/y H:i', strtotime($a->data))}}</td>
														<td>{{$a->user->name}}</td>
														<td>
															<a href="{{url('cliente/agendaHora')}}/{{$a->id}}" class="btn btn-success btn-block">Concluir</a> 
														</td>
													</tr>
													
												@endforeach
											</tbody>
										</table>
									</div>
									<hr>
								@endif
								<!--
								<div class="form-group">
									<label>Pesquisa:</label>
									<select  class="form-control" name='pesquisa'>
										<option value="0" selected disabled>NÃO INFORMADO</option>
										<option value="1">NÃO FOI NECESSARIO</option>
										<option value="2">PESQUISA COM SUCESSO</option>
										<option value="3">PESQUISA SEM SUCESSO</option>
									</select>
								</div>	-->							
								
							</div>
						</div>

					</div>
					<div class="dados_produto col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading text-center">
								Dados Produto
							</div>
							<div class="panel-body">
								@if(!$cliente->produto->isEmpty())
									@foreach($cliente->produto as $p)
									<div class="form-group">
										<label>Carteira:</label>
										<span>{{$p->carteira->nome}}</span>
									</div>
									

									<div class="form-group">
										<label>Produto:</label>
										<span>{!!$p->nome!!}</span>
									</div>
									
									<div class="form-group">
										<label>ID Produto Marketplace:</label>
										<span>{{$p->id_pedido_marketplace}}</span>
									</div>

									<div class="form-group">
										<label>ID Produto:</label>
										<span>{{$p->id_produto}}</span>
									</div>

									<div class="form-group">
										<label>Markplace:</label>
										<span>{{$p->marketplace->nome}}</span>
									</div>
									@if(isset($p->link))
										<div class="form-group">
											<label>Link:</label>
											<span><a href="{{$p->link}}" target="_NEW">EAGLE</a></span>
										</div>
									@endif
									<hr>
									@endforeach
								@else

									<div class="alert alert-info">
										Nenhum Produto Achado
									</div>
								
								@endif
							</div>
						</div>

					</div>

					<div class="dados_contato col-md-12">
						

						<div class="panel panel-primary">
							<div class="panel-heading text-center">
								Dados Contato
							</div>
							<div class="panel-body">

									@foreach($cliente->telefone as $t)
										<form method="post" action="{{url('cliente/salvaTelefone')}}" >
											<input value="{{csrf_token()}}" name="_token" type="hidden">
											<input value="{{$t->id}}" name="id" type="hidden">
											<div class="form-group">
												
												<div class="row">
													<div class="col-md-3">
														<label>Telefone	</label>
														<input class="form-control" type="text" name="telefone" value="{{$t->telefone}}">
													</div>

													<div class="col-md-3">
														<label>Status</label>
														<select class="form-control" name="status_id">
															@foreach($status as $s)
																	@if($s->id == $t->status_id)
																		<option value="{{$s->id}}" selected>{!!$s->status!!}</option>
																	@else
																		<option value="{{$s->id}}">{!!$s->status!!}</option>
																	@endif
																	
															@endforeach
														</select>
													</div>

													<div class="col-md-2">
														<label>whatsapp</label>
														<select name="wpp_id" class="form-control">
															@foreach($wpp as $w)
																	@if($w->id == $t->wpp_id)
																		<option value="{{$w->id}}" selected>{!!$w->nome!!}</option>
																	@else
																		<option value="{{$w->id}}">{!!$w->nome!!}</option>
																	@endif
																	
															@endforeach
															
														</select>
													</div>
													
													<div class="col-md-4">
														<label for="">.</label>
														<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

															<div class="btn-group mr-2">
																<button class="btn btn-success" >
																	<i class="fas fa-save"></i>
																</button>
															</div>

															<div class="btn-group mr-2">
																<a class="btn btn-success" href="SIP:0{{$t->telefone}}">
																	<i class="fas fa-phone"></i>
																</a>
																@if(isset($cliente->produto[0]))
																	<a href="{{url('/link')}}/{{$cliente->id}}/3/{{$t->telefone}}/{{$cliente->produto[0]->id_pedido_marketplace}}" class="btn btn-primary">
																		<i class="far fa-comment"></i>
																	</a>
																	<a target="_new" href="{{url('/link')}}/{{$cliente->id}}/2/{{$t->telefone}}/{{$cliente->produto[0]->id_pedido_marketplace}}" class="btn btn-success">
																		<i class="fab fa-whatsapp"></i>
																	</a>
																@else
																	<a href="{{url('/link')}}/{{$cliente->id}}/3/{{$t->telefone}}/00-999999999" class="btn btn-primary">
																		<i class="far fa-comment"></i>
																	</a>
																	<a target="_new" href="{{url('/link')}}/{{$cliente->id}}/2/{{$t->telefone}}/00-999999999" class="btn btn-success">
																		<i class="fab fa-whatsapp"></i>
																	</a>
																@endif
															</div>

														</div>
													</div>
												</div>
											</div>
										</form>
									@endforeach





									@foreach($cliente->email as $e)
										<form method="post" action="{{url('cliente/salvaEmail')}}" >
											<input value="{{csrf_token()}}" name="_token" type="hidden">
											<input value="{{$e->id}}" name="id" type="hidden">
											<div class="form-group">
												<label>E-MAIL:</label>
												<div class="row">
													<div class="col-md-5">
														<input class="form-control" type="text" name="email" value="{{$e->email}}">
													</div>
													<div class="col-md-5">
														<select class="form-control" name="status_id">
															@foreach($status as $s)
																	@if($s->id == $e->status_id)
																		<option  selected value="{{$s->id}}">{!!$s->status!!}</option>
																	@else
																		<option value="{{$s->id}}">{!!$s->status!!}</option>
																	@endif
																	
															@endforeach
														</select>
													</div>

													<div class="col-md-2">
														<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
															<div class="btn-group mr-2">
																<button class="btn btn-success" >
																	<i class="fas fa-save"></i>
																</button>
															</div>

															<div class="btn-group mr-2">
																@if(isset($cliente->produto[0]))
																	<a target="_new" href="{{url('/link')}}/{{$cliente->id}}/1/{{$e->email}}/{{$cliente->produto[0]->id_pedido_marketplace}}" class="btn btn-danger btn-block"><i class="fas fa-at"></i></a>
																@else
																	<a target="_new" href="{{url('/link')}}/{{$cliente->id}}/1/{{$e->email}}/00-999999999" class="btn btn-danger btn-block"><i class="fas fa-at"></i></a>
																@endif
															</div>

														</div>
														
													</div>
												</div>
											</div>
										</form>
									@endforeach
									<hr>

									<div class="row">


										<div class="col-md-12">
											<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
												<div class="btn-group mr-2" role="group" aria-label="First group">
												    <a href="{{url("cliente/addTelefone")}}/{{$cliente->id}}" class="btn btn-success">
														<i class="fas fa-phone-square"></i>
														Adicionar Telefone 
													</a>

													<a href="{{url("cliente/addEmail")}}/{{$cliente->id}}" class="btn btn-danger">
														<i class="fas fa-at"></i>
														Adicionar E-MAIL
													</a>

												</div>
											</div>
										</div>	
									</div>

								</form>

							</div><!--Panel Body Contato-->
						</div>
					</div>

				</div>
			</div>

			<div class="col-md-12">
				<div class="row">
					<div class="dados_ocorrencia col-md-12">
						<div class="panel panel-primary">

							<div class="panel-heading text-center">
								Ocorrencias
							</div>
							<div class="panel-body">

								<a class="btn btn-danger" onclick="javascript:$('#agendahora').toggle();">Agenda Hora</a>
								
								<div class="alert alert-danger hiddenEl" id="agendahora">
									<div class="text-center">
										<strong>
											Adicionar Lembrete de Retorno
										</strong>
									</div>
									<form method="post" action="{{url('cliente/agendaHora')}}" >
										<input value="{{csrf_token()}}" name="_token" type="hidden">
										<input value="{{$cliente->id}}" name="cliente_id" type="hidden">
										<input value="{{Auth::user()->id}}" name="user_id" type="hidden" >
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													
													<input type="date" class="form-control" id="dataLembrete" name="dataLembrete" value={{date('Y-m-d')}}> 
												</div>						
											</div>

											<div class="col-md-4">
												<div class="form-group">
													
													<input type="time" class="form-control" id="horaLembrete" name="horaLembrete" value={{date('H:i')}}> 
												</div>						
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<button class="btn btn-primary btn-block" type='submit'>Agendar</button>
												</div>
											</div>
										</div>
									</form>
								
								</div>
								

								<hr>

								<form method="post" action="{{url('cliente/salvaOcorrencia')}}" >
									<input value="{{csrf_token()}}" name="_token" type="hidden">
									<input value="{{$cliente->id}}" name="cliente_id" type="hidden">
									<input value="{{ Auth::user()->id }}" name="user" type="hidden">
									<div class="form-group">
										<label>Nova Ocorrencia</label>

										<textarea class="form-control" name='ocorrencia'>
											
										</textarea>	
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<button class="btn btn-success btn-block" type="submit">
													<i class="fas fa-save"></i>
													Salvar Ocorrencia
												</button>	
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<select  class="form-control" name='situacao' id="situacao"> 
													@foreach($situacao as $s)
														@if($s->id == $cliente->situacao_id)
															<option class="{{$s->canal}}" selected value="{{$s->id}}">{!!$s->nome!!}</option>
														@else
															<option class="{{$s->canal}}" value="{{$s->id}}">{!!$s->nome!!}</option>
														@endif
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-md-4" id="canais">
											<div class="form-group">
												<select name="canal" id="canal" class="form-control">
													@foreach($canal as $c)
														<option class="1" value="{{$c->id}}">{!! $c->nome !!}</option>			
													@endforeach
												</select>
											</div>
										</div>

									</div>
								</form>

								@foreach($ocorrencia as $oco)
									<ul class="list-group">
										<li class="list-group-item">
											<label>{!!$oco->created_at!!} | {!!$oco->situacao->nome!!} | {!!$oco->user->name!!} | {!! $oco->canal->nome !!}</label>
											<div class="thumbnail">

												<span>{!! $oco->ocorrencia!!}</span>
											</div>
										</li>

									</ul>

								@endforeach

								{!! $ocorrencia !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		
	</div>
	
@stop

@extends('layouts.footer')