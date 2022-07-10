<?php

namespace App\Models;

use MF\Model\Model;

class Fontepagante extends Model {

	private $id_fonte;
	private $nome_fonte;
	private $tipo_fonte;
	private $status_fonte;
    private $atividade_fonte;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

    public function salvarFonte() {

		$query = "insert into tb_fontepagante (nome_fonte, tipo_fonte, status_fonte, atividade_fonte)values(:nome_fonte, :tipo_fonte, :status_fonte, :atividade_fonte)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome_fonte', $this->__get('nome_fonte'));
		$stmt->bindValue(':tipo_fonte', $this->__get('tipo_fonte'));
		$stmt->bindValue(':status_fonte', $this->__get('status_fonte'));
        $stmt->bindValue(':atividade_fonte', $this->__get('atividade_fonte')); 
		$stmt->execute();

		return $this;
	}
	public function recuperarFonte(){ 
		$query = 'select * from tb_fontepagante';
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	
}

?>