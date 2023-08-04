<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setor_model extends CI_Model {
    function getTotal($status = false){
        $this->db->select('*');
        $this->db->from('setor');

        if(!empty($status)){
            $this->db->where('status', $status);
        }

        $get = $this->db->get();

        return $get->num_rows();
    }
    public function insert($id, $post){
        if(!$post['name']){
            return array('error' => 'Campo nome é obrigatorio');
        }

        $update = array(
            'name' => $post['name'],
            'status' => $post['status']
        );

        if($this->db->where('name', $post['name'])->get('setor')->num_rows() > 0){
            return array('error' => 'O setor já existe');
        }
        $this->db->insert('setor', $update);

        if($this->db->affected_rows() > 0){
            return array('success' => 'Sucesso');
        }else{
            return array('error' => 'Nada foi alterado');
        }
    }
    public function update($id, $post){
        if(!$post['name']){
            return array('error' => 'Campo nome é obrigatorio');
        }
        $update = array(
            'name' => $post['name'],
            'status' => $post['status']
        );
        $this->db->where('id_setor', $id);
        $this->db->update('setor', $update);

        if($this->db->affected_rows() > 0){
            return array('success' => 'Sucesso');
        }else{
            return array('error' => 'Nada foi alterado');
        }
    }

    public function delete($id){
        $this->db->where('id_setor', $id);
        $this->db->delete('setor');
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getSetorById($id){
        $this->db->select('*');
        $this->db->from('setor');
        $this->db->where('id_setor', $id);

        $get = $this->db->get();

        return $get->num_rows() ? $get->row() : [];
    }

    public function getAll($filtros = array()){
        $this->db->select('*');
        $this->db->from('setor');
        if(!empty($filtros['status']) || $filtros['status'] !== null){
            $this->db->where('status', (int)$filtros['status']);
        }

        $get = $this->db->get();

        return $get->num_rows() ? $get->result() : [];
    }
}
