<?php 

if(!function_exists('getNameByUserId')){
    function getNameByUserId($user_id){
        $ci = &get_instance();
        $ci->db->select('*');
        $ci->db->from('users');
        $ci->db->where('id_user', $user_id);

        $getUser = $ci->db->get();

        return $getUser->row()->name;
    }
}

if(!function_exists('getStatusAtualEqp')){
	function getStatusAtualEqp($id_equipamento){
		$ci = &get_instance();
		$ci->db->select('*');
		$ci->db->from('os');
		$ci->db->where('id_equipamento', $id_equipamento);
		$ci->db->where_in('status', [1,2]);
		$get = $ci->db->get();

		return $get->num_rows() > 0 ? 'Em Manutenção' : 'Funcional';
	}
}
if(!function_exists('debug')){
    function debug($debug){ 
        echo "<pre>";
        print_r($debug);
        die;

    }
}

if(!function_exists('OSNumber')){
    function OSNumber($number) {
        if (strlen($number) < 5) {
            $zerosToAdd = 5 - strlen($number);        
            for ($i = 0; $i < $zerosToAdd; $i++) {
                $number = '0' . $number;
            }
        }
        
        return $number;
    }
}

if(!function_exists('getStatus')){
    function getStatus($status_id){
        switch ($status_id) {
            case '1':
                $retorno = '<span class="badge bg-warning">Aberto</span>';
                break;
            case '2':
                $retorno = '<span class="badge bg-info">Em Andamento</span>';
                break;
            case '3':
                $retorno = '<span class="badge bg-success">Finalizado</span>';
                break;
            case '4':
                $retorno = '<span class="badge bg-danger">Cancelado</span>';
                break;
            default:
                $retorno = '<span class="badge bg-warning">Aberto</span>';
                break;
        }

        return $retorno;
    }
}

if(!function_exists('getStatusUser')){
    function getStatusUser($status_id){
        switch ($status_id) {
            case '1':
                $retorno = '<span class="badge bg-info">Ativo</span>';
                break;
            case '0':
                $retorno = '<span class="badge bg-danger">Inativo</span>';
                break;
            default:
                $retorno = '<span class="badge bg-success">Ativo</span>';
                break;
        }

        return $retorno;
    }
}

if(!function_exists('formatarHorario')){
    function formatarHorario($data, $hora) {
        $meses = array(
            'January'   => 'Jan',
            'February'  => 'Fev',
            'March'     => 'Mar',
            'April'     => 'Abr',
            'May'       => 'Mai',
            'June'      => 'Jun',
            'July'      => 'Jul',
            'August'    => 'Ago',
            'September' => 'Set',
            'October'   => 'Out',
            'November'  => 'Nov',
            'December'  => 'Dez'
        );
        
        $dataFormatada = str_replace(array_keys($meses), $meses, date('d F Y', strtotime($data)));
        
        $horaFormatada = date('h:i A', strtotime($hora));
        
        $horarioFormatado = array(
            "data" => $dataFormatada,
            "hora" => $horaFormatada
        );
        
        return $horarioFormatado;
    }
}
?>
