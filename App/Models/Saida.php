<?php

namespace App\Models;

use MF\Model\Model;

class Saida extends Model {

	private $id_saida;
	private $fpagante_saida;
	private $fpagamento_saida;
	private $data_saida;
    private $conta_saida;
	private $origem_saida;
	private $valor_saida;
	private $status_saida;
	private $obs_saida;
	private $obsauditoria_saida;
	private $obsauditoria2_saida;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}
	
    public function salvarSaida() {

		$query = "insert into tb_saida (fpagante_saida, fpagamento_saida, data_saida, conta_saida, origem_saida, valor_saida, status_saida, obs_saida, obsauditoria_saida, obsauditoria2_saida) values (:fpagante_saida, :fpagamento_saida, :data_saida, :conta_saida, :origem_saida, :valor_saida, :status_saida, :obs_saida, :obsauditoria_saida, :obsauditoria2_saida)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':fpagante_saida', $this->__get('fpagante_saida'));
		$stmt->bindValue(':fpagamento_saida', $this->__get('fpagamento_saida'));
		$stmt->bindValue(':data_saida', $this->__get('data_saida'));
        $stmt->bindValue(':conta_saida', $this->__get('conta_saida'));
		$stmt->bindValue(':origem_saida', $this->__get('origem_saida'));
		$stmt->bindValue(':valor_saida', $this->__get('valor_saida'));
		$stmt->bindValue(':status_saida', $this->__get('status_saida'));
		$stmt->bindValue(':obs_saida', $this->__get('obs_saida'));
		$stmt->bindValue(':obsauditoria_saida', $this->__get('obsauditoria_saida'));
		$stmt->bindValue(':obsauditoria2_saida', $this->__get('obsauditoria2_saida')); 
		$stmt->execute();

		return $this;
	}
	public function recuperarSaida(){ 
		$query = 
		"select 
		id_saida, fpagante_saida, fpagamento_saida, conta_saida, origem_saida, valor_saida, status_saida, obs_saida, obsauditoria_saida, obsauditoria2_saida, DATE_FORMAT(data_saida, '%d/%m/%Y') as data 
		from 
		tb_saida
		";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function somatoriaSaidas(){
		$query = 'select sum(valor_saida) as vl_saida from tb_saida';
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function atualizarSaidatb(){ 
		$query = "SELECT * FROM tb_saida WHERE status_saida = 'Atualização Pendente'";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function aprovarSaidatb(){ 
		$query = "SELECT * FROM tb_saida WHERE status_saida = 'Aprovação Pendente'";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function pagamentoSaidatb(){ 
		$query = "SELECT * FROM tb_saida WHERE status_saida = 'Pagamento Pendente'";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function atualizarSaida(){ 
		$query = 
		"UPDATE 
		tb_saida 
		SET 
		fpagante_saida = :fpagante_saida, fpagamento_saida = :fpagamento_saida, data_saida = :data_saida, valor_saida = :valor_saida, status_saida = :status_saida  
		WHERE id_saida = :id_saida";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':fpagante_saida', $this->__get('fpagante_saida'));
		$stmt->bindValue(':fpagamento_saida', $this->__get('fpagamento_saida'));
		$stmt->bindValue(':data_saida', $this->__get('data_saida'));
		$stmt->bindValue(':valor_saida', $this->__get('valor_saida'));
		$stmt->bindValue(':id_saida', $this->__get('id_saida'));
		$stmt->bindValue(':status_saida', $this->__get('status_saida'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function pagamentoSaida(){ 
		$query = 
		"UPDATE 
		tb_saida 
		SET 
		status_saida = :status_saida  
		WHERE id_saida = :id_saida";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_saida', $this->__get('id_saida'));
		$stmt->bindValue(':status_saida', $this->__get('status_saida'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function recuperarSaidaPortal(){ 
		$query = 
		"select 
		id_saida, fpagante_saida, fpagamento_saida, conta_saida, origem_saida, valor_saida, status_saida, obs_saida, obsauditoria_saida, obsauditoria2_saida, DATE_FORMAT(data_saida, '%d/%m/%Y') as data 
		from 
		tb_saida
		where
		status_saida = 'Atualização Pendente' OR status_saida = 'Aprovação Pendente' OR status_saida = 'Envio de Documentos Pendente' OR status_saida = 'Entradas Pendentes' OR status_saida = 'Pagamento Pendente'
		";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
}


?>