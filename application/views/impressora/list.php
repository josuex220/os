<?php $this->load->view('includes/header')?>
   
	<?php $this->load->view('includes/menu')?>
    
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
	<?php $this->load->view('includes/alerts')?>
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Lista de Impressoras</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <form class="table-search-form row gx-1 align-items-center">
					                    <div class="col-auto">
					                        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Buscar">
					                    </div>
                                        <div class="col-auto">
                                            <a class="btn app-btn-primary" href="/impressora/add">Adicionar Novo</a>
                                        </div>
					                </form>
					                
							    </div><!--//col-->
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
			    
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4" role="tablist">
				    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Todos</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-ativos-tab" data-bs-toggle="tab" href="#orders-ativos" role="tab" aria-controls="orders-ativos" aria-selected="false" tabindex="-1">Ativos</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-inativos-tab" data-bs-toggle="tab" href="#orders-inativos" role="tab" aria-controls="orders-inativos" aria-selected="false" tabindex="-1">Inativos</a>
				</nav>
				
				
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
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
                                            <?php if($equipamentos['all']){ 
                                                foreach ($equipamentos['all'] as $key => $equipamento) { ?>
                                                <tr>
                                                    <td class="cell">EQP-<?=$equipamento->id_equipamento?></td>
                                                    <td class="cell"><span class="truncate"><?=$equipamento->marca?></span></td>
                                                    <td class="cell"><?=$equipamento->modelo?></td>
                                                    <td class="cell"><?=$equipamento->serie?></td>
                                                    <td class="cell"><?=$equipamento->ip?></td>
                                                    <td class="cell"><?=$equipamento->num_patrimonio?></td>
                                                    <td class="cell"><?=getStatusUser($equipamento->status)?></td>
                                                    <td class="cell">
                                                        <a class="btn-sm app-btn-secondary" href="/impressora/ver/<?=$equipamento->id_equipamento?>">Ver</a>
														<?php if($this->session->userdata('roles') == "ADMIN"){ ?>
															<a class="btn-sm app-btn-secondary" href="/impressora/editar/<?=$equipamento->id_equipamento?>">Editar</a>
															<a class="btn-sm app-btn-secondary btn-deletar" href="/impressora/deletar/<?=$equipamento->id_equipamento?>">Apagar</a>
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
			        
			        <div class="tab-pane fade" id="orders-ativos" role="tabpanel" aria-labelledby="orders-ativos-tab">
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
                                        <?php if($equipamentos['ativo']){ 
                                                foreach ($equipamentos['ativo'] as $key => $equipamento) { ?>
                                                <tr>
                                                    <td class="cell">EQP-<?=$equipamento->id_equipamento?></td>
                                                    <td class="cell"><span class="truncate"><?=$equipamento->marca?></span></td>
                                                    <td class="cell"><?=$equipamento->modelo?></td>
                                                    <td class="cell"><?=$equipamento->serie?></td>
                                                    <td class="cell"><?=$equipamento->ip?></td>
                                                    <td class="cell"><?=$equipamento->num_patrimonio?></td>
                                                    <td class="cell"><?=getStatusUser($equipamento->status)?></td>
                                                    <td class="cell">
                                                        <a class="btn-sm app-btn-secondary" href="/impressora/ver/<?=$equipamento->id_equipamento?>">Ver</a>
														<?php if($this->session->userdata('roles') == "ADMIN"){ ?>
															<a class="btn-sm app-btn-secondary" href="/impressora/editar/<?=$equipamento->id_equipamento?>">Editar</a>
															<a class="btn-sm app-btn-secondary btn-deletar" href="/impressora/deletar/<?=$equipamento->id_equipamento?>">Apagar</a>
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
			        
			        <div class="tab-pane fade" id="orders-inativos" role="tabpanel" aria-labelledby="orders-inativos-tab">
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
											
                                            <?php if($equipamentos['inativo']){ 
                                                foreach ($equipamentos['inativo'] as $key => $equipamento) { ?>
                                                <tr>
                                                    <td class="cell">EQP-<?=$equipamento->id_equipamento?></td>
                                                    <td class="cell"><span class="truncate"><?=$equipamento->marca?></span></td>
                                                    <td class="cell"><?=$equipamento->modelo?></td>
                                                    <td class="cell"><?=$equipamento->serie?></td>
                                                    <td class="cell"><?=$equipamento->ip?></td>
                                                    <td class="cell"><?=$equipamento->num_patrimonio?></td>
                                                    <td class="cell"><?=getStatusUser($equipamento->status)?></td>
                                                    <td class="cell">
                                                        <a class="btn-sm app-btn-secondary" href="/impressora/ver/<?=$equipamento->id_equipamento?>">Ver</a>
														<?php if($this->session->userdata('roles') == "ADMIN"){ ?>
															<a class="btn-sm app-btn-secondary" href="/impressora/editar/<?=$equipamento->id_equipamento?>">Editar</a>
															<a class="btn-sm app-btn-secondary btn-deletar" href="/impressora/deletar/<?=$equipamento->id_equipamento?>">Apagar</a>
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

				</div><!--//tab-content-->
				
				
			    
		    </div>
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	<!-- Button trigger modal -->

		<?php $this->load->view('includes/footer_auth')?>	   
    </div>
	<?php $this->load->view('includes/footer')?>
	