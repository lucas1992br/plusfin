<?php

namespace App\Models;

use MF\Model\Model;

class Entrada extends Model {

	private $id_entrada;
	private $data_entrada;
	private $origem_entrada;
	private $valor_entrada_origem;
    private $valor_entrada_fpagamento;
	private $obs_entrada;
	private $valor_entrada;
	private $obsauditoria_entrada;
	private $obsauditoria2_entrada;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}
	
    public function salvarEntrada() {

		$query = "INSERT INTO tb_entrada (id_entrada, data_entrada, origem_entrada, fpagamento_entrada, valor_entrada_origem, valor_entrada_fpagamento, obs_entrada, valor_entrada, obsauditoria_entrada, obsauditoria2_entrada) VALUES ( :data_entrada, :origem_entrada, :fpagamento_entrada, :valor_entrada_origem, :valor_entrada_fpagamento, :obs_entrada, :valor_entrada, :obsauditoria_entrada, :obsauditoria2_entrada)";
		
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':data_entrada', $this->__get('data_entrada'));
		$stmt->bindValue(':origem_entrada', $this->__get('origem_entrada'));
		$stmt->bindValue(':fpagamento_entrada', $this->__get('fpagamento_entrada'));
        $stmt->bindValue(':valor_entrada_origem', $this->__get('valor_entrada_origem'));
		$stmt->bindValue(':valor_entrada_fpagamento', $this->__get('valor_entrada_fpagamento'));
		$stmt->bindValue(':obs_entrada', $this->__get('obs_entrada'));
		$stmt->bindValue(':valor_entrada', $this->__get('valor_entrada'));
		$stmt->bindValue(':obsauditoria_entrada', $this->__get('obsauditoria_entrada'));
		$stmt->bindValue(':obsauditoria2_entrada', $this->__get('obsauditoria2_entrada'));
		$stmt->execute();

		return $this;
		
	}
	public function recuperarEntrada() {

		$query = 
		"select 
		id_entrada, origem_entrada, conta_saida, valor_entrada_origem, fpagamento_entrada, valor_entrada_fpagamento, obs_entrada, valor_entrada, obsauditoria_entrada, obsauditoria2_entrada, DATE_FORMAT(data_entrada, '%d/%m/%Y') as data 
		from 
		tb_entrada
		";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
	}
}


?>