<?php $this->load->view('includes/header')?>
   
	<?php $this->load->view('includes/menu')?>
    
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
	<?php $this->load->view('includes/alerts')?>

				<div class="tab-content">
					<div class="app-card p-5 shadow-sm">
						<h3 class="page-title mb-4">Exportar Relatorio</h3>

						<div class="alert alert-primary" role="alert">Não selecionar nenhum filtro caso queira relatorio completo</div>
						<hr>
						<div class="mb-4">
							<form action="<?=current_url()?>" method="post">
								<div class="row">
									<div class="col-6">
										<div class="form-group">
											<label for="">Data de Inicio</label>
											<input type="date" name="dateStart" class="form-control" />
										</div>
									</div>

									<div class="col-6">
										<div class="form-group">
											<label for="">Data Fim</label>
											<input type="date" name="dateEnd" class="form-control" />
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="" class="form-label">Setor</label>
									<select name="id_setor[]" class="form-control" multiple style="height:150px">
										<option value="" selected>Não Usar Filtro</option>
										<?php foreach ($setores as $key => $setor) { ?>
											<option value="<?=$setor->id_setor?>"><?=$setor->name?></option>
										<?php } ?>
									</select>

								</div>
								<button class="btn app-btn-primary mt-4">Ir para Relatorio</button>
							</form>
						</div>
					</div>
				</div><!--//tab-content-->
				
				
			    
		    </div>
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	<!-- Button trigger modal -->
<!-- Modal -->

		<?php $this->load->view('includes/footer_auth')?>	   
    </div>
	<?php $this->load->view('includes/footer')?>

