<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Mpdf\Mpdf;

class Relatorios extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('equipamentos_model');
		$this->load->model('setor_model');

		if($this->session->userdata('roles') != "ADMIN"){
			$this->session->set_flashdata('error', 'Você não possui autorização');
			redirect('/dashboard');
		}

	}
	public function index(){

		if($this->input->post()) {
			$url = base_url()."relatorios/equipamentos";

			$urlForm = array();
			if($this->input->post('dateStart')){
				$urlForm['dateStart'] = $this->input->post('dateStart');
			}
			if($this->input->post('dateEnd')){
				$urlForm['dateEnd'] = $this->input->post('dateEnd');
			}
			if($this->input->post('id_setor') && implode(",",$this->input->post('id_setor'))){
				$urlForm['id_setor'] = implode(",",$this->input->post('id_setor'));
			}

			$urlFormed = http_build_query($urlForm);
			if(trim($urlFormed)) {
				$url .= '?' . $urlFormed;
			}
			redirect($url);
		}
		$data = array();
		$data['setores'] = $this->setor_model->getAll();
		$this->load->view('relatorios/index', $data);
	}
	public function equipamentos() {
		$nivel = $this->session->userdata('roles');
		if ($nivel == "ADMIN") {
			require(APPPATH . 'vendor/autoload.php');
			$mpdf = new Mpdf(['orientation' => 'L']);
			if($_GET['id_setor']){
				$setores = $_GET['id_setor'];
				$setores = explode(",", $setores);

				foreach ($setores as $setor) {
					$setor_dados = $this->setor_model->getSetorById($setor);


					if (!empty($setor_dados->name)) {
						$setor_name = $setor_dados->name;
					} else {
						$this->session->set_flashdata('erro', 'setor não identificado');
						redirect('/relatorios');
					}
					$mpdf->SetTitle('Relatorio de equipamentos - Setor: ' . $setor_name);
					$html .= "<h2 style='width:100%; text-align:center; margin-bottom:20px'>Relatorio de equipamentos - SETOR: " . $setor_name . "</h2>";
					$filtro = array('id_setor' => $setor, 'dateStart' => $_GET['dateStart'], 'dateEnd' => $_GET['dateEnd']);
					$equipamentos = $this->equipamentos_model->getAllByDesc($filtro);

					if (!empty($equipamentos)) {
						$html .= "<table>";
						$html .= "<tr>
                            <th>ID</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Serie</th>
                            <th>Ip</th>
                            <th>Num. Patrimonio</th>
                            <th>Descrição</th>
                            <th>QTD de OS</th>
                            <th>Status Atual</th>
                            <!-- Adicione mais colunas conforme necessário -->
                          </tr>";
						foreach ($equipamentos as $equipamento) {
							$html .= "<tr>
                                <td>" . $equipamento->tipo . "-" . $equipamento->id_equipamento . "</td>
                                <td>" . $equipamento->marca . "</td>
                                <td>" . $equipamento->modelo . "</td>
                                <td>" . $equipamento->serie . "</td>
                                <td>" . $equipamento->ip . "</td>
                                <td>" . $equipamento->num_patrimonio . "</td>
                                <td>" . $equipamento->descricao . "</td>
                                <td>" . $equipamento->totalEquipamentoOS . "</td>
                                <td>" . getStatusAtualEqp($equipamento->id_equipamento) . "</td>
                                <!-- Adicione mais colunas conforme necessário -->
                              </tr>";
						}
						$html .= "</table>";
					} else {
						$html .= "<p>Nenhum equipamento encontrado.</p>";
					}
				}
			}else {
				$mpdf->SetTitle('Relatorio de equipamentos');
				$html = "<h2 style='width:100%; text-align:center; margin-bottom:20px'>Relatorio de equipamentos</h2>";



				$filtro = array('id_setor' => $setor, 'dateStart' => $_GET['dateStart'], 'dateEnd' => $_GET['dateEnd']);

				$equipamentos = $this->equipamentos_model->getAllByDesc($filtro);

				if (!empty($equipamentos)) {
					$html .= "<table>";
					$html .= "<tr>
                            <th>ID</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Serie</th>
                            <th>Ip</th>
                            <th>Num. Patrimonio</th>
                            <th>Descrição</th>
                            <th>QTD de OS</th>
                            <th>Status Atual</th>
                            <!-- Adicione mais colunas conforme necessário -->
                          </tr>";
					foreach ($equipamentos as $equipamento) {
						$html .= "<tr>
                                <td>" . $equipamento->tipo . "-" . $equipamento->id_equipamento . "</td>
                                <td>" . $equipamento->marca . "</td>
                                <td>" . $equipamento->modelo . "</td>
                                <td>" . $equipamento->serie . "</td>
                                <td>" . $equipamento->ip . "</td>
                                <td>" . $equipamento->num_patrimonio . "</td>
                                <td>" . $equipamento->descricao . "</td>
                                <td>" . $equipamento->totalEquipamentoOS . "</td>
                                <td>" . getStatusAtualEqp($equipamento->id_equipamento) . "</td>
                                <!-- Adicione mais colunas conforme necessário -->
                              </tr>";
					}
					$html .= "</table>";
				} else {
					$html .= "<p>Nenhum equipamento encontrado.</p>";
				}
			}

				$html .= "<style>
                        h2 {
                            font-family: arial, sans-serif;
                        }
                        table {
                            font-family: arial, sans-serif;
                            border-collapse: collapse;
                            width: 100%;
                        }
                        td, th {
                            border: 1px solid #dddddd;
                            text-align: left;
                            padding: 8px;
                        }
                        tr:nth-child(even) {
                            background-color: #dddddd;
                        }
                      </style>";


			$mpdf->WriteHTML($html);
			$mpdf->Output();
			}
		}

}
