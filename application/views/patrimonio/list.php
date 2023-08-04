<?php $this->load->view('includes/header')?>
   
	<?php $this->load->view('includes/menu')?>
    
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
	<?php $this->load->view('includes/alerts')?>
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Consulta de Patrimonio</h1>
				    </div>
			    </div><!--//row-->
			   
			    
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4" role="tablist">
					<a class="flex-sm-fill text-sm-center nav-link active" id="orders-eqp-tab" data-bs-toggle="tab" href="#orders-eqp" role="tab" aria-controls="orders-abertos" aria-selected="true">Equipamentos / Impressora</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-os-tab" data-bs-toggle="tab" href="#orders-os" role="tab" aria-controls="orders-andamento" aria-selected="false" tabindex="-1">OS</a>
				</nav>
				
				
				<div class="tab-content" id="orders-table-tab-content">
                    
                        <div class="tab-pane fade active show" id="orders-eqp" role="tabpanel" aria-labelledby="orders-eqp-tab">
                            <div class="app-card app-card-orders-table mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 text-left">
											<thead>
											<tr>
												<th class="cell">Id</th>
												<th class="cell">Marca</th>
												<th class="cell">Model</th>
												<th class="cell">Serie</th>
												<th class="cell">IP</th>
												<th class="cell">Num. Patrimonio</th>
												<th class="cell">Status</th>
												<th class="cell"></th>
											</tr>
											</thead>
											<tbody>
											<?php if($allEquipamentos){
												foreach ($allEquipamentos as $key => $equipamento) { ?>
													<tr>
														<td class="cell"><?=$equipamento->tipo?>-<?=$equipamento->id_equipamento?></td>
														<td class="cell"><span class="truncate"><?=$equipamento->marca?></span></td>
														<td class="cell"><?=$equipamento->modelo?></td>
														<td class="cell"><?=$equipamento->serie?></td>
														<td class="cell"><?=$equipamento->ip?></td>
														<td class="cell"><?=$equipamento->num_patrimonio?></td>
														<td class="cell"><?=getStatusUser($equipamento->status)?></td>
														<td class="cell">
															<a class="btn-sm app-btn-secondary" href="/<?=$equipamento->tipo == "EQP" ? "equipamento" : "impressora"?>/ver/<?=$equipamento->id_equipamento?>">Ver</a>
															<?php if($this->session->userdata('roles') == "ADMIN"){ ?>
																<a class="btn-sm app-btn-secondary" href="/<?=$equipamento->tipo == "EQP" ? "equipamento" : "impressora"?>/editar/<?=$equipamento->id_equipamento?>">Editar</a>
																<a class="btn-sm app-btn-secondary btn-deletar" href="/<?=$equipamento->tipo == "EQP" ? "equipamento" : "impressora"?>/deletar/<?=$equipamento->id_equipamento?>">Apagar</a>
															<?php } ?>
														</td>
													</tr>
												<?php } } else{ ?>
												<tr>
													<td class="cell text-center" colspan="6">Sem Registros</td>
												</tr>
											<?php } ?>

											</tbody>
                                        </table>
                                    </div><!--//table-responsive-->
                                </div><!--//app-card-body-->		
                            </div><!--//app-card-->
                        </div><!--//tab-pane-->
                        <div class="tab-pane fade" id="orders-os" role="tabpanel" aria-labelledby="orders-os-tab">
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
                                                if($allOs){
                                                    foreach ($allOs as $key => $os) {
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

