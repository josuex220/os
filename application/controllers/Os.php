<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Os extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('setor_model');
        $this->load->model('equipamentos_model');
        $this->load->model('os_model');
        
        if(!$this->session->userdata('user_id')){
            redirect('/login');
        }
    }

    public function cancelar($id = false){
        if($this->session->userdata('roles') == "USER"){
            $this->session->set_flashdata('error', 'Você não possui autorização');
            redirect('/dashboard');
        }
        if($id){
            if($this->os_model->cancelar($id)){            
                $this->session->set_flashdata('success', 'OS cancelada com sucesso');
            }else{
                $this->session->set_flashdata('error', 'Houve um erro ao tentar cancelar a OS');
            }
        }else{
            $this->session->set_flashdata('error', 'OS não identificado');
        }
        
        redirect('/os');
    }

    public function add(){
        $route = "<span style='color: #6f6969; font-weight: 500; font-size: 21px;'>Adicionar</span>";
        
        if($this->input->post()){
                $post = $this->input->post();
                $post['data_hora'] = date("Y-m-d H:i:s");
                $post['data_hora_update'] = date("Y-m-d H:i:s");

                $update = $this->os_model->insert($id, $post);
                if( !$update['error'] ){            
                    $this->session->set_flashdata('success', $update['success']);
                    redirect('/os');
                }else{
                    $this->session->set_flashdata('error', $update['error'] );
                }
        }
        
        $this->form(false, $route, false);
    }
    
    public function diagnostico($id = false){
        if($this->session->userdata('roles') == "USER"){
            $this->session->set_flashdata('error', 'Você não possui autorização');
            redirect('/dashboard');
        }
        if(!$id){
            $this->session->set_flashdata('error', 'Os não identificada');
            redirect('/os');
        }
		if($this->input->post()){
			$post = $this->input->post();
			if($post['status'] == 3){
				$post['data_entrega'] = date("Y-m-d H:i:s");
			}
			if(!$post['id_tecnico']) {
				$post['id_tecnico'] = $this->session->userdata('user_id');
			}


			$update = $this->os_model->update($id, $post);
			if( !$update['error'] ){
				$this->session->set_flashdata('success', $update['success']);
				redirect('/os');
			}else{
				$this->session->set_flashdata('error', $update['error'] );
			}
		}
        $getInfos = $this->os_model->getOsById($id);
        $route = "<span style='color: #6f6969; font-weight: 500; font-size: 21px;'>Diagnosticar</span>";

        $this->form($getInfos, $route, false);
    }



    public function form($info = false, $route = false,$formDisabled = false){
        $data['route'] = $route;

        $data['equipamentos'] = $this->equipamentos_model->getAll();
        $data['setores']      = $this->setor_model->getAll();
        if($this->input->post('id_user')){
            $data['user']['id_user'] = $this->input->post('id_user');
        }elseif( $info->id_user){
            $data['user']['id_user'] = $info->id_user;
        }else{
            $data['user']['id_user'] = '';
        }
		if($this->input->post('equipamento')){
			$data['user']['equipamento'] = $this->input->post('equipamento');
		}elseif( $info->id_equipamento){
			$data['user']['equipamento'] = $info->id_equipamento;
		}else{
			$data['user']['equipamento'] = '';
		}
		if($this->input->post('id_tecnico')){
			$data['user']['id_tecnico'] = $this->input->post('id_tecnico');
		}elseif( $info->id_tecnico){
			$data['user']['id_tecnico'] = $info->id_tecnico;
		}else{
			$data['user']['id_tecnico'] = '';
		}

        if($this->input->post('id_setor')){
            $data['user']['id_setor'] = $this->input->post('id_setor');
        }elseif( $info->id_setor){
            $data['user']['id_setor'] = $info->id_setor;
        }else{
            $data['user']['id_setor'] = '';
        }

        if($this->input->post('problema_cliente')){
            $data['user']['problema_cliente'] = $this->input->post('problema_cliente');
        }elseif( $info->problema_cliente){
            $data['user']['problema_cliente'] = $info->problema_cliente;
        }else{
            $data['user']['problema_cliente'] = '';
        }

		if($this->input->post('obs')){
			$data['user']['obs'] = $this->input->post('obs');
		}elseif( $info->obs){
			$data['user']['obs'] = $info->obs;
		}else{
			$data['user']['obs'] = '';
		}
		if($this->input->post('diagnostico')){
			$data['user']['diagnostico'] = $this->input->post('diagnostico');
		}elseif( $info->diagnostico){
			$data['user']['diagnostico'] = $info->diagnostico;
		}else{
			$data['user']['diagnostico'] = '';
		}


		if($this->input->post('id_tecnico')){
			$data['user']['id_tecnico'] = $this->input->post('id_tecnico');
		}elseif( $info->id_tecnico){
			$data['user']['id_tecnico'] = $info->id_tecnico;
		}else{
			$data['user']['id_tecnico'] = '';
		}

		if($this->input->post('previsao_entrega')){
			$data['user']['previsao_entrega'] = $this->input->post('previsao_entrega');
		}elseif( $info->previsao_entrega_no_formated){
			$data['user']['previsao_entrega'] = $info->previsao_entrega_no_formated;
		}else{
			$data['user']['previsao_entrega'] = '';
		}

		if($this->input->post('solucao')){
			$data['user']['solucao'] = $this->input->post('solucao');
		}elseif( $info->solucao){
			$data['user']['solucao'] = $info->solucao;
		}else{
			$data['user']['solucao'] = '';
		}

        if($this->input->post('status')){
            $data['user']['status'] = $this->input->post('status');
        }elseif( $info->status_id){
            $data['user']['status'] = $info->status_id;
        }else{
            $data['user']['status'] = '';
        }
		$data['allTecnicos'] = $this->user_model->getAllTecnicos();
        $data['formDisabled'] = $formDisabled;
        $this->load->view('os/diagnosticar', $data);
    }


    public function index(){
        $filtrosAberto = array('status' => 1);
        $filtrosAndamento = array('status' => 2);
        $filtrosFinalizado = array('status' => 3);
        $filtrosCancelado = array('status' => 4);
        
        $data = array();
        $data['oss'] = array(
            'aberto'     => $this->os_model->getOs($filtrosAberto),
            'andamento'  => $this->os_model->getOs($filtrosAndamento),
            'finalizado' => $this->os_model->getOs($filtrosFinalizado),
            'cancelado'  => $this->os_model->getOs($filtrosCancelado)
        );

        $this->load->view('os/list', $data);
    }
}
?>
