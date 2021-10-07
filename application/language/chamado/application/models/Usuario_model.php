<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model{
	
    public function __construct(){
        parent::__construct();
    }
    
	public function login($login, $senha){
		$sql = "SELECT * FROM tb_usuario WHERE login = ? AND senha = ? AND id_setor != 4";
		$result = $this->db->query($sql, array($login, $senha));
		return $result;
	}	
	
	public function consultarChamados($id){
		$sql = "SELECT * FROM tb_chamados WHERE id_usuario = ?";
		$result = $this->db->query($sql, $id);
		return $result;
	}
	


}