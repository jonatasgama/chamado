<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
    public function __construct(){
        parent::__construct();
		$this->load->model('usuario_model');
		$this->load->model('tecnico_model');
		$this->load->model('padrao_model');
    }	


	public function login(){
		$login = $this->input->post('login');
		$senha = MD5($this->input->post('senha'));
		$usuario = $this->usuario_model->login($login, $senha)->result();
		$tecnico = $this->tecnico_model->loginTi($login, $senha)->result();	
		if($usuario){
			foreach($usuario as $u)
			$this->session->set_userdata('nome', $u->nome);
			$this->session->set_userdata('senha', $u->senha);
			$this->session->set_userdata('id', $u->id);
			$this->session->set_userdata('login', $u->login);
			//echo $this->db->last_query(); //Use para verificar a última consulta executada
			//exit();			
			redirect('/novo-chamado');
		}elseif($tecnico){
			foreach($tecnico as $t)
			$this->session->set_userdata('nome', $t->nome);
			$this->session->set_userdata('senha', $t->senha);
			$this->session->set_userdata('id', $t->id);
			$this->session->set_userdata('login', $t->login);
			redirect('tecnico/index');
		}else{
			$this->session->set_flashdata('msg-danger', 'Usuário ou senha incorreto.');
			redirect('/');
		}
		
	}
	
	public function logout(){
		$this->session->sess_destroy();
		$this->session->unset_userdata('nome');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('login');
		redirect('/');
	}
	
	public function alterarSenha(){		
		$senha = md5($this->input->post('senhaNova'));
		$novaSenha = $this->padrao_model->alterarSenha($senha, $this->session->userdata('id'));	
		if(!$novaSenha){		
			echo "senha atual incorreta.";
		}else{
			$this->session->set_flashdata('msg-success', 'Senha alterada com sucesso.');	
			redirect('/');
		}
	}
}
