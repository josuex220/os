<?php $this->load->view('includes/header')?>
   
	<?php $this->load->view('includes/menu')?>
    
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
		<?php $this->load->view('includes/alerts')?>
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Lista de equipamentos / <?=$route?></h1>
				    </div>
				    
			    </div><!--//row-->
				
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade active show" id="orders-inativos" role="tabpanel" aria-labelledby="orders-inativos-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							   <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
							    <form class="settings-form" action="<?=current_url()?>" method="POST">
									<div class="mb-3">
									    <label for="setting-name" class="form-label">Marca</label>
									    <input type="text" class="form-control" id="setting-name" <?= $formDisabled ? 'disabled' : '' ?> name="marca" value="<?=$user['marca']?>" placeholder="Ex: Dell" required="">
									</div>
								    <div class="mb-3">
									    <label for="setting-modelo" class="form-label">Modelo</label>
									    <input type="text" class="form-control" id="setting-modelo" <?= $formDisabled ? 'disabled' : '' ?> name="modelo" value="<?=$user['modelo']?>" required placeholder="Ex: Inspiron 15">
									</div>
								    <div class="mb-3">
									    <label for="setting-serie" class="form-label">Serie</label>
									    <input type="text" class="form-control" id="setting-serie" <?= $formDisabled ? 'disabled' : '' ?> name="serie" value="<?=$user['serie']?>" placeholder="Ex: 1">
									</div>
								    <div class="mb-3">
									    <label for="setting-ip" class="form-label">IP</label>
									    <input type="text" class="form-control" id="setting-ip" <?= $formDisabled ? 'disabled' : '' ?> name="ip" value="<?=$user['ip']?>"  placeholder="Ex: 127.0.0.1">
									</div>
								    <div class="mb-3">
									    <label for="setting-garantia" class="form-label">Garantia</label>
									    <input type="text" class="form-control" id="setting-garantia" <?= $formDisabled ? 'disabled' : '' ?> name="garantia" value="<?=$user['garantia']?>" placeholder="">
									</div>
								    <div class="mb-3">
									    <label for="setting-ref" class="form-label">Referencia</label>
									    <input type="text" class="form-control" id="setting-ref" <?= $formDisabled ? 'disabled' : '' ?> name="ref" value="<?=$user['ref']?>" placeholder="">
									</div>
								    <div class="mb-3">
									    <label for="setting-num_patrimonio" class="form-label">Numero do Patrimonio</label>
									    <input type="text" class="form-control" id="setting-num_patrimonio" <?= $formDisabled ? 'disabled' : '' ?> name="num_patrimonio" value="<?=$user['num_patrimonio'] ? $user['num_patrimonio'] : uniqid('EQP-')?>" required placeholder="">
									</div>
								    <div class="mb-3">
									    <label for="setting-codigo" class="form-label">Codigo do equipamento</label>
									    <input type="text" class="form-control" id="setting-codigo" <?= $formDisabled ? 'disabled' : '' ?> name="codigo" value="<?=$user['codigo'] ? $user['codigo'] : ''?>" required placeholder="">
									</div>
								    <div class="mb-3">
									    <label for="setting-descricao" class="form-label">Descrição</label>
									    <textarea type="text" class="form-control" id="setting-descricao" <?= $formDisabled ? 'disabled' : '' ?> name="descricao" placeholder="" style="min-height:100px"><?=$user['descricao']?></textarea>
									</div>
									<div class="mb-3">
									    <label required for="setting-status" class="form-label">Status</label>
										<select name="status" class="form-control"  <?= $formDisabled ? 'disabled' : '' ?>  id="setting-status">
											<option value="1" <?=(int) $user['status'] == 1 ? 'selected' : '' ?> >Ativo</option>
											<option value="0" <?=(int) $user['status'] == 0 ? 'selected' : '' ?> >Inativo</option>
										</select>
									</div>
										<?php if(!$formDisabled) { ?>
									<button type="submit" class="btn app-btn-primary">Salvar</button>
									<?php } ?>
							    </form>
						    </div><!--//app-card-body-->
						    
						</div>
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
	