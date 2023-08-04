<?php $this->load->view('includes/header')?>

<?php $this->load->view('includes/menu')?>

<style>
	select[readonly] {
		background: #eee;
		pointer-events: none;
		touch-action: none;
	}
</style>
<div class="app-wrapper">

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<?php $this->load->view('includes/alerts')?>

			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Lista de OS / <?=$route?></h1>
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
											<label for="setting-name" class="form-label">Equipamento</label>
											<select name="id_equipamento" disabled class="form-control" <?=$user['id_equipamento'] ? 'readonly' : ''?> required>
												<option value="">Selecione o Equipamento</option>
												<?php foreach ($equipamentos as $key => $equipamento) { ?>
													<option value="<?=$equipamento->id_equipamento?>" <?= $equipamento->id_equipamento == $user['equipamento'] ? 'selected' : '' ?>>Marca: <?=$equipamento->marca?> - Modelo: <?=$equipamento->modelo?> - Ref: <?=$equipamento->ref?> -Patrimonio: <?=$equipamento->num_patrimonio?></option>
												<?php } ?>
											</select>
										</div>

										<input type="hidden" name="id_user" value="<?=$user['id_user'] ? $user['id_user'] : $this->session->userdata('user_id')?>"/>

										<div class="mb-3">
											<label for="setting-name" class="form-label">Setor</label>
											<select name="id_setor" class="form-control" readonly="true" required>
												<?php foreach ($setores as $key => $setor) { ?>
													<option value="<?=$setor->id_setor?>" <?= $setor->id_setor == $user['id_setor'] ? 'selected' : ($setor->id_setor == $this->session->userdata('setor') ? 'selected' : '') ?> ><?=$setor->name?></option>
												<?php } ?>
											</select>
										</div>

										<div class="mb-3">
											<label for="setting-descricao" class="form-label">Descrição do problema</label>
											<textarea type="text" class="form-control" id="setting-descricao" disabled name="problema_cliente" placeholder="" style="min-height:100px"><?=$user['problema_cliente']?></textarea>
										</div>
										<div class="mb-3">
											<label for="setting-descricao" class="form-label">Observações</label>
											<textarea type="text" class="form-control" id="setting-descricao" disabled name="obs" placeholder="" style="min-height:100px"><?=$user['obs']?></textarea>
										</div>
										<div class="mb-3">
											<label for="setting-diagnostico" class="form-label">Diagnostico</label>
											<textarea type="text" class="form-control" <?=$user['status']==3 ? 'disabled' :'' ?> id="setting-diagnostico" name="diagnostico" placeholder="" style="min-height:100px"><?=$user['diagnostico']?></textarea>
										</div>

										<div class="mb-3">
											<label for="setting-previsao" class="form-label">Data da Previsão</label>
											<input type="datetime-local" name="previsao_entrega" value="<?=$user['previsao_entrega']?>" min="<?=date("Y-m-d H:i")?>" class="form-control" <?=$user['status']==3 ? 'disabled' :'' ?>>
										</div>
										<div class="mb-3">
											<label for="setting-solucao" class="form-label">Solução</label>
											<textarea type="text" class="form-control" <?=$user['status']==3 || $user['status']+1 != 3 ? 'disabled placeholder="Campo disponivel somente com status FINALIZADO"' :'' ?> id="setting-solucao" name="solucao" style="min-height:100px"><?=$user['solucao']?></textarea>
										</div>
										<?php if($this->session->userdata('roles') == "ADMIN"){ ?>
										<div class="mb-3">
											<label required for="setting-id_tecnico"  class="form-label">Status</label>
											<select name="id_tecnico" <?=$user['status']==3 ? 'readonly="true"' :'' ?> class="form-control" id="setting-id_tecnico">
												<option value="<?=$this->session->userdata('user_id')?>" <?=$this->session->userdata('user_id') == $user['id_tecnico'] ? 'selected' : ''?> >Eu Mesmo</option>
												<?php foreach ($allTecnicos as $us){ ?>
													<option value="<?=$us->id_user?>" <?=$us->id_user == $user['id_tecnico'] ? 'selected' : ''?> ><?=$us->name?></option>
												<?php } ?>

											</select>
										</div>
										<?php } ?>
										<div class="mb-3">
											<label required for="setting-status"  class="form-label">Status</label>
											<select name="status" <?=$user['status']==3 ? 'readonly="true"' :'' ?> class="form-control" id="setting-status">
												<option value="1" <?php if((int) $user['status'] >= 1){ ?> disabled <? } ?> >Aberto</option>
												<option value="2" <?=(int) $user['status']+1 == 2  ? 'selected' : '' ?> <?php if((int) $user['status'] >= 2){ ?> disabled <? } ?> >Em Andamento</option>
												<option value="3" <?=(int) $user['status']+1 == 3 || $user['status'] == 3 ? 'selected' : '' ?> <?php if((int) $user['status'] >= 3){ ?> disabled <? } ?> >Finalizado</option>
												<option value="4" disabled >Cancelado</option>
											</select>
										</div>
										<?php if($user['status'] < 3) { ?>
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

<script>
	$('#setting-status').on('change', function(){
		let status = $(this).val();
		if(status != 3){
			$('#setting-solucao').attr('disabled','true');
			$('#setting-solucao').attr('placeholder','Campo disponivel somente com status FINALIZADO');
		}else{
			$('#setting-solucao').removeAttr('disabled');
			$('#setting-solucao').removeAttr('placeholder');
		}
	})
	$(document).ready(function(){
		let status = $('#setting-status').val();
		if(status != 3){
			$('#setting-solucao').attr('disabled','true');
			$('#setting-solucao').attr('placeholder','Campo disponivel somente com status FINALIZADO');
		}else{
			$('#setting-solucao').removeAttr('disabled');
			$('#setting-solucao').removeAttr('placeholder');
		}
	});
</script>
