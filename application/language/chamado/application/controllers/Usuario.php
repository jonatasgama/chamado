<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';	

class Usuario extends CI_Controller {
	
    public function __construct(){
        parent::__construct();
		$this->load->model('usuario_model');
		verificaSessao($this->session->userdata('nome'));	
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
			$this->session->set_flashdata('msg-sucesso', "Dados salvos com sucesso.");
			$this->SendEmailToAdmin();
		}else{
			$this->session->set_flashdata('msg-erro', "Ocorreu alguma falha, registro n?o foi salvo.");
		}
		//echo $this->db->last_query(); //Use para verificar a última consulta executada
        //exit();		
		redirect(base_url('/consultar-chamados/'.$this->session->userdata('id')));
	}	
	
	public function consultarChamados($id)
	{
		$data['chamados'] = $this->usuario_model->consultarChamados($id)->result();
		$this->load->view('usuario/header');
		$this->load->view('usuario/consultar_chamados', $data);
		$this->load->view('usuario/footer');
	}	
	
	private function SendEmailToAdmin(){
		$nome = $this->input->post("nome");
		$sobrenome = $this->input->post("sobrenome");
		$cargo = $this->input->post("cargo");
		$setor = $this->input->post("setor");
		$mensagem = $this->input->post("solicitacao");
		
		$msg  = "<h2>Um novo chamado foi aberto, segue informa&ccedil;&otilde;es:</h2><br>";
		$msg .= "<h4>Nome: $nome $sobrenome</h4><br>";
		$msg .= "<h4>Setor: $setor</h4><br>";
		$msg .= "<h4>Cargo: $cargo</h4><br>";
		$msg .= "<h4>Mensagem: $mensagem</h4><br>";

		//configurações do email
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Username = 'gamasouza.jonatas@gmail.com';
		$mail->Password = 'Gabi16092012';
		$mail->Port = 587;

		//configurações do destinatário
		$mail->setFrom('desenvolvimento@rssolucoesconsultoria.com', 'RS Consultoria');
		$mail->addReplyTo('no-reply@email.com.br');
		$mail->addAddress('jonatasgama@rssolucoesconsultoria.com');
		$mail->addAddress('carloslima@rssolucoesconsultoria.com');
		$mail->addAddress('desenvolvimento@rssolucoesconsultoria.com');

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
}
