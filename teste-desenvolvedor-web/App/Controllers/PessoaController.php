<?php

namespace App\Controllers;

//os recursos do projeto
use MF\Controller\Action;
use MF\Model\Container;


//os models
use App\Models\Pessoa;


class PessoaController extends Action
{

	public function listarPessoa()
	{

		
		$pessoa = Container::getModel('Pessoa');
		$dadosPessoa = $pessoa->getPessoa();
		$this->view->dados = $dadosPessoa;
		$this->render('listar', 'layout1');
		
	}

	public function cadastroPessoa()
	{
		$pessoa = Container::getModel('Pessoa');
		$dadosPessoa = $pessoa->getPessoa();
		//$this->view->dados = $dadosPessoa;
		$this->render('cadastro', 'layout1');
	}

	public function cadastrarPessoa(){
		$codigo 		= $_POST['codigo'];
		$nome 			= $_POST['nome'];
		$telefone 		= $_POST['telefone'];
		$cpf 			= $_POST['cpf'];
		$dataNascimento = $_POST['dataNascimento'];

		echo $codigo;

		$pessoa = Container::getModel('Pessoa');
		$pessoa->__set('codigo', $codigo);
		$pessoa->__set('nome', $nome);
		$pessoa->__set('telefone', $telefone);
		$pessoa->__set('cpf', $cpf);
		$pessoa->__set('dataNascimento', $dataNascimento);

		if (empty($codigo)) {
			$utimo_id = $pessoa->insertPessoa();
			echo $utimo_id;
			return;
		}
		$pessoa-> updatePessoa();
		return;
	}

	public function cadastrarEndereco(){
		$endereco_item = $_POST['endereco_item'];
		$id_endereco   = $_POST['id_endereco'];
		$codigo_pessoa = $_POST['codigo_pessoa'];
        $nome_Endereco = $_POST['nome_Endereco'];
        $cep           = $_POST['cep'];
        $logradouro    = $_POST['logadouro'];
        $localidade    = $_POST['localidade'];
        $bairro        = $_POST['bairro'];
        $uf            = $_POST['uf'];
        $complemento   = $_POST['complemento'];
        $numero   	   = $_POST['numero'];

		echo $id_endereco;
		//echo "$codigo_pessoa $nome_Endereco  $cep $logradouro  $bairro $uf  $complemento";
		$pessoa = Container::getModel('Pessoa');


		$pessoa->__set('enderecoItem', $endereco_item);
		$pessoa->__set('codigo_pessoa', $codigo_pessoa);
		$pessoa->__set('nome_Endereco', $nome_Endereco);
		$pessoa->__set('cep', $cep);
		$pessoa->__set('logradouro', $logradouro);
		$pessoa->__set('localidade', $localidade);
		$pessoa->__set('bairro', $bairro);
		$pessoa->__set('uf', $uf);
		$pessoa->__set('complemento', $complemento);
		$pessoa->__set('numero', $numero);
		$pessoa->__set('idEndereco', $id_endereco);

		if (empty($id_endereco)) {
			$id_endereco = $pessoa->insertEndereco();
			echo $id_endereco;
			return;
		}
		$pessoa-> updateEndereco();
		return;
	}

	function editarPessoa() {
		$codigo  = $_GET['codigo'];

		$pessoa = Container::getModel('Pessoa');
		$pessoa->__set('codigo', $codigo);
		$editar_pessoa = $pessoa->recuperarPessoa();
		$editar_endereco = $pessoa->recuperarEndereco();

		$this->view->dados = $editar_pessoa;
		$this->view->dadosEndereco = $editar_endereco;

		$a=1;
		while ($a <= 3) {
			if (!isset($this->view->dadosEndereco[$a][0])) {
				$this->view->dadosEndereco[$a][0] = array(
					'endereco_item' => '',
					0 => '',
					'id_endereco' => '',
					1 => '',
					'cep' => '',
					2 => '',
					'logadouro' => '',
					3 => '',
					'localidade' => '',
					4 => '',
					'bairro' => '',
					5 => '',
					'uf' => '',
					6 => '',
					'complemento' => '',
					7 => '',
					'pessoa_id_pessoa' => '',
					8 => '',
					'nome_endereco' => '',
					9 => '',
					'numero' => '',
					10 => ''
				);
			}
			$a++;
		}
		$this->render('editar', 'layout1');	
	}


	function excluirPessoa() {
		$codigo  = $_GET['codigo'];

		$pessoa = Container::getModel('Pessoa');
		$pessoa->__set('codigo', $codigo);
		$pessoa->excluirPessoa();
		
		$this->listarPessoa();
	}

	function excluirInPessoa() {
		$codigo  = $_GET['codigo'];

		
		
		$pessoa = Container::getModel('Pessoa');
		$pessoa->__set('codigo', $codigo);
		$pessoa->excluirInPessoa();
		
		$this->listarPessoa();
	}

	function listarPessoaPdf(){


		$pessoa = Container::getModel('Pessoa');		
		$pessoa->listarPessoaPdf();
		
		
	}
	
}
