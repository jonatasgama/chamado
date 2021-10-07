<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tecnico extends CI_Controller {	

    public function __construct(){
        parent::__construct();
		$this->load->model('tecnico_model');
		verificaSessao($this->session->userdata('nome'));	
		$this->load->library('pagination');		
    }	

	public function index()
	{
		$this->load->view('tecnico/header');
		$this->load->view('tecnico/index');		
		$this->load->view('tecnico/footer');		
	}
	
	public function cadastrarChamado()
	{
		$tb_chamados['nome'] = $this->input->post("nome");
		$tb_chamados['sobrenome'] = $this->input->post("sobrenome");
		$tb_chamados['cargo'] = $this->input->post("cargo");	
		$tb_chamados['setor'] = $this->input->post("setor");
		$tb_chamados['solicitacao'] = $this->input->post("solicitacao");	
		$tb_chamados['id_usuario'] = $this->input->post("id_usuario");		
		if($this->db->insert('tb_chamados', $tb_chamados)){
			$this->session->set_flashdata('msg-sucesso', "Dados salvos com sucesso.");
		}else{
			$this->session->set_flashdata('msg-erro', "Ocorreu alguma falha, registro n?o foi salvo.");
		}		
		redirect(base_url('/consultar-chamados/'.$this->session->userdata('id')));
	}	

	public function chamadosEmFila(){
		$data['chamados'] = $this->tecnico_model->chamadosEmFila()->result();
		$this->load->view('tecnico/header');
		$this->load->view('tecnico/chamados_em_fila', $data);
		$this->load->view('tecnico/footer');		
	}	
	
	public function chamadosEmAndamento(){
		$data['chamados'] = $this->tecnico_model->chamadosEmAndamento()->result();
		$this->load->view('tecnico/header');
		$this->load->view('tecnico/chamados_em_andamento', $data);
		$this->load->view('tecnico/footer');		
	}		

	public function chamadosFinalizados(){		
		//$data['chamados'] = $this->tecnico_model->chamadosFinalizados()->result();
		$this->load->view('tecnico/header');
		$this->load->view('tecnico/chamados_finalizados');
		$this->load->view('tecnico/footer');
	}
	
	public function emAndamento($id){
		$this->tecnico_model->emAndamento($id)->result();
		redirect('tecnico/chamados_em_andamento');
	}
	
	public function cancelado($id){
		$this->tecnico_model->cancelado($id)->result();
		redirect('tecnico/chamados_finalizados');
	}	

	public function finaliza(){
		$id = $this->input->post('id');
		$tb_chamados = array(
			'resolucao' => $this->input->post('resolucao'),
			'status' => 'Finalizado',
			'hora_fim' => date('Y-m-d H:i:s'),
			'finalizado_por' => $this->session->userdata('nome')
		);
		$this->db->where('id', $id);
		$this->db->update('tb_chamados', $tb_chamados);
		//echo $this->db->last_query(); //Use para verificar a última consulta executada
        //exit();			
		redirect('tecnico/chamadosFinalizados');	
	}	
	
	public function cancela(){
		$id = $this->input->post('id');
		$tb_chamados = array(
			'resolucao' => $this->input->post('resolucao'),
			'status' => 'Cancelado',
			'hora_fim' => date('Y-m-d H:i:s'),
			'finalizado_por' => $this->session->userdata('nome')
		);
		$this->db->where('id', $id);
		$this->db->update('tb_chamados', $tb_chamados);
		redirect('tecnico/chamadosFinalizados');		
	}
	
	public function andamento($id){
		$tb_chamados = array(
			'status' => 'Em andamento',
			'hora_andamento' => date('Y-m-d H:i:s')
		);
		$this->db->where('id', $id);
		$this->db->update('tb_chamados', $tb_chamados);
		redirect('tecnico/chamadosEmAndamento');		
	}
	
	public function extrairFinalizados(){
			$productResult = $this->tecnico_model->chamadosFinalizados()->result_array();
			if (isset($_POST["export"])) {
				$filename = "Chamados_finalizados.xls";
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=\"$filename\"");
				$isPrintHeader = false;
				if (! empty($productResult)) {
					foreach ($productResult as $row) {
						if (! $isPrintHeader) {
							echo implode("\t", array_keys($row)) . "\n";
							$isPrintHeader = true;
						}
						echo implode("\t", array_values($row)) . "\n";
					}
				}
				exit();
		}
	}

    public function paginacao($rowno=0){
 
        $rowperpage = 5;
 
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
  
		$query = $this->db->where('status', 'Finalizado')->or_where('status', 'Cancelado')->get('tb_chamados');
        $allcount = $query->num_rows();
 
        $this->db->limit($rowperpage, $rowno);
        //$users_record = $this->db->where('status', 'Finalizado')->or_where('status', 'Cancelado')->get('tb_chamados')->result_array();
		$this->db->select("tb_chamados.id, tb_chamados.id_usuario, tb_chamados.nome AS `favorecido`, tb_chamados.sobrenome, tb_chamados.cargo, CONVERT_TZ(tb_chamados.hora_inicio, '+00:00', '-03:00') AS `abertura`, CONVERT_TZ(tb_chamados.hora_andamento, '+00:00', '-03:00') AS `andamento`, CONVERT_TZ(tb_chamados.hora_fim, '+00:00', '-03:00') AS `fim`, tb_chamados.setor, tb_chamados.solicitacao, tb_chamados.status, tb_chamados.resolucao, tb_usuario.nome AS `solicitante`");
		$this->db->from('tb_chamados');
		$this->db->join('tb_usuario', 'tb_usuario.id = tb_chamados.id_usuario');
		//$this->db->where('tb_chamados.hora_fim >', '2019-06-20 12:00:00');		
		$this->db->where('tb_chamados.status', 'Finalizado');
		$this->db->or_where('tb_chamados.status', 'Cancelado');
		$query = $this->db->get();
		$users_record = $query->result_array();
  
        $config['base_url'] = base_url().'tecnico/paginacao';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;
 
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']  	= '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] 	= '</span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] 	= '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']  	= '</span></li>';
 
        $this->pagination->initialize($config);
 
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $users_record;
        $data['row'] = $rowno;
 
        echo json_encode($data);
  }
	
}
