<?php $this->load->view('includes/header')?>
   
	<?php $this->load->view('includes/menu')?>
    
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
		<?php $this->load->view('includes/alerts')?>
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Lista de usuario / <?=$route?></h1>
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
									    <label for="setting-name" class="form-label">Nome</label>
									    <input type="text" class="form-control" id="setting-name" <?= $formDisabled ? 'disabled' : '' ?> name="name" value="<?=$user['name']?>" placeholder="Ex: Joe Doe" required="">
									</div>
								    <div class="mb-3">
									    <label for="setting-username" class="form-label">Nome de Usuario</label>
									    <input type="text" class="form-control" id="setting-username" <?= $formDisabled ? 'disabled' : '' ?> name="username" value="<?=$user['username']?>" required placeholder="Ex: joedoe">
									</div>
								    <div class="mb-3">
									    <label required for="setting-group" <?= $formDisabled ? 'disabled' : '' ?> class="form-label">Grupo de Usuario</label>
										<select name="group"  <?= $formDisabled ? 'disabled' : '' ?>  class="form-control" id="setting-group">
											<option value="ADMIN" <?=$user['group'] == 'ADMIN' ? 'selected' : '' ?> >Administrador</option>
											<option value="TECNICO" <?=$user['group'] == 'TECNICO' ? 'selected' : '' ?> >Tecnico</option>
											<option value="USER" <?=$user['group'] == 'USER' ? 'selected' : '' ?> >Usuario</option>
										</select>
									</div>
									<?php if(!$formDisabled) { ?>
										<div class="mb-3">
											<label for="setting-password" class="form-label">Senha</label>
											<input type="text" class="form-control" id="setting-password" name="password" value="" placeholder="*********">
										</div>
										
										<div class="mb-3">
											<label for="setting-password2" class="form-label">Confirmação de Senha</label>
											<input type="text" class="form-control" id="setting-password2" name="confirmation_password" value="" placeholder="*********">
										</div>
									<?php } ?>
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
	