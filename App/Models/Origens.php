<?php

namespace App\Models;

use MF\Model\Model;

class Origens extends Model {

	private $id;
	private $nome_origem;
	private $atividade_origem;
	private $tipo_origem;
    private $status_origem;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

    public function salvarOrigens() {

		$query = "insert into tb_origens (nome_origem, atividade_origem, tipo_origem, status_origem)values(:nome_origem, :atividade_origem, :tipo_origem, :status_origem)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome_origem', $this->__get('nome_origem'));
		$stmt->bindValue(':atividade_origem', $this->__get('atividade_origem'));
		$stmt->bindValue(':tipo_origem', $this->__get('tipo_origem'));
        $stmt->bindValue(':status_origem', $this->__get('status_origem')); 
		$stmt->execute();

		return $this;
	}
	public function recuperarOrigem(){ 
		$query = 'select nome_origem, tipo_origem, status_origem, atividade_origem  from tb_origens';
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	
}

?>