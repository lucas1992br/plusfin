<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

	public function validaAutenticacao() {

		session_start();

		if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
			header('Location: /?login=erro');
		}

	}

	public function portal() {

		session_start();

		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$tb_saida = Container::getModel('Saida');

			$tb_saidas = $tb_saida->recuperarSaidaPortal();

			$this->view->tb_saidas = $tb_saidas;

			//Formas Pagamentos

			$tb_pagamento = Container::getModel('Parametros');

			$tb_pagamentos = $tb_pagamento->recuperarFormapagamentoEntrada();

			$this->view->tb_pagamentos = $tb_pagamentos;


			$this->render('portal', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}

	public function entradas() {

		session_start();

		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$tb_entrada = Container::getModel('Entrada');

			$tb_entradas = $tb_entrada->recuperarEntrada();

			$this->view->tb_entradas = $tb_entradas;

			// origens

			$tb_origem = Container::getModel('Parametros');

			$tb_origens = $tb_origem->recuperarOrigensEntrada();

			$this->view->tb_origens = $tb_origens;

			// fonte pagante

			$tb_fonte = Container::getModel('Parametros');

			$tb_fontes = $tb_fonte->recuperarFonteEntrada();

			$this->view->tb_fontes = $tb_fontes;

			// forma pagamento

			$tb_pagamento = Container::getModel('Parametros');

			$tb_pagamentos = $tb_pagamento->recuperarFormapagamentoEntrada();

			$this->view->tb_pagamentos = $tb_pagamentos;

			// saidas

			$sm_saida = Container::getModel('Saida');

			$sm_saidas = $sm_saida->somatoriaSaidas();

			$this->view->sm_saidas = $sm_saidas;


			$this->render('entradas', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}


	public function origens() {

		session_start();
		//$this->validaAutenticacao();
		if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){	

		
		$tb_atividade = Container::getModel('Parametros');

		$tb_atividades = $tb_atividade->recuperarAtividades();

		$this->view->tb_atividades = $tb_atividades;

		$tb_origen = Container::getModel('Origens');

		$tb_origens = $tb_origen->recuperarOrigem();

		$this->view->tb_origens = $tb_origens;

		$this->render('origens', 'layout3');
		} else {
			header('Location: /?login=erro');
		}
		

		
	}

	public function fontepagante() {

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$tb_fontepagante = Container::getModel('Fontepagante');

			$tb_fontepagantes = $tb_fontepagante->recuperarFonte();

			$this->view->tb_fontepagantes = $tb_fontepagantes;

			$tb_atividade = Container::getModel('Parametros');

			$tb_atividades = $tb_atividade->recuperarAtividades();

			$this->view->tb_atividades = $tb_atividades;

			$this->render('fontepagante', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}
	
	public function formapagamento() {

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {
		
			$tb_atividade = Container::getModel('Parametros');

			$tb_atividades = $tb_atividade->recuperarAtividades();

			$this->view->tb_atividades = $tb_atividades;

			$tb_formapagamento = Container::getModel('Formapagamento');

			$tb_formapagamentos = $tb_formapagamento->recuperarFormapagamento();

			$this->view->tb_formapagamentos = $tb_formapagamentos;

			$this->render('formapagamento', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}

	public function centrodecusto() {

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$tb_centrodecusto = Container::getModel('Centrodecusto');

			$tb_centrodecustos = $tb_centrodecusto->recuperarCentrocusto();

			$this->view->tb_centrodecustos = $tb_centrodecustos;

			$this->render('centrodecusto', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}

	public function saida() {

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$tb_saida = Container::getModel('Saida');

			$tb_saidas = $tb_saida->recuperarSaida();

			$this->view->tb_saidas = $tb_saidas;

			// origens

			$tb_origem = Container::getModel('Parametros');

			$tb_origens = $tb_origem->recuperarOrigens();

			$this->view->tb_origens = $tb_origens;

			// fonte pagante

			$tb_fonte = Container::getModel('Parametros');

			$tb_fontes = $tb_fonte->recuperarFonte();

			$this->view->tb_fontes = $tb_fontes;

			// forma pagamento

			$tb_pagamento = Container::getModel('Parametros');

			$tb_pagamentos = $tb_pagamento->recuperarFormapagamento();

			$this->view->tb_pagamentos = $tb_pagamentos;

			// saidas

			$sm_saida = Container::getModel('Saida');

			$sm_saidas = $sm_saida->somatoriaSaidas();

			$this->view->sm_saidas = $sm_saidas;

			$this->render('saida', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}

	public function atualizarsaidas() {

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$tb_saida = Container::getModel('Saida');

			$tb_saidas = $tb_saida->atualizarSaidatb();

			$this->view->tb_saidas = $tb_saidas;

			// origens

			$tb_origem = Container::getModel('Parametros');

			$tb_origens = $tb_origem->recuperarOrigens();

			$this->view->tb_origens = $tb_origens;

			// fonte pagante

			$tb_fonte = Container::getModel('Parametros');

			$tb_fontes = $tb_fonte->recuperarFonte();

			$this->view->tb_fontes = $tb_fontes;

			// forma pagamento

			$tb_pagamento = Container::getModel('Parametros');

			$tb_pagamentos = $tb_pagamento->recuperarFormapagamento();

			$this->view->tb_pagamentos = $tb_pagamentos;

			$this->render('atualizarsaidas', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}

	public function aprovarsaidas() {

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {
			$tb_saida = Container::getModel('Saida');

			$tb_saidas = $tb_saida->aprovarSaidatb();

			$this->view->tb_saidas = $tb_saidas;

			// origens

			$tb_origem = Container::getModel('Parametros');

			$tb_origens = $tb_origem->recuperarOrigens();

			$this->view->tb_origens = $tb_origens;

			// fonte pagante

			$tb_fonte = Container::getModel('Parametros');

			$tb_fontes = $tb_fonte->recuperarFonte();

			$this->view->tb_fontes = $tb_fontes;

			// forma pagamento

			$tb_pagamento = Container::getModel('Parametros');

			$tb_pagamentos = $tb_pagamento->recuperarFormapagamento();

			$this->view->tb_pagamentos = $tb_pagamentos;

			$this->render('aprovarsaidas', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}

	public function editarsaida() {
		
		session_start();
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		
	}

	public function atualizar_saidas() {
		
		session_start();
		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$edit_saida = Container::getModel('Saida');	

			$edit_saida->atualizarSaida();

			$this->render('atualizarsaidas', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}

	public function enviardocumento() {

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$this->render('enviardocumento', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}
	
	public function auditoriaentrada() {

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$this->render('auditoriaentrada', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}

	public function auditoriasaida() {

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$this->render('auditoriasaida', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}

	public function pagamentosaidas() {

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$tb_saida = Container::getModel('Saida');

			$tb_saidas = $tb_saida->pagamentoSaidatb();

			$this->view->tb_saidas = $tb_saidas;

			// origens

			$tb_origem = Container::getModel('Parametros');

			$tb_origens = $tb_origem->recuperarOrigens();

			$this->view->tb_origens = $tb_origens;

			// fonte pagante

			$tb_fonte = Container::getModel('Parametros');

			$tb_fontes = $tb_fonte->recuperarFonte();

			$this->view->tb_fontes = $tb_fontes;

			// forma pagamento

			$tb_pagamento = Container::getModel('Parametros');

			$tb_pagamentos = $tb_pagamento->recuperarFormapagamento();

			$this->view->tb_pagamentos = $tb_pagamentos;


			$this->render('pagamentosaidas', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}

	public function efetivarentradas() {

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$this->render('efetivarentradas', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}

	public function chequedevolvido() {

		session_start();


		if($_SESSION['id'] != '' && $_SESSION['nome'] != '') {

			$this->render('chequedevolvido', 'layout3');
		} else {
			header('Location: /?login=erro');
		}

		
	}
}

?>