<?php

namespace App\Models;

use MF\Model\Model;

class Formapagamento extends Model {

	private $id_formapagamento;
	private $nome_formapagamento;
	private $status_formapagamento;
	private $atividade_formapagamento;
    private $tipo_formapagamento;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

    public function salvarFormapagamento() {

		$query = "insert into tb_formapagamento (nome_formapagamento, status_formapagamento, atividade_formapagamento, tipo_formapagamento)values(:nome_formapagamento, :status_formapagamento, :atividade_formapagamento, :tipo_formapagamento)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome_formapagamento', $this->__get('nome_formapagamento'));
		$stmt->bindValue(':status_formapagamento', $this->__get('status_formapagamento'));
		$stmt->bindValue(':atividade_formapagamento', $this->__get('atividade_formapagamento'));
        $stmt->bindValue(':tipo_formapagamento', $this->__get('tipo_formapagamento')); 
		$stmt->execute();

		return $this;
	}
	public function recuperarFormapagamento(){ 
		$query = 'select nome_formapagamento, status_formapagamento, atividade_formapagamento, tipo_formapagamento  from tb_formapagamento';
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	
}

?>