<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

    public function index() {
        $data = array();
        $data['setores'] = $this->setor_model->getAll();
        $data['stats']   = array(
            'total_funcionarios'    => $this->user_model->getTotal(),
            'total_setor'           => $this->setor_model->getTotal(),
            'total_equipamentos'    => array('eqp' => $this->equipamentos_model->getTotal(false, 'EQP'), 'imp' => $this->equipamentos_model->getTotal(false, "IMP")),
            'total_os'              => $this->os_model->getTotal(),
            'os'                    => array(
                'aberto' => $this->os_model->getTotal(1),
                'andamento' => $this->os_model->getTotal(2),
                'finalizado' => $this->os_model->getTotal(3),
                'cancelado' => $this->os_model->getTotal(4),
            )
        );

        $data['getOSPends'] = $this->os_model->getLastOs();

        $this->load->view('dashboard', $data);
    }

    public function getOs(){
        $osNumber = $this->input->post('os');
        if(!empty($osNumber)){
            $os = $this->os_model->getOsById($osNumber);
        }

        echo json_encode($os);
    }
}
