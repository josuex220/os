<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipamento extends CI_Controller {
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

        if($this->session->userdata('roles') == "USER"){
            $this->session->set_flashdata('error', 'Você não possui autorização');
            redirect('/dashboard');
        }
    }

    public function deletar($id = false){
        if($this->session->userdata('roles') != "ADMIN"){
            $this->session->set_flashdata('error', 'Você não possui autorização');
            redirect('/dashboard');
        }
        if($id){
            if($this->equipamentos_model->delete($id)){            
                $this->session->set_flashdata('success', 'Equipamento deletado com sucesso');
            }else{
                $this->session->set_flashdata('error', 'Houve um erro ao tentar deletar o Equipamento');
            }
        }else{
            $this->session->set_flashdata('error', 'Equipamento não identificado');
        }
        
        redirect('/equipamento');
    }

    public function add(){
        $route = "<span style='color: #6f6969; font-weight: 500; font-size: 21px;'>Adicionar</span>";
        if($this->session->userdata('roles') != "ADMIN"){
            $this->session->set_flashdata('error', 'Você não possui autorização');
            redirect('/dashboard');
        }
        if($this->input->post()){
                $post = $this->input->post();
                $post['tipo'] = "EQP";
                $update = $this->equipamentos_model->insert($id, $post);
                if( !$update['error'] ){            
                    $this->session->set_flashdata('success', $update['success']);
                    redirect('/equipamento');
                }else{
                    $this->session->set_flashdata('error', $update['error'] );
                }
        }
        
        $this->form(false, $route, false);
    }

    public function ver($id = false){
        if(!$id){
            $this->session->set_flashdata('error', 'Equipamento não identificado');
            redirect('/equipamento');
        }
        $getInfos = $this->equipamentos_model->getEquipamentoById($id);
        $route = "<span style='color: #6f6969; font-weight: 500; font-size: 21px;'>Ver</span>";
        
        $this->form($getInfos, $route, true);
    }

    public function editar($id = false){
        if($this->session->userdata('roles') != "ADMIN"){
            $this->session->set_flashdata('error', 'Você não possui autorização');
            redirect('/dashboard');
        }
        if(!$id){
            $this->session->set_flashdata('error', 'Equipamento não identificado');
            redirect('/equipamento');
        }
        $getInfos = $this->equipamentos_model->getEquipamentoById($id);
        $route = "<span style='color: #6f6969; font-weight: 500; font-size: 21px;'>Editar</span>";
        
        if($this->input->post()){
            if($id){
                $post = $this->input->post();
                $post['tipo'] = "EQP";
                $update = $this->equipamentos_model->update($id, $post);
                if( !$update['error'] ){            
                    $this->session->set_flashdata('success', $update['success']);
                    redirect('/equipamento');
                }else{
                    $this->session->set_flashdata('error', $update['error'] );
                }
            }
        }
        
        $this->form($getInfos, $route, false);
    }

    public function form($info = false, $route = false,$formDisabled = false){
        $data['route'] = $route;

        if($this->input->post('marca')){
            $data['user']['marca'] = $this->input->post('marca');
        }elseif( $info->marca){
            $data['user']['marca'] = $info->marca;
        }else{
            $data['user']['marca'] = '';    
        }

        if($this->input->post('modelo')){
            $data['user']['modelo'] = $this->input->post('modelo');
        }elseif( $info->modelo){
            $data['user']['modelo'] = $info->modelo;
        }else{
            $data['user']['modelo'] = '';    
        }

        if($this->input->post('serie')){
            $data['user']['serie'] = $this->input->post('serie');
        }elseif( $info->serie){
            $data['user']['serie'] = $info->serie;
        }else{
            $data['user']['serie'] = '';    
        }

        if($this->input->post('ip')){
            $data['user']['ip'] = $this->input->post('ip');
        }elseif( $info->ip){
            $data['user']['ip'] = $info->ip;
        }else{
            $data['user']['ip'] = '';    
        }

        if($this->input->post('codigo')){
            $data['user']['ip'] = $this->input->post('codigo');
        }elseif( $info->codigo){
            $data['user']['codigo'] = $info->codigo;
        }else{
            $data['user']['codigo'] = '';    
        }

        if($this->input->post('garantia')){
            $data['user']['garantia'] = $this->input->post('garantia');
        }elseif( $info->garantia){
            $data['user']['garantia'] = $info->garantia;
        }else{
            $data['user']['garantia'] = '';    
        }

        if($this->input->post('ref')){
            $data['user']['ref'] = $this->input->post('ref');
        }elseif( $info->ref){
            $data['user']['ref'] = $info->ref;
        }else{
            $data['user']['ref'] = '';    
        }

        if($this->input->post('num_patrimonio')){
            $data['user']['num_patrimonio'] = $this->input->post('num_patrimonio');
        }elseif( $info->num_patrimonio){
            $data['user']['num_patrimonio'] = $info->num_patrimonio;
        }else{
            $data['user']['num_patrimonio'] = '';    
        }

        if($this->input->post('descricao')){
            $data['user']['descricao'] = $this->input->post('descricao');
        }elseif( $info->descricao){
            $data['user']['descricao'] = $info->descricao;
        }else{
            $data['user']['descricao'] = '';    
        }
        

        if($this->input->post('status')){
            $data['user']['status'] = $this->input->post('status');
        }elseif( isset($info->status)){
            $data['user']['status'] = (int) $info->status;
        }else{
            $data['user']['status'] = null;    
        }
 
        $data['formDisabled'] = $formDisabled;
        $this->load->view('equipamento/form', $data);
    }


    public function index(){
        $filtros = array('tipo' => 'EQP');
        $filtrosAtivo = array(
            'status' => (int) 1,
            'tipo'   => 'EQP'
        );
        $filtrosInativo = array(
            'status' => (int) 0,
            'tipo'   => 'EQP'
        );
        
        $data = array();
        $data['equipamentos'] = array(
            'all' => $this->equipamentos_model->getAll($filtros),
            'ativo' => $this->equipamentos_model->getAll($filtrosAtivo),
            'inativo' => $this->equipamentos_model->getAll($filtrosInativo)
        );



        $this->load->view('equipamento/list', $data);
    }
}
?>