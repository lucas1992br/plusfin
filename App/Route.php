<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['portal'] = array(
			'route' => '/portal',
			'controller' => 'AppController',
			'action' => 'portal'
		);
		// saidas
		$routes['saida'] = array(
			'route' => '/saida',
			'controller' => 'AppController',
			'action' => 'saida'
		);

		$routes['saida_cadastro'] = array(
			'route' => '/saida_cadastro',
			'controller' => 'CadController',
			'action' => 'saida_cadastro'
		);

		//atualizar saida
		$routes['atualizarsaidas'] = array(
			'route' => '/atualizarsaidas',
			'controller' => 'AppController',
			'action' => 'atualizarsaidas'
		);

		$routes['atualizar_saidas'] = array(
			'route' => '/atualizar_saidas',
			'controller' => 'CadController',
			'action' => 'atualizar_saidas'
		);

		// Aprovar Saidas
		$routes['aprovarsaidas'] = array(
			'route' => '/aprovarsaidas',
			'controller' => 'AppController',
			'action' => 'aprovarsaidas'
		);

		$routes['aprovar_saidas'] = array(
			'route' => '/aprovar_saidas',
			'controller' => 'CadController',
			'action' => 'aprovar_saidas'
		);
		// Pagamento saidas
		$routes['pagamentosaidas'] = array(
			'route' => '/pagamentosaidas',
			'controller' => 'AppController',
			'action' => 'pagamentosaidas'
		);

		$routes['pagamento_saidas'] = array(
			'route' => '/pagamento_saidas',
			'controller' => 'CadController',
			'action' => 'pagamento_saidas'
		);

		// Editar Saida

		$routes['editarsaida'] = array(
			'route' => '/editarsaida',
			'controller' => 'AppController',
			'action' => 'editarsaida'
		);
		
		// entradas
		$routes['entradas'] = array(
			'route' => '/entradas',
			'controller' => 'AppController',
			'action' => 'entradas'
		);

		$routes['entrada_cadastro'] = array(
			'route' => '/entrada_cadastro',
			'controller' => 'CadController',
			'action' => 'entrada_cadastro'
		);

		$routes['efetivarentradas'] = array(
			'route' => '/efetivarentradas',
			'controller' => 'AppController',
			'action' => 'efetivarentradas'
		);

		//chequedevolvido  

		$routes['chequedevolvido'] = array(
			'route' => '/chequedevolvido',
			'controller' => 'AppController',
			'action' => 'chequedevolvido'
		);

		// auditoria

		$routes['auditoriaentrada'] = array(
			'route' => '/auditoriaentrada',
			'controller' => 'AppController',
			'action' => 'auditoriaentrada'
		);

		$routes['auditoriasaida'] = array(
			'route' => '/auditoriasaida',
			'controller' => 'AppController',
			'action' => 'auditoriasaida'
		);

		// envio de documentos

		$routes['enviardocumento'] = array(
			'route' => '/enviardocumento',
			'controller' => 'AppController',
			'action' => 'enviardocumento'
		);

		// Origens

		$routes['origens'] = array(
			'route' => '/origens',
			'controller' => 'AppController',
			'action' => 'origens'
		);

		$routes['cadastro_origem'] = array(
			'route' => '/cadastro_origem',
			'controller' => 'CadController',
			'action' => 'cadastro_origem'
		);

		//fonte pagante

		$routes['fontepagante'] = array(
			'route' => '/fontepagante',
			'controller' => 'AppController',
			'action' => 'fontepagante'
		);

		$routes['Fonte_pagante'] = array(
			'route' => '/Fonte_pagante',
			'controller' => 'CadController',
			'action' => 'Fonte_pagante'
		);

		//forma de pagamento


		$routes['formapagamento'] = array(
			'route' => '/formapagamento',
			'controller' => 'AppController',
			'action' => 'formapagamento'
		);

		$routes['forma_pagamento'] = array(
			'route' => '/forma_pagamento',
			'controller' => 'CadController',
			'action' => 'forma_pagamento'
		);
		//centro de custo

		$routes['centrodecusto'] = array(
			'route' => '/centrodecusto',
			'controller' => 'AppController',
			'action' => 'centrodecusto'
		);

		$routes['centro_custo'] = array(
			'route' => '/centro_custo',
			'controller' => 'CadController',
			'action' => 'centro_custo'
		);

		//logof

		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);

		$this->setRoutes($routes);
	}

}

?>