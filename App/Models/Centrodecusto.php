<?php

namespace App\Models;

use MF\Model\Model;

class Centrodecusto extends Model {

	private $id_centrodecusto;
	private $nome_centrodecusto;
	private $atividade_centrodecusto;
	private $tipo_centrodecusto;
    private $status_centrodecusto;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

    public function salvarCentrocusto() {

		$query = "insert into tb_centrodecusto (nome_centrodecusto, atividade_centrodecusto, tipo_centrodecusto, status_centrodecusto)values(:nome_centrodecusto, :atividade_centrodecusto, :tipo_centrodecusto, :status_centrodecusto)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome_centrodecusto', $this->__get('nome_centrodecusto'));
		$stmt->bindValue(':atividade_centrodecusto', $this->__get('atividade_centrodecusto'));
		$stmt->bindValue(':tipo_centrodecusto', $this->__get('tipo_centrodecusto'));
        $stmt->bindValue(':status_centrodecusto', $this->__get('status_centrodecusto')); 
		$stmt->execute();

		return $this;
	}
	public function recuperarCentrocusto(){ 
		$query = 'select nome_centrodecusto, atividade_centrodecusto, tipo_centrodecusto, status_centrodecusto  from tb_centrodecusto';
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	
}

?>