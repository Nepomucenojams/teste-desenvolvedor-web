<?php

namespace App\Controllers;

//os recursos do projeto
use MF\Controller\Action;
use MF\Model\Container;


//os models
use App\Models\Pessoa;


class IndexController extends Action
{

	public function index()
	{

		
		$pessoa = Container::getModel('Pessoa');
		$dadosUf = $dadosPessoa = $pessoa->somaUf();
		
		$ufs = array();
		$quantidades = array();

		foreach ($dadosUf as $item) {
			$ufs[] = $item['uf'];
			$quantidades[] = $item['quantidade'];
		}
		$ufsString = implode(', ', $ufs);
		$quantidadesString = implode(', ', $quantidades);
		
		$this->view->ufsString = $ufsString;
		$this->view->quantidadesString = $quantidadesString;
		$this->render('dashboard', 'layout1');
		
		
	}
	
	/*
	public function somaUf()
	{
		$pessoa = Container::getModel('Pessoa');
		$dadosPessoa = $pessoa->somaUf();
		//$this->view->dados = $dadosPessoa;
		$this->render('cadastro', 'layout1');
		
	}
	*/

}
