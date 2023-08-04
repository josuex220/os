<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('setor_model');
    }

    public function index() {
        
        if($this->session->userdata('user_id')){
            redirect('/dashboard');
        }
        $data = array();
        $data['setores'] = $this->setor_model->getAll();
       
        $this->load->view('login', $data);
    }

    public function login() {
        
        if($this->session->userdata('user_id')){
            redirect('/dashboard');
        }
        $this->form_validation->set_rules('login', 'Nome de Usuário', 'required');
        $this->form_validation->set_rules('senha', 'Senha', 'required');
        $this->form_validation->set_rules('setor', 'Setor', 'required');

        $data = array();
        $data['setores'] = $this->setor_model->getAll();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login', $data);
        } else {
            $username = $this->input->post('login');
            $password = $this->input->post('senha');
            $setor = $this->input->post('setor');

            $user = $this->user_model->get_user_by_username($username);

            if ($user && password_verify($password, $user->password)) {
                $user_data = array(
                    'user_id' => $user->id_user,
                    'username' => $user->username,
                    'setor' => $setor,
                    'roles' => $user->roles
                );

                $this->session->set_userdata($user_data);

                redirect('dashboard'); 
            } else {
                $data['login_error'] = 'Credenciais inválidas';
                $this->load->view('login', $data);
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
