<?php

namespace App\Models;

use MF\Model\Model;

class Parametros extends Model {

	public function recuperarAtividades(){
		$query = 'SELECT id_atividade, nome_atividade FROM tb_atividade';
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function recuperarOrigens(){
		$query = "SELECT * FROM tb_origens WHERE status_origem = 'ativo' OR tipo_origem = 'saida' OR  tipo_origem = 'Entrada/Saida'";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function recuperarOrigensEntrada(){
		$query = "SELECT * FROM tb_origens WHERE status_origem = 'ativo' OR tipo_origem = 'entrada' OR  tipo_origem = 'Entrada/Saida'";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function recuperarFonte(){ 
		$query = "SELECT * FROM tb_fontepagante WHERE status_fonte = 'ativo' OR tipo_fonte = 'entrada' OR tipo_fonte = 'Entrada/Saida'";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function recuperarFonteEntrada(){ 
		$query = "SELECT * FROM tb_fontepagante WHERE status_fonte = 'ativo' OR tipo_fonte = 'entrada' OR tipo_fonte = 'Entrada/Saida'";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function recuperarFormapagamento(){ 
		$query = "SELECT * FROM tb_formapagamento WHERE status_formapagamento = 'ativo' OR tipo_formapagamento = 'saida' OR tipo_formapagamento = 'Entrada/Saida'";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function recuperarFormapagamentoEntrada(){ 
		$query = "SELECT * FROM tb_formapagamento WHERE status_formapagamento = 'ativo' OR tipo_formapagamento = 'entrada'  OR tipo_formapagamento = 'Entrada/Saida'";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	//Editar Saida

	public function editarSaidatb(){
		$id = $_GET['id_saida'];
		$query = 
		"SELECT * FROM tb_saida WHERE id_saida = $id
		";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_OBJ);

	}

	//Pagamento Saidas


	
}

?>