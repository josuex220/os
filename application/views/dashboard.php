<?php $this->load->view('includes/header')?>
   
	<?php $this->load->view('includes/menu')?>
    
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">Geral
					<a class="btn app-btn-primary" href="/os/add" style="margin-left:15px;float:right;">Abrir OS</a>
				</h1>
				
				<div class="alert alert-primary" role="alert">
				Bem vindo, <?=getNameByUserId($this->session->userdata('user_id'))?>
				</div>
				<?php $this->load->view('includes/alerts'); ?>

				    
			    <div class="row g-4 mb-4">
					<div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">OS em aberto</h4>
							    <div class="stats-figure"><?=$stats['os']['aberto']?></div>
							   
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="/os/status/1"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->

					<div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">OS em andamento</h4>
							    <div class="stats-figure"><?=$stats['os']['andamento']?></div>
							   
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="/os/status/2"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->

					<div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">OS finalizados</h4>
							    <div class="stats-figure"><?=$stats['os']['finalizado']?></div>
							   
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="/os/status/3"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->

					<div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Cancelados</h4>
							    <div class="stats-figure"><?=$stats['os']['cancelado']?></div>
							   
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="/os/status/4"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->

					<?php if($this->session->userdata('roles') != "TECNICO" && $this->session->userdata('roles') != "USER"){ ?>		
					<div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Setores</h4>
							    <div class="stats-figure"><?=$stats['total_setor']?></div>
							   
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="/setor"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->

					
					<div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Funcionarios</h4>
							    <div class="stats-figure"><?=$stats['total_funcionarios']?></div>
							   
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="/funcionarios"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
					<?php } ?>

					<?php if($this->session->userdata('roles') != "USER"){ ?>		
					
					<div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Equipamentos</h4>
							    <div class="stats-figure"><?=$stats['total_equipamentos']['eqp']?></div>
							   
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="/equipamento"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->

					
					<div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Impressora</h4>
							    <div class="stats-figure"><?=$stats['total_equipamentos']['imp']?></div>
							   
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="/impressora"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->

					<?php } ?>

			    </div><!--//row-->
				

				<div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Lista de Ordem de Serviços</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <div class="table-search-form row gx-1 align-items-center">
					                    <div class="col-auto">
					                        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Digite o ID da OS ou o nome do cliente">
					                    </div>
					                </div>
					                
							    </div><!--//col-->
							    
							    
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
			    
			   
				
				<div class="tab-content" id="orders-table-tab-content">
			        
			        <div class="tab-pane fade active show" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">ID OS</th>
												<th class="cell">Ref. Equipamento</th>
												<th class="cell">Funcionario</th>
												<th class="cell">Setor</th>
												<th class="cell">Data Abertura</th>
												<th class="cell">Tecnico</th>
												<th class="cell">Status</th>
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if($getOSPends){
												foreach ($getOSPends as $key => $os) {
												?>
												<tr>
													<td class="cell">#OS-<?=OSNumber($os->id_os)?></td>
													<td class="cell"><span class="truncate"><?=$os->ref?></span></td>
													<td class="cell"><?=$os->name?></td>
													<td class="cell"><?=$os->setor_name?></td>
													<td class="cell"><span class="cell-data"><?=formatarHorario(explode(" ",$os->data_hora)[0], explode(" ",$os->data_hora)[1])['data']?></span><span class="note"><?=formatarHorario(explode(" ",$os->data_hora)[0], explode(" ",$os->data_hora)[1])['hora']?></span></td>
													<td class="cell"><?=$os->tecnico_name?></td>
													<td class="cell"><?=getStatus($os->status)?></td>
													<td class="cell">
														<a class="btn-sm app-btn-secondary btn-modal"  data-toggle="modal" data-target="#OSModal" data-os="<?=$os->id_os?>" data-osNumber="#OS-<?=OSNumber($os->id_os)?>" href="javascript:void(0)">Checar</a>
														<?php if($os->status != 4 && $os->status != 3 && $this->session->userdata('roles') != "USER"){ ?>
															<a class="btn-sm app-btn-secondary btn-cancelar" href="/os/cancelar/<?=$os->id_os?>">Cancelar</a>
															<a class="btn-sm app-btn-secondary" href="/os/diagnostico/<?=$os->id_os?>">Diagnostico</a>
														<?php } ?>
													</td>
												</tr>
												<?php } ?>
											<?php }else{ ?>
											<tr>
												<td class="cell text-center" colspan="8">Nenhum Registro encontrado</td>
											</tr>	
											<?php } ?>
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
			        
				</div><!--//tab-content-->
				
				
			    
		    </div>
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	<!-- Button trigger modal -->

<!-- Modal -->
		<div class="modal fade" id="OSModal" tabindex="-1" aria-labelledby="OSModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="OSModalLabel">ID <OSNumber>0</OSNumber></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					<div class="info2">
							<div class="opt_group"><strong>ID: </strong> <label class="view-idv">-</label></div>
							<div class="opt_group"><strong>Numero do Patrimonio: </strong> <label class="view-patrimonio">-</label></div>
							<div class="opt_group"><strong>Ref: </strong> <label class="view-ref">-</label></div>
							<div class="opt_group"><strong>Funcionario: </strong> <label class="view-funcionario">-</label></div>
							<div class="opt_group"><strong>Data Entrada: </strong> <label class="view-entrada">-</label></div>
							<div class="opt_group"><strong>Equipamento: </strong> <label class="view-equipamento">-</label></div>
							<div class="opt_group"><strong>Configurações: </strong> <label class="view-modelo">-</label></div>
							<div class="opt_group"><strong>Marca: </strong> <label class="view-marca">-</label></div>
							<div class="opt_group"><strong>Acesso Remoto: </strong> <label class="view-serie">-</label></div>
							<div class="opt_group"><strong>Setor: </strong> <label class="view-setor">-</label></div>
							<div class="opt_group"><strong>IP: </strong> <label class="view-ip">-</label></div>
							<div class="opt_group"><strong>Previsão Entrega: </strong> <label class="view-previsaoEntrega">-</label></div>
							<div class="opt_group"><strong>Tec. Responsável: </strong> <label class="view-responsavel">-</label></div>
							<div class="opt_group" style="width: 100%;"><strong>Descrição do Equipamento: </strong> <label class="view-infos">-</label></div>

							<div class="opt_group" style="width: 100%;"><strong>Problema: </strong> <label class="view-problema">-</label></div>
							<div class="opt_group" style="width: 100%"><strong>Observação: </strong> <label class="view-obs">-</label></div>
							<div class="opt_group" style="width: 100%"><strong>Diagnostico Tecnico: </strong> <label class="view-diagnostico">-</label></div>
							<div class="opt_group" style="width: 100%"><strong>Solução: </strong> <label class="view-solucao">-</label></div>
							<div class="opt_group" style="width: 100%"><strong>Status: </strong> <label class="view-status">-</label></div>
						</div>
					</div>
				</div>
			</div>
		</div>    
		<?php $this->load->view('includes/footer_auth')?>	   
    </div>
	<?php $this->load->view('includes/footer')?>
