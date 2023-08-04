<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionarios extends CI_Controller {
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
        if($this->session->userdata('roles') != "ADMIN"){
            $this->session->set_flashdata('error', 'Você não possui autorização');
            redirect('/dashboard');
        }
    }

    public function deletar($id = false){
        if($id){
            if($this->user_model->delete($id)){            
                $this->session->set_flashdata('success', 'Usuario deletado com sucesso');
            }else{
                $this->session->set_flashdata('error', 'Houve um erro ao tentar deletar o usuario');
            }
        }else{
            $this->session->set_flashdata('error', 'Funcionario não identificado');
        }
        
        redirect('/funcionarios');
    }

    public function add(){
        $route = "<span style='color: #6f6969; font-weight: 500; font-size: 21px;'>Adicionar</span>";
        
        if($this->input->post()){
                $update = $this->user_model->insert($id, $this->input->post());
                if( !$update['error'] ){            
                    $this->session->set_flashdata('success', $update['success']);
                    redirect('/funcionarios');
                }else{
                    $this->session->set_flashdata('error', $update['error'] );
                }
        }
        
        $this->form(false, $route, false);
    }

    public function ver($id = false){
        if(!$id){
            $this->session->set_flashdata('error', 'Funcionario não identificado');
            redirect('/funcionarios');
        }
        $getInfos = $this->user_model->getUserById($id);
        $route = "<span style='color: #6f6969; font-weight: 500; font-size: 21px;'>Ver</span>";
        
        $this->form($getInfos, $route, true);
    }

    public function editar($id = false){
        if(!$id){
            $this->session->set_flashdata('error', 'Funcionario não identificado');
            redirect('/funcionarios');
        }
        $getInfos = $this->user_model->getUserById($id);
        $route = "<span style='color: #6f6969; font-weight: 500; font-size: 21px;'>Editar</span>";
        
        if($this->input->post()){
            if($id){
                $update = $this->user_model->update($id, $this->input->post());
                if( !$update['error'] ){            
                    $this->session->set_flashdata('success', $update['success']);
                    redirect('/funcionarios');
                }else{
                    $this->session->set_flashdata('error', $update['error'] );
                }
            }
        }
        
        $this->form($getInfos, $route, false);
    }

    public function form($info = false, $route = false,$formDisabled = false){
        $data['route'] = $route;

        if($this->input->post('username')){
            $data['user']['username'] = $this->input->post('username');
        }elseif( $info->username){
            $data['user']['username'] = $info->username;
        }else{
            $data['user']['username'] = '';    
        }

        if($this->input->post('name')){
            $data['user']['name'] = $this->input->post('name');
        }elseif( $info->name){
            $data['user']['name'] = $info->name;
        }else{
            $data['user']['name'] = '';    
        }

        if($this->input->post('group')){
            $data['user']['group'] = $this->input->post('group');
        }elseif( $info->roles){
            $data['user']['group'] = $info->roles;
        }else{
            $data['user']['group'] = '';    
        }

        if($this->input->post('status')){
            $data['user']['status'] = $this->input->post('status');
        }elseif( isset($info->status)){
            $data['user']['status'] = (int) $info->status;
        }else{
            $data['user']['status'] = null;    
        }

        $data['formDisabled'] = $formDisabled;
        $this->load->view('usuarios/form', $data);

    }


    public function index(){
        
        $filtrosAtivo = array(
            'status' => (int) 1
        );
        $filtrosInativo = array(
            'status' => (int) 0
        );
        
        $data = array();
        $data['funcionarios'] = array(
            'all' => $this->user_model->getAll(),
            'ativo' => $this->user_model->getAll($filtrosAtivo),
            'inativo' => $this->user_model->getAll($filtrosInativo)
        );

        $this->load->view('usuarios/list', $data);
    }
}
?>