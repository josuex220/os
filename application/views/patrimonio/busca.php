<?php $this->load->view('includes/header')?>
   
	<?php $this->load->view('includes/menu')?>
    
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
	<?php $this->load->view('includes/alerts')?>

				<div class="tab-content">
					<div class="app-card p-5 shadow-sm">
						<h3 class="page-title mb-4">Consultar patrimonio</h3>
						<hr>
						<div class="mb-4">
							<form action="<?=current_url()?>" method="post">
								<div class="form-group">
									<label for="">Numero do patrimonio</label>
									<input type="text" name="num_patrimonio" placeholder="Ex: EQP-64c9ada7a4dcb" class="form-control">
								</div>
								<button class="btn app-btn-primary mt-4">Consultar</button>
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

