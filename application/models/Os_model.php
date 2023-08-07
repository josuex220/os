<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Os_model extends CI_Model {
    function getTotal($status = false){
        $this->db->select('*');
        $this->db->from('os');

        if(!empty($status)){
            $this->db->where('status', $status);
        }

        $get = $this->db->get();

        return $get->num_rows();
    }
    
    function getOsById($osNumber){
        $this->db->select('o.*');
        // $this->db->select('customer.name');
        $this->db->select('o.id_tecnico');
        $this->db->select('tecnico.name as tecnico_name');
        $this->db->select('s.name as setor_name');
        $this->db->select('e.ref');
        $this->db->select('e.tipo');
        $this->db->select('e.num_patrimonio');
        $this->db->select('e.modelo');
        $this->db->select('e.marca');
        $this->db->select('e.serie');
        $this->db->select('o.solicitante');
        $this->db->select('e.ip');
        $this->db->select('e.descricao');
        $this->db->select('e.garantia');
        $this->db->from('os o');
        $this->db->join('users customer', 'customer.id_user=o.id_user');
        $this->db->join('users tecnico', 'tecnico.id_user=o.id_tecnico','left');
        $this->db->join('setor s', 's.id_setor=o.id_setor');
        $this->db->join('equipamentos e', 'e.id_equipamento=o.id_equipamento');
        $this->db->where('o.id_os', $osNumber);


        $get = $this->db->get();
        $row = $get->row();

        $row->data_hora = $row->data_hora ? date("d/m/Y À\s H:i:s", strtotime($row->data_hora)) : '-';
		$row->previsao_entrega_no_formated = $row->previsao_entrega ? date("Y-m-d H:i", strtotime($row->previsao_entrega)) : '';
        $row->previsao_entrega =  $row->previsao_entrega ? date("d/m/Y À\s H:i:s", strtotime($row->previsao_entrega)) : '-';
        $row->tipo = $row->tipo == "EQP" ? 'Equipamento' : 'Impressora';
        $row->name = $row->solicitante;
		$row->status_id = $row->status;
        $row->status = getStatus($row->status);
        $row->id_os = "OS-".OSNumber($row->id_os);

        return $get->num_rows() ? $row : [];
    }
    function getLastOs($statuses = false){
        $this->db->select('o.*');
        $this->db->select('o.solicitante name');
        $this->db->select('o.id_tecnico');
        $this->db->select('tecnico.name as tecnico_name');
        $this->db->select('s.name as setor_name');
        $this->db->select('e.ref');
        $this->db->select('e.tipo');
        $this->db->select('e.modelo');
        $this->db->select('e.marca');
        $this->db->select('e.serie');
        $this->db->select('e.ip');
        $this->db->select('e.garantia');
        $this->db->from('os o');
        $this->db->join('users customer', 'customer.id_user=o.id_user','left');
        $this->db->join('users tecnico', 'tecnico.id_user=o.id_tecnico','left');
        $this->db->join('setor s', 's.id_setor=o.id_setor');
        $this->db->join('equipamentos e', 'e.id_equipamento=o.id_equipamento');

        if(!empty($statuses)){
            $this->db->where_in('o.status', implode(",", $statuses));
        }
        $this->db->order_by('o.id_os', 'DESC');
        $this->db->limit(10);
        $get = $this->db->get();

        // debug($get->result());
        return $get->num_rows() ? $get->result() : [];
    }
    function cancelar($id_os){
        $this->db->where('id_os', $id_os);
        $this->db->update('os', ['status' => 4]);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    function armazenar($id_os){
         $this->db->where('id_os', $id_os);
        $this->db->update('os', ['home_is_visible' => 1]);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
	function update($id_os, $post){
		if(!$post['status']){ return array('error' => 'Necessario ter um status!'); }
		if($post['status'] == 2) {
			if (!$post['diagnostico']) {
				return array('error' => 'Necessario ter diagnostico!');
			}
		}elseif($post['status'] == 3){
			if(!$post['solucao']){
				return array('error' => 'Necessario ter uma solução!');
			}
		}
		$dtUpdate = array();
		if($post['previsao_entrega']){
			$dtUpdate['previsao_entrega'] = $post['previsao_entrega'].":00";
		}
		if($post['diagnostico']){
			$dtUpdate['diagnostico'] = $post['diagnostico'];
		}
		if($post['id_tecnico']){
			$dtUpdate['id_tecnico'] = $post['id_tecnico'];
		}
		if($post['solucao']){
			$dtUpdate['solucao'] = $post['solucao'];
		}
		if($post['status']){
			$dtUpdate['status'] = $post['status'];
		}
		if($post['data_entrega']){
			$dtUpdate['data_entrega'] = $post['data_entrega'];
		}

		if(!$id_os){ return array('error' => 'Necessario ter uma OS associado'); }

		$this->db->where('id_os', $id_os);
		$this->db->update('os', $dtUpdate);

		if($this->db->affected_rows() > 0){
			return array('success' => "Os Atualizada com sucesso!!");
		}else{
			return array('error' => 'Houve um erro ao tentar atualizar a OS');
		}
	}
    function insert($id = false, $post = false){
        if(!$post['id_equipamento']){ return array('error' => 'Selecionar um Equipamento é Obrigatorio!'); }
        if(!$post['id_user']){ return array('error' => 'Houve um erro ao tentar identificar seu cadastro, favor sair e entrar novamente no sistema!'); }
        if(!$post['id_setor']){ return array('error' => 'Houve um erro ao tentar identificar seu setor, favor sair e entrar novamente no sistema!'); }
        if(!$post['problema_cliente']){ return array('error' => 'Necessario descrever o problema!'); }
        if(!$post['solicitante']){ return array('error' => 'Campo Solicitante é obrigatorio!'); }

        $dtInsert = array(
            'status' => $post['status'],
            'id_user'=> $post['id_user'],
            'data_hora' => $post['data_hora'],
            'data_hora_update' => $post['data_hora_update'],
            'id_equipamento' => $post['id_equipamento'],
            'id_setor' => $post['id_setor'],
            'problema_cliente' => $post['problema_cliente'],
            'obs' => $post['obs'],
            'solicitante' => $post['solicitante'],
            'status' => $post['status']
        );

        if($this->db->where('id_equipamento', $dtInsert['id_equipamento'])->where_in('status',[1,2])->get('os')->num_rows() > 0){
            return array('error' => "Já Existe uma OS aberta para esse equipamento");
        }

        $this->db->insert('os', $dtInsert);
    }
    function getOs($filtros = false){
        $this->db->select('o.*');
        $this->db->select('o.solicitante name');
        $this->db->select('o.id_tecnico');
        $this->db->select('tecnico.name as tecnico_name');
        $this->db->select('s.name as setor_name');
        $this->db->select('e.ref');
        $this->db->select('e.tipo');
        $this->db->select('e.modelo');
        $this->db->select('e.marca');
        $this->db->select('e.serie');
        $this->db->select('e.ip');
        $this->db->select('e.garantia');
        $this->db->from('os o');
        $this->db->join('users customer', 'customer.id_user=o.id_user');
        $this->db->join('users tecnico', 'tecnico.id_user=o.id_tecnico','left');
        $this->db->join('setor s', 's.id_setor=o.id_setor');
        $this->db->join('equipamentos e', 'e.id_equipamento=o.id_equipamento');

		if(!empty($filtros['status']) || $filtros['status'] !== null){
			$this->db->where('o.status', (int)$filtros['status']);
		}
		if(!empty($filtros['num_patrimonio']) || $filtros['num_patrimonio'] !== null){
			$this->db->like('REPLACE(REPLACE(REPLACE(e.num_patrimonio,"-","")," ",""),"_","")', str_replace(array("-","_"," "), "",$filtros['num_patrimonio']));
		}



		$this->db->order_by('o.id_os', 'ASC');

        $get = $this->db->get();

        // debug($get->result());
        return $get->num_rows() ? $get->result() : [];
    }
}
?>
