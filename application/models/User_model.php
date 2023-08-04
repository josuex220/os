<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    function getTotal($status = false){
        $this->db->select('*');
        $this->db->from('users');

        if(!empty($status)){
            $this->db->where('status', $status);
        }

        $get = $this->db->get();

        return $get->num_rows();
    }
    public function delete($id){
        $this->db->where('id_user', $id);
        $this->db->delete('users');
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
	public function getAllTecnicos(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('roles !=', 'USER');
		$this->db->where('id_user !=', $this->session->userdata('user_id'));

		$get = $this->db->get();
		return $get->num_rows() ? $get->result() : [];
	}
    public function update($id, $post){
        if($post['password'] != $post['confirmation_password']){
            return array('error' => 'Senhas incorretos');
        }
        if(!$post['password']){
            unset($post['password']);
        }else{
            $post['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
        }
        
        $update = array(
            'name' => $post['name'],
            'username' => $post['username'],
            'roles' => $post['group'],
            'status' => $post['status']
        );
        if($post['password']){
            $update['password'] = $post['password'];
        }
        
        $this->db->where('id_user', $id);
        $this->db->update('users', $update);

        if($this->db->affected_rows() > 0){
            return array('success' => 'Sucesso');
        }else{
            return array('error' => 'Nada foi alterado');
        }
    }
    public function insert($id, $post){
        if($post['password'] != $post['confirmation_password']){
            return array('error' => 'Senhas incorretos');
        }
        if(!$post['password']){
            return array('error' => 'Senha é Obrigatorio');
        }else{
            $post['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
        }
        
        $update = array(
            'name' => $post['name'],
            'username' => $post['username'],
            'roles' => $post['group'],
            'status' => $post['status']
        );
        if($post['password']){
            $update['password'] = $post['password'];
        }
        if($this->db->where('username', $post['username'])->get('users')->num_rows() > 0){
            return array('error' => 'O usuario já existe');
        }
        $this->db->insert('users', $update);

        if($this->db->affected_rows() > 0){
            return array('success' => 'Sucesso');
        }else{
            return array('error' => 'Nada foi alterado');
        }
    }
    public function getUserById($id){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id_user', $id);

        $get = $this->db->get();

        return $get->num_rows() ? $get->row() : [];
    }

    public function getAll($filtros = array()){
        $this->db->select('*');
        $this->db->from('users');
        if(!empty($filtros['status']) || $filtros['status'] !== null){
            $this->db->where('status', (int)$filtros['status']);
        }

        $get = $this->db->get();

        return $get->num_rows() ? $get->result() : [];
    }
    public function get_user_by_username($username) {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->row();
    }
}
