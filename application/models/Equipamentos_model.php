<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipamentos_model extends CI_Model {
    function getTotal($status = false, $tipo = false){
        $this->db->select('*');
        $this->db->from('equipamentos');

        if(!empty($status)){
            $this->db->where('status', $status);
        }

        if(!empty($tipo)){
            if($tipo != "IMP" && $tipo != "EQP"){
                return array('error'=> 'Tipo passado incorreto');
            }
            
            $this->db->where('tipo', $tipo);
        }

        $get = $this->db->get();

        return $get->num_rows();
    }
    public function insert($id, $post){
        if(!$post['modelo']){
            return array('error' => 'Campo modelo é obrigatorio');
        }
        if(!$post['marca']){
            return array('error' => 'Campo marca é obrigatorio');
        }
        if(!$post['num_patrimonio']){
            return array('error' => 'Campo numero do patrimonio é obrigatorio');
        }
        if(!$post['codigo']){
            return array('error' => 'Campo codigo do equipamento é obrigatorio');
        }

        $update = array(
            'tipo' => $post['tipo'],
            'status' => $post['status'],
            'modelo' => $post['modelo'],
            'marca' => $post['marca'],
            'serie' => $post['serie'],
            'ip' => $post['ip'],
            'garantia' => $post['garantia'],
            'ref' => $post['ref'],
            'num_patrimonio' => $post['num_patrimonio'],
            'descricao' => $post['descricao'],
            'codigo' => $post['codigo'],
        );

        if($this->db->where('num_patrimonio', $post['num_patrimonio'])->get('equipamentos')->num_rows() > 0){
            return array('error' => 'Já existe um equipamento cadastrado com esse Número de Patrimonio');
        }
        $this->db->insert('equipamentos', $update);

        if($this->db->affected_rows() > 0){
            return array('success' => 'Sucesso');
        }else{
            return array('error' => 'Nada foi alterado');
        }
    }
    
    public function update($id, $post){
        if(!$post['modelo']){
            return array('error' => 'Campo modelo é obrigatorio');
        }
        if(!$post['marca']){
            return array('error' => 'Campo marca é obrigatorio');
        }
        if(!$post['num_patrimonio']){
            return array('error' => 'Campo numero do patrimonio é obrigatorio');
        }
        if(!$post['codigo']){
            return array('error' => 'Campo codigo do equipamento é obrigatorio');
        }

        $update = array(
            'tipo' => $post['tipo'],
            'status' => $post['status'],
            'modelo' => $post['modelo'],
            'marca' => $post['marca'],
            'serie' => $post['serie'],
            'ip' => $post['ip'],
            'garantia' => $post['garantia'],
            'ref' => $post['ref'],
            'num_patrimonio' => $post['num_patrimonio'],
            'descricao' => $post['descricao'],
            'codigo' => $post['codigo'],
        );

        $this->db->where('id_equipamento', $id);
        $this->db->update('equipamentos', $update);

        if($this->db->affected_rows() > 0){
            return array('success' => 'Sucesso');
        }else{
            return array('error' => 'Nada foi alterado');
        }
    }
    public function delete($id){
        $this->db->where('id_equipamento', $id);
        $this->db->delete('equipamentos');
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function getEquipamentoById($id){
        $this->db->select('*');
        $this->db->from('equipamentos');
        $this->db->where('id_equipamento', $id);

        $get = $this->db->get();

        return $get->num_rows() ? $get->row() : [];
    }
	public function getAllByDesc($filtros = array()){
		if($filtros['id_setor']){
			$filtroSetor = "AND id_setor=".$filtros['id_setor'];
		}
		if($filtros['dateStart']){
			$filtroSetor .= " AND DATE(data_hora) >= '".$filtros['dateStart']."'";
		}
		if($filtros['dateEnd']){
			$filtroSetor .= " AND DATE(data_hora) <= '".$filtros['dateEnd']."'";
		}

		$this->db->select('*');
		$this->db->select('(SELECT COUNT(id_os) FROM os WHERE os.id_equipamento=equipamentos.id_equipamento '. $filtroSetor .') totalEquipamentoOS');
		$this->db->from('equipamentos');

		if(!empty($filtros['status']) || $filtros['status'] !== null){
			$this->db->where('status', (int)$filtros['status']);
		}

		if(!empty($filtros['tipo']) || $filtros['tipo'] !== null){
			$this->db->where('tipo', $filtros['tipo']);
		}
		if(!empty($filtros['num_patrimonio']) || $filtros['num_patrimonio'] !== null){
			$this->db->like('REPLACE(REPLACE(REPLACE(num_patrimonio,"-","")," ",""),"_","")', str_replace(array("-","_"," "), "",$filtros['num_patrimonio']));
		}
		$this->db->order_by('totalEquipamentoOS','desc');
		$get = $this->db->get();

		return $get->num_rows() ? $get->result() : [];
	}
    public function getAll($filtros = array()){
        $this->db->select('*');
        $this->db->from('equipamentos');
        
        if(!empty($filtros['status']) || $filtros['status'] !== null){
            $this->db->where('status', (int)$filtros['status']);
        }

		if(!empty($filtros['tipo']) || $filtros['tipo'] !== null){
			$this->db->where('tipo', $filtros['tipo']);
		}
		if(!empty($filtros['num_patrimonio']) || $filtros['num_patrimonio'] !== null){
			$this->db->like('REPLACE(REPLACE(REPLACE(num_patrimonio,"-","")," ",""),"_","")', str_replace(array("-","_"," "), "",$filtros['num_patrimonio']));
		}
        $get = $this->db->get();

        return $get->num_rows() ? $get->result() : [];
    }
}
?>
