<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';	

class Usuario extends CI_Controller {
	
    public function __construct(){	
        parent::__construct();
		$this->load->model('usuario_model');
		verificaSessao($this->session->userdata('nome'));	
		$this->load->library('pagination');
    }	

	public function novoChamado()
	{		
		$this->load->view('usuario/header');
		$this->load->view('usuario/novo_chamado');
		$this->load->view('usuario/footer');
	}
	
	public function cadastrarChamado()
	{
		$tb_chamados['nome'] = $this->input->post("nome");
		$tb_chamados['sobrenome'] = $this->input->post("sobrenome");
		$tb_chamados['cargo'] = $this->input->post("cargo");	
		$tb_chamados['setor'] = $this->input->post("setor");
		$tb_chamados['solicitacao'] = str_replace(array("\r","\n"), " ", $this->input->post("solicitacao"));
		$tb_chamados['id_usuario'] = $this->input->post("id_usuario");		
		if($this->db->insert('tb_chamados', $tb_chamados)){
			echo json_encode(array('msg' => 'Dados salvos com sucesso.'));
			$this->SendEmailToAdmin();
		}else{
			echo json_encode(array('msg' => 'Houve algum erro.'));
		}
		//echo $this->db->last_query(); //Use para verificar a última consulta executada
        //exit();		
		//redirect(base_url('/consultar-chamados/'.$this->session->userdata('id')));
	}	
	
	public function consultarChamados($id)
	{
		//$data['chamados'] = $this->usuario_model->consultarChamados($id)->result();
		$this->load->view('usuario/header');
		$this->load->view('usuario/consultar_chamados');
		$this->load->view('usuario/footer');
	}	
	
	private function SendEmailToAdmin(){
		$nome = $this->input->post("nome");
		$sobrenome = $this->input->post("sobrenome");
		$cargo = $this->input->post("cargo");
		$setor = $this->input->post("setor");
		$mensagem = $this->input->post("solicitacao");
		
		$msg  = "<h2>Um novo chamado foi aberto, segue informa&ccedil;&otilde;es:</h2><br>";
		$msg .= "<h4>Nome: $nome</h4><br>";
		$msg .= "<h4>Setor: $setor</h4><br>";
		$msg .= "<h4>Cargo: $cargo</h4><br>";
		$msg .= "<h4>Mensagem: $mensagem</h4><br>";

		//configurações do email
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Username = 'user';
		$mail->Password = 'password';
		$mail->Port = 587;

		//configurações do destinatário
		$mail->setFrom('desenvolvimento@rssolucoesconsultoria.com', 'RS Consultoria');
		$mail->addReplyTo('no-reply@email.com.br');
		$mail->addAddress('jonatasgama@rssolucoesconsultoria.com');
		$mail->addAddress('carloslima@rssolucoesconsultoria.com');

		//configurações da mensgem
		$mail->isHTML(true);
		$mail->Subject = 'Novo Chamado | RS Consultoria';
		$mail->Body    = $msg;

		//envio de email

		if(!$mail->send()) {
			echo 'Não foi possível enviar a mensagem.<br>';
			echo 'Erro: ' . $mail->ErrorInfo;
			return false;
		} else {
			return true;
		}	
	
	}
	
 public function paginacao($rowno=0){
 
        $rowperpage = 5;
 
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
  
		$query = $this->db->where('id_usuario', $this->session->userdata('id'))->get('tb_chamados');
        $allcount = $query->num_rows();
 
        $this->db->limit($rowperpage, $rowno);
		$query = $this->db->where('id_usuario', $this->session->userdata('id'))->get('tb_chamados');
		$users_record = $query->result_array();
  
        $config['base_url'] = base_url().'usuario/paginacao';
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
