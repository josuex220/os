'use strict';

/* ===== Enable Bootstrap Popover (on element  ====== */
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

/* ==== Enable Bootstrap Alert ====== */
//var alertList = document.querySelectorAll('.alert')
//alertList.forEach(function (alert) {
//  new bootstrap.Alert(alert)
//});

const alertList = document.querySelectorAll('.alert')
const alerts = [...alertList].map(element => new bootstrap.Alert(element))


/* ===== Responsive Sidepanel ====== */
const sidePanelToggler = document.getElementById('sidepanel-toggler'); 
const sidePanel = document.getElementById('app-sidepanel');  
const sidePanelDrop = document.getElementById('sidepanel-drop'); 
const sidePanelClose = document.getElementById('sidepanel-close'); 

window.addEventListener('load', function(){
	responsiveSidePanel(); 
});

window.addEventListener('resize', function(){
	responsiveSidePanel(); 
});


function responsiveSidePanel() {
    let w = window.innerWidth;
	if(w >= 1200) {
	    // if larger 
	    //console.log('larger');
		sidePanel.classList.remove('sidepanel-hidden');
		sidePanel.classList.add('sidepanel-visible');
		
	} else {
	    // if smaller
	    //console.log('smaller');
	    sidePanel.classList.remove('sidepanel-visible');
		sidePanel.classList.add('sidepanel-hidden');
	}
};

sidePanelToggler.addEventListener('click', () => {
	if (sidePanel.classList.contains('sidepanel-visible')) {
		console.log('visible');
		sidePanel.classList.remove('sidepanel-visible');
		sidePanel.classList.add('sidepanel-hidden');
		
	} else {
		console.log('hidden');
		sidePanel.classList.remove('sidepanel-hidden');
		sidePanel.classList.add('sidepanel-visible');
	}
});



sidePanelClose.addEventListener('click', (e) => {
	e.preventDefault();
	sidePanelToggler.click();
});

sidePanelDrop.addEventListener('click', (e) => {
	sidePanelToggler.click();
});

$('.btn-deletar').click(function(e) {
	e.preventDefault();
	Swal.fire({
		title: 'Você tem certeza?',
		text: "Essa ação é irreversível!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Sim, Deletar!'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = $(this).attr('href');
		}
	});
});

$('.btn-cancelar').click(function(e) {
	e.preventDefault();
	Swal.fire({
		title: 'Você tem certeza?',
		text: "Essa ação é irreversível!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Sim, Cancelar!'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = $(this).attr('href');
		}
	});
});

$('.btn-armazenar').click(function(e) {
	e.preventDefault();
	Swal.fire({
		title: 'Você tem certeza?',
		text: "Essa ação é irreversível!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Sim, Armazenar!'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = $(this).attr('href');
		}
	});
});

$('.btn-modal').click(function(){
	let dataOs = $(this).attr('data-os');
	if(dataOs){
		$.post('/dashboard/getOs', {os:dataOs}).then(function( res ){
			let result = JSON.parse(res);

			$('.view-idv').html(result.id_os ? result.id_os : '-');
			$('.view-patrimonio').html(result.num_patrimonio ? result.num_patrimonio : '-');
			$('.view-ref').html(result.ref ? result.ref : '-');
			$('.view-funcionario').html(result.name ? result.name : '-');
			$('.view-entrada').html(result.data_hora ? result.data_hora : '-');
			$('.view-equipamento').html(result.tipo ? result.tipo : '-');
			$('.view-modelo').html(result.modelo ? result.modelo : '-');
			$('.view-marca').html(result.marca ? result.marca : '-');
			$('.view-serie').html(result.serie ? result.serie : '-');
			$('.view-setor').html(result.setor_name ? result.setor_name : '-');
			$('.view-ip').html(result.ip ? result.ip : '-');
			$('.view-previsaoEntrega').html(result.previsao_entrega ? result.previsao_entrega : '-');
			$('.view-responsavel').html(result.tecnico_name ? result.tecnico_name : '-');
			$('.view-infos').html(result.descricao ? result.descricao : '-');
			$('.view-problema').html(result.problema_cliente ? result.problema_cliente : '-');
			$('.view-diagnostico').html(result.diagnostico ? result.diagnostico : '-');
			$('.view-solucao').html(result.solucao ? result.solucao : '-');
			$('.view-status').html(result.status ? result.status : '-');
			$('.view-obs').html(result.obs ? result.obs : '-');
		});
	}
	let toggle = $(this).attr('data-toggle');
	if(toggle == "modal"){
		let target = $(this).attr('data-target');
		let osNumber = $(this).attr('data-osNumber');
		if(osNumber){
			$('OSNumber').html(osNumber);
		}
		$(target).modal('show');
	}
	
});
$('button').click(function(){
	let dismiss = $(this).attr('data-dismiss');
	if(dismiss == "modal"){
		$('.modal').modal('hide');
	}
});
$(document).ready(function() {
	$("#search-orders").on("input", function() {
		var inputText = $(this).val().trim().toLowerCase();
		if (inputText === "") {
			$(".table tbody tr").show();
		} else {
			$(".table tbody tr").each(function() {
				var rowData = $(this).text().toLowerCase();
				if (rowData.indexOf(inputText) === -1) {
					$(this).hide();
				} else {
					$(this).show();
				}
			});
		}
	});
});