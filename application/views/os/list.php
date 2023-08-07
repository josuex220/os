<?php $this->load->view('includes/header')?>
   
	<?php $this->load->view('includes/menu')?>
    
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
	<?php $this->load->view('includes/alerts')?>
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Lista de OS</h1>
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
                                            <a class="btn app-btn-primary" href="/os/add">Abrir OS</a>
                                        </div>
					                </form>
					                
							    </div><!--//col-->
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
			    
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4" role="tablist">
				    <a class="flex-sm-fill text-sm-center nav-link <?php if($this->uri->segment(3) && $this->uri->segment(3) == "1" || !$this->uri->segment(3)){ echo 'active'; } ?>" id="orders-abertos-tab" data-bs-toggle="tab" href="#orders-abertos" role="tab" aria-controls="orders-abertos" aria-selected="true">Abertos</a>
				    <a class="flex-sm-fill text-sm-center nav-link <?php if($this->uri->segment(3) && $this->uri->segment(3) == "2"){ echo 'active'; } ?>" id="orders-andamento-tab" data-bs-toggle="tab" href="#orders-andamento" role="tab" aria-controls="orders-andamento" aria-selected="false" tabindex="-1">Em Andamento</a>
				    <a class="flex-sm-fill text-sm-center nav-link <?php if($this->uri->segment(3) && $this->uri->segment(3) == "3"){ echo 'active'; } ?>" id="orders-finalizados-tab" data-bs-toggle="tab" href="#orders-finalizados" role="tab" aria-controls="orders-finalizados" aria-selected="false" tabindex="-1">Finalizados</a>
				    <a class="flex-sm-fill text-sm-center nav-link <?php if($this->uri->segment(3) && $this->uri->segment(3) == "4"){ echo 'active'; } ?>" id="orders-cancelado-tab" data-bs-toggle="tab" href="#orders-cancelado" role="tab" aria-controls="orders-cancelado" aria-selected="false" tabindex="-1">Cancelados</a>
				</nav>
				
				
				<div class="tab-content" id="orders-table-tab-content">
                    
                        <div class="tab-pane fade <?php if($this->uri->segment(3) && $this->uri->segment(3) == "1" || !$this->uri->segment(3)){ echo "active show"; }?>" id="orders-abertos" role="tabpanel" aria-labelledby="orders-abertos-tab">
                            <div class="app-card app-card-orders-table mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    <th class="cell">ID OS</th>
                                                    <th class="cell">Funcionario</th>
                                                    <th class="cell">Setor</th>
                                                    <th class="cell">Data Abertura</th>
                                                    <th class="cell">Previsão de Entrega</th>
                                                    <th class="cell">Tecnico</th>
                                                    <th class="cell">Status</th>
                                                    <th class="cell"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if($oss['aberto']){
													unset($os);
                                                    foreach ($oss['aberto'] as $key => $os) {
                                                    ?>
                                                    <tr>
                                                        <td class="cell">#OS-<?=OSNumber($os->id_os)?></td>
                                                        <td class="cell"><?=$os->name?></td>
                                                        <td class="cell"><?=$os->setor_name?></td>
                                                        <td class="cell"><span class="cell-data"><?=formatarHorario(explode(" ",$os->data_hora)[0], explode(" ",$os->data_hora)[1])['data']?></span><span class="note"><?=formatarHorario(explode(" ",$os->data_hora)[0], explode(" ",$os->data_hora)[1])['hora']?></span></td>
                                                        <td class="cell"><span class="cell-data"><?php if($os->previsao_entrega){ ?><?=formatarHorario(explode(" ",$os->previsao_entrega)[0], explode(" ",$os->previsao_entrega)[1])['data']?></span><span class="note"><?=formatarHorario(explode(" ",$os->previsao_entrega)[0], explode(" ",$os->previsao_entrega)[1])['hora']?></span><?php }else echo "-"; ?></td>
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
                        <div class="tab-pane fade <?php if($this->uri->segment(3) && $this->uri->segment(3) == "4"){ echo "active show"; }?>" id="orders-cancelado" role="tabpanel" aria-labelledby="orders-cancelado-tab">
					        <div class="app-card app-card-orders-table mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    <th class="cell">ID OS</th>
                                                    <th class="cell">Funcionario</th>
                                                    <th class="cell">Setor</th>
                                                    <th class="cell">Data Abertura</th>
                                                    <th class="cell">Previsão de Entrega</th>
                                                    <th class="cell">Tecnico</th>
                                                    <th class="cell">Status</th>
                                                    <th class="cell"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if($oss['cancelado']){
													unset($os);
                                                    foreach ($oss['cancelado'] as $key => $os) {
                                                    ?>
														<tr>
														<td class="cell">#OS-<?=OSNumber($os->id_os)?></td>
														<td class="cell"><?=$os->name?></td>
														<td class="cell"><?=$os->setor_name?></td>
														<td class="cell"><span class="cell-data"><?=formatarHorario(explode(" ",$os->data_hora)[0], explode(" ",$os->data_hora)[1])['data']?></span><span class="note"><?=formatarHorario(explode(" ",$os->data_hora)[0], explode(" ",$os->data_hora)[1])['hora']?></span></td>
														<td class="cell"><span class="cell-data"><?php if($os->previsao_entrega){ ?><?=formatarHorario(explode(" ",$os->previsao_entrega)[0], explode(" ",$os->previsao_entrega)[1])['data']?></span><span class="note"><?=formatarHorario(explode(" ",$os->previsao_entrega)[0], explode(" ",$os->previsao_entrega)[1])['hora']?></span><?php }else echo "-"; ?></td>
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
                        <div class="tab-pane fade <?php if($this->uri->segment(3) && $this->uri->segment(3) == "2"){ echo "active show"; }?>" id="orders-andamento" role="tabpanel" aria-labelledby="orders-andamento-tab">
					        <div class="app-card app-card-orders-table mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    <th class="cell">ID OS</th>
                                                    <th class="cell">Funcionario</th>
                                                    <th class="cell">Setor</th>
                                                    <th class="cell">Data Abertura</th>
                                                    <th class="cell">Previsão de Entrega</th>
                                                    <th class="cell">Tecnico</th>
                                                    <th class="cell">Status</th>
                                                    <th class="cell"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if($oss['andamento']){
													unset($os);
                                                    foreach ($oss['andamento'] as $key => $os) {
                                                    ?>
														<tr>
														<td class="cell">#OS-<?=OSNumber($os->id_os)?></td>
														<td class="cell"><?=$os->name?></td>
														<td class="cell"><?=$os->setor_name?></td>
														<td class="cell"><span class="cell-data"><?=formatarHorario(explode(" ",$os->data_hora)[0], explode(" ",$os->data_hora)[1])['data']?></span><span class="note"><?=formatarHorario(explode(" ",$os->data_hora)[0], explode(" ",$os->data_hora)[1])['hora']?></span></td>
														<td class="cell"><span class="cell-data"><?php if($os->previsao_entrega){ ?><?=formatarHorario(explode(" ",$os->previsao_entrega)[0], explode(" ",$os->previsao_entrega)[1])['data']?></span><span class="note"><?=formatarHorario(explode(" ",$os->previsao_entrega)[0], explode(" ",$os->previsao_entrega)[1])['hora']?></span><?php }else echo "-"; ?></td>
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
                        <div class="tab-pane fade <?php if($this->uri->segment(3) && $this->uri->segment(3) == "3"){ echo "active show"; }?>" id="orders-finalizados" role="tabpanel" aria-labelledby="orders-finalizados-tab">
					        <div class="app-card app-card-orders-table mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    <th class="cell">ID OS</th>
                                                    <th class="cell">Funcionario</th>
                                                    <th class="cell">Setor</th>
                                                    <th class="cell">Data Abertura</th>
                                                    <th class="cell">Previsão de Entrega</th>
                                                    <th class="cell">Tecnico</th>
                                                    <th class="cell">Status</th>
                                                    <th class="cell"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if($oss['finalizado']){
													unset($os);
                                                    foreach ($oss['finalizado'] as $key => $os) {
                                                    ?>
                                                    <tr>
                                                        <td class="cell">#OS-<?=OSNumber($os->id_os)?></td>
                                                        <td class="cell"><?=$os->name?></td>
                                                        <td class="cell"><?=$os->setor_name?></td>
                                                        <td class="cell"><span class="cell-data"><?=formatarHorario(explode(" ",$os->data_hora)[0], explode(" ",$os->data_hora)[1])['data']?></span><span class="note"><?=formatarHorario(explode(" ",$os->data_hora)[0], explode(" ",$os->data_hora)[1])['hora']?></span></td>
                                                        <td class="cell"><span class="cell-data"><?php if($os->previsao_entrega){ ?><?=formatarHorario(explode(" ",$os->previsao_entrega)[0], explode(" ",$os->previsao_entrega)[1])['data']?></span><span class="note"><?=formatarHorario(explode(" ",$os->previsao_entrega)[0], explode(" ",$os->previsao_entrega)[1])['hora']?></span><?php }else echo "-"; ?></td>
                                                        <td class="cell"><?=$os->tecnico_name?></td>
                                                        <td class="cell"><?=getStatus($os->status)?></td>
                                                        <td class="cell">
                                                            <a class="btn-sm app-btn-secondary btn-modal"  data-toggle="modal" data-target="#OSModal" data-os="<?=$os->id_os?>" data-osNumber="#OS-<?=OSNumber($os->id_os)?>" href="javascript:void(0)">Checar</a>
                                                            <?php if($os->status != 4 && $os->status != 3 && $this->session->userdata('roles') != "USER"){ ?>
                                                                <a class="btn-sm app-btn-secondary btn-cancelar" href="/os/cancelar/<?=$os->id_os?>">Cancelar</a>
                                                                <a class="btn-sm app-btn-secondary" href="/os/diagnostico">Diagnostico</a>
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

