<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patrimonio extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('setor_model');;
        $this->load->model('equipamentos_model');
        $this->load->model('os_model');
        
        if(!$this->session->userdata('user_id')){
            redirect('/login');
        }


    }

	public function index(){

        if($this->input->post()) {
			if($this->input->post('num_patrimonio')){
				$url = base_url()."patrimonio/num_patrimonio/".$this->input->post('num_patrimonio');
				redirect($url);
			}else{
				$this->session->set_flashdata('error','É necessario digitar o numero do patrimonio');
				redirect('/patrimonio');
			}
		}
		$this->load->view('patrimonio/busca', $data);
	}
    public function num_patrimonio($num_patrimonio = false){
		if(!$num_patrimonio) {
			redirect('/patrimonio');
		}
        $filtros = array('num_patrimonio' => $num_patrimonio);
        
        $data = array();
        $data['allEquipamentos'] = $this->equipamentos_model->getAll($filtros);
		$data['allOs'] = $this->os_model->getOs($filtros);




        $this->load->view('patrimonio/list', $data);
    }
}
?>
