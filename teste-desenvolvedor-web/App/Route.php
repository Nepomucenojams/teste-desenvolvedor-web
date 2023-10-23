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

		$routes['listarPessoa'] = array(
			'route' => '/listarPessoa',
			'controller' => 'PessoaController',
			'action' => 'listarPessoa'
		);

		$routes['cadastro_pessoa'] = array(
			'route' => '/cadastroPessoa',
			'controller' => 'PessoaController',
			'action' => 'cadastroPessoa'
		);

		$routes['cadastrarPessoa'] = array(
			'route' => '/cadastrarPessoa',
			'controller' => 'PessoaController',
			'action' => 'cadastrarPessoa'
		);

		
		$routes['cadastrarEndereco'] = array(
			'route' => '/cadastrarEndereco',
			'controller' => 'PessoaController',
			'action' => 'cadastrarEndereco'
		);

		$routes['editarPessoa'] = array(
			'route' => '/editarPessoa',
			'controller' => 'PessoaController',
			'action' => 'editarPessoa'
		);

		$routes['excluirPessoa'] = array(
			'route' => '/excluirPessoa',
			'controller' => 'PessoaController',
			'action' => 'excluirPessoa'
		);

		$routes['excluirInPessoa'] = array(
			'route' => '/excluirInPessoa',
			'controller' => 'PessoaController',
			'action' => 'excluirInPessoa'
		);

		$routes['listarPessoaPdf'] = array(
			'route' => '/listarPessoaPdf',
			'controller' => 'PessoaController',
			'action' => 'listarPessoaPdf'
		);
		
		


		

		$this->setRoutes($routes);
	}

}

?>