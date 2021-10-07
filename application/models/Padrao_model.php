<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Padrao_model extends CI_Model{
	
    public function __construct(){
        parent::__construct();
    }
	
	public function alterarSenha($senha, $id){
		$sql = "UPDATE tb_usuario SET senha = ? WHERE id = ?";
		$result = $this->db->query($sql, array($senha, $id));
		return $result;
	}	

}