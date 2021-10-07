<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tecnico_model extends CI_Model{
	
    public function __construct(){
        parent::__construct();
    }
    
	public function loginTi($login, $senha){
		$sql = "SELECT * FROM tb_usuario WHERE login = ? AND senha = ? AND id_setor = 4";
		$result = $this->db->query($sql, array($login, $senha));
		return $result;
	}
	
	public function chamadosEmFila(){
		$sql = "SELECT c.cargo, c.hora_inicio, c.hora_fim, c.id, c.id_usuario, c.nome, c.resolucao, c.setor, c.sobrenome, c.solicitacao, c.status, u.nome AS solicitante FROM tb_chamados c JOIN tb_usuario u ON c.id_usuario = u.id WHERE c.status = 'Em fila'";
		$result = $this->db->query($sql);
		return $result;
	}
	
	public function chamadosEmAndamento(){
		$sql = "SELECT c.cargo, c.hora_inicio, c.hora_fim, c.id, c.id_usuario, c.nome, c.resolucao, c.setor, c.sobrenome, c.solicitacao, c.status, u.nome AS solicitante FROM tb_chamados c JOIN tb_usuario u ON c.id_usuario = u.id WHERE c.status = 'Em andamento'";
		$result = $this->db->query($sql);
		return $result;
	}	
	
	public function chamadosFinalizados(){
		$sql = "SELECT c.id, c.id_usuario, u.nome AS solicitante, c.nome, c.sobrenome, c.cargo, CONVERT_TZ(c.hora_inicio, '+00:00', '-03:00') AS hora_abertura, CONVERT_TZ(c.hora_andamento, '+00:00', '-03:00') AS hora_andamento, CONVERT_TZ(c.hora_fim, '+00:00', '-03:00') AS hora_fim, c.setor, c.solicitacao, c.status, c.resolucao  FROM tb_chamados c JOIN tb_usuario u ON c.id_usuario = u.id WHERE c.status = 'Finalizado' OR c.status = 'Cancelado' ORDER BY c.id";
		$result = $this->db->query($sql);
		return $result;
	}	
	
	public function emAndamento($id){
		$sql = "UPDATE tb_chamados SET status = 'Em andamento', hora_andamento = CURRENT_TIMESTAMP() WHERE id = ?";
		$result = $this->db->query($sql, array($id));
		return $result;
	}	
	
	public function cancelado($id){
		$sql = "UPDATE tb_chamados SET status = 'Cancelado' WHERE id = ?";
		$result = $this->db->query($sql, array($id));
		return $result;
	}
	
	public function finaliza($resolucao, $id){
		$sql = "UPDATE tb_chamados SET status = 'Finalizado', hora_fim = CURRENT_TIMESTAMP(), resolucao = ? WHERE id = ?";
		$result = $this->db->query($sql, array($resolucao, $id));
		return $result;
	}

}