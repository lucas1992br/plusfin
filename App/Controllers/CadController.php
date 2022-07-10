<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class CadController extends Action{

	public function cadastro_origem() {
		$cadastroorigem = Container::getModel('Origens');

		$cadastroorigem->__set('nome_origem', $_POST['nome_origem']);
		$cadastroorigem->__set('atividade_origem', $_POST['atividade_origem']);
		$cadastroorigem->__set('tipo_origem', $_POST['tipo_origem']);
		$cadastroorigem->__set('status_origem', $_POST['status_origem']);
		$cadastroorigem->salvarOrigens();

		header('location: origens');
	}
	
	public function Fonte_pagante(){
		$cadastrofonte = Container::getModel('Fontepagante');
		$cadastrofonte->__set('nome_fonte', $_POST['nome_fonte']);
		$cadastrofonte->__set('tipo_fonte', $_POST['tipo_fonte']);
		$cadastrofonte->__set('atividade_fonte', $_POST['atividade_fonte']);
		$cadastrofonte->__set('status_fonte', $_POST['status_fonte']);
		$cadastrofonte->salvarFonte();

		header('location: fontepagante');
	}

	public function centro_custo(){
		$cadastrofonte = Container::getModel('Centrodecusto');
		$cadastrofonte->__set('nome_centrodecusto', $_POST['nome_centrodecusto']);
		$cadastrofonte->__set('atividade_centrodecusto', $_POST['atividade_centrodecusto']);
		$cadastrofonte->__set('tipo_centrodecusto', $_POST['tipo_centrodecusto']);
		$cadastrofonte->__set('status_centrodecusto', $_POST['status_centrodecusto']);
		$cadastrofonte->salvarCentrocusto();

		header('location: centrodecusto');
	}


	public function forma_pagamento(){
		$cadastroformapg = Container::getModel('Formapagamento');
		$cadastroformapg->__set('nome_formapagamento', $_POST['nome_formapagamento']);
		$cadastroformapg->__set('status_formapagamento', $_POST['status_formapagamento']);
		$cadastroformapg->__set('atividade_formapagamento', $_POST['atividade_formapagamento']);
		$cadastroformapg->__set('tipo_formapagamento', $_POST['tipo_formapagamento']);
		$cadastroformapg->salvarFormapagamento();
		header('location: formapagamento');
	}
	
	public function saida_cadastro(){
		
		$saida = Container::getModel('Saida');
		$saida->__set('fpagante_saida', $_POST['fpagante_saida']);
		$saida->__set('fpagamento_saida', $_POST['fpagamento_saida']);
		$saida->__set('data_saida', $_POST['data_saida']);
		$saida->__set('conta_saida', $_POST['conta_saida']);
		$saida->__set('origem_saida', $_POST['origem_saida']);
		$saida->__set('valor_saida', str_replace(',', '.',str_replace('.', '',$_POST['valor_saida'])));
		$saida->__set('status_saida', $_POST['status_saida']);
		$saida->__set('obs_saida', $_POST['obs_saida']);
		$saida->__set('obsauditoria_saida', $_POST['obsauditoria_saida']);
		$saida->__set('obsauditoria2_saida', $_POST['obsauditoria2_saida']);
		$saida->salvarSaida();
		header('location: saida');
		
		
	}
	public function entrada_cadastro(){
		
		/*$entradaCadastro = Container::getModel('Entrada');
		$entradaCadastro->__set('valor_entrada_origem', str_replace(',', '.',str_replace('.', '',$_POST['valor_entrada_origem'])));
		$entradaCadastro->__set('valor_entrada_fpagamento', str_replace(',', '.',str_replace('.', '',$_POST['valor_entrada_fpagamento'])));
		$entradaCadastro->__set('data_entrada', $_POST['data_entrada']);
		$entradaCadastro->__set('origem_entrada', $_POST['origem_entrada']);
		$entradaCadastro->__set('fpagamento_entrada', $_POST['fpagamento_entrada']);
		$entradaCadastro->__set('obs_entrada', $_POST['obs_entrada']);
		$entradaCadastro->salvarEntrada();*/
		
		echo '<pre>';
		echo print_r($_POST);
		echo '</pre>';
		
		
		
		
		
		//header('location: entradas');
	

		
		
	}
	
	public function atualizar_saidas() {
		
	$edit_saida = Container::getModel('Saida');	
	$edit_saida->__set('fpagante_saida', $_POST['fpagante_saida']);
	$edit_saida->__set('id_saida', $_POST['id_saida']);
	$edit_saida->__set('fpagamento_saida', $_POST['fpagamento_saida']);
	$edit_saida->__set('data_saida', $_POST['data_saida']);
	$edit_saida->__set('status_saida', $_POST['status_saida']);
	$edit_saida->__set('valor_saida', str_replace(',', '.',str_replace('.', '',$_POST['valor_saida'])));
	$edit_saida->atualizarSaida();
	header('location: atualizarsaidas');

	
		
	}
	public function aprovar_saidas() {
		
		$aprovar_saida = Container::getModel('Saida');	
		$aprovar_saida->__set('fpagante_saida', $_POST['fpagante_saida']);
		$aprovar_saida->__set('id_saida', $_POST['id_saida']);
		$aprovar_saida->__set('fpagamento_saida', $_POST['fpagamento_saida']);
		$aprovar_saida->__set('data_saida', $_POST['data_saida']);
		$aprovar_saida->__set('status_saida', $_POST['status_saida']);
		$aprovar_saida->__set('valor_saida', str_replace(',', '.',str_replace('.', '',$_POST['valor_saida'])));
		$aprovar_saida->atualizarSaida();
		header('location: aprovarsaidas');
	
		
			
		}
	
		public function pagamento_saidas() {
		
			$aprovar_saida = Container::getModel('Saida');	
			$aprovar_saida->__set('id_saida', $_POST['id_saida']);
			$aprovar_saida->__set('data_saida', $_POST['data_saida']);
			$aprovar_saida->__set('status_saida', $_POST['status_saida']);
			$aprovar_saida->pagamentoSaida();
			header('location: pagamentosaidas');
		
			
				
			}
} 




?>