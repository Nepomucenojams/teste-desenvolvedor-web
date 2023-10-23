<?php

namespace App\Models;

use MF\Model\Model;

class Pessoa extends Endereco
{	
	
    private $id;
    private $nome;
    private $telefone;
    private $cpf;
    private $dataNascimento;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

	public function getPessoa()
	{
		$query = "SELECT
        p.*,
        e.*
        FROM
            pessoa AS p
        LEFT JOIN(
            SELECT pessoa_id_pessoa,
                MIN(id_endereco) AS id_endereco
            FROM
                endereco
            GROUP BY
                pessoa_id_pessoa
        ) AS sub_e
        ON
            p.id_pessoa = sub_e.pessoa_id_pessoa
        LEFT JOIN endereco AS e
        ON
            sub_e.id_endereco = e.id_endereco";
		return $this->conexao->query($query)->fetchAll();
		
		/*
		$query = "SELECT * FROM pessoa";
		return $this->conexao->query($query)->fetchAll();
		*/
	}

    public function insertPessoa()
	{
        $nome = $this->__get('nome');
        $telefone = $this->__get('telefone');
        $cpf = $this->__get('cpf');
        $dataNascimento = $this->__get('dataNascimento');

        $data = [
            'nome' => $nome,
            'telefone' => $telefone,
            'cpf' => $cpf,
            'dataNascimento' => $dataNascimento
        ];

        $sql = "INSERT INTO `pessoa`( `nome_completo`, `telefone`, `cpf`, `data_nascimento`) VALUES (:nome, :telefone, :cpf,:dataNascimento)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($data);
        
        $stmt = $this->conexao->query("SELECT LAST_INSERT_ID()");
        $lastId = $stmt->fetchColumn();
        
        
        return $lastId;
	}

    public function updatePessoa()
	{   
        $codigo = $this->__get('codigo');
        $nome = $this->__get('nome');
        $telefone = $this->__get('telefone');
        $cpf = $this->__get('cpf');
        $dataNascimento = $this->__get('dataNascimento');

        $data = [
            'nome' => $nome,
            'telefone' => $telefone,
            'cpf' => $cpf,
            'dataNascimento' => $dataNascimento,
            'codigo' => $codigo
        ];

        $sql = "UPDATE `pessoa` SET `nome_completo`= :nome , `telefone`= :telefone , `cpf`= :cpf ,`data_nascimento`= :dataNascimento where id_pessoa  = :codigo ";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($data);
	}

    public function recuperarPessoa()
	{   

        $codigo = $this->__get('codigo');
        $data = [
            'id_pessoa' => $codigo,
        ];

        $sql = "SELECT * FROM pessoa where `id_pessoa` = :id_pessoa;";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($data);
    
       return  $usuario = $stmt->fetchAll();
	}

    public function recuperarEndereco()
	{   

        $codigo = $this->__get('codigo');
        $data = [
            'id_pessoa' => $codigo,
        ];

        $resultado = [];

        $sql = "SELECT * FROM `endereco` WHERE `pessoa_id_pessoa` = :id_pessoa and endereco_item = 1";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($data);
        $result1 = $stmt->fetchAll();
        $resultado[1] =  $result1;

        $sql = "SELECT * FROM `endereco` WHERE `pessoa_id_pessoa` = :id_pessoa  and endereco_item = 2";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($data);
        $result2 = $stmt->fetchAll();
        $resultado[2] =  $result2;

        $result3 = $sql = "SELECT * FROM `endereco` WHERE `pessoa_id_pessoa` = :id_pessoa  and endereco_item = 3";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($data);
        $result3 = $stmt->fetchAll();
        $resultado[3] =  $result3;
    
       return $resultado;
	}

    public function excluirPessoa()
	{   
        $codigo = $this->__get('codigo');
        $data = [
            'id_pessoa' => $codigo,
        ];

        $sql = "DELETE FROM `endereco` WHERE `pessoa_id_pessoa` = :id_pessoa;";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($data);

        $sql = "DELETE  FROM `pessoa` WHERE `id_pessoa` = :id_pessoa;";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($data);
       
	}

    public function excluirInPessoa()
	{   
        $codigo = $this->__get('codigo');
        
        $sql = "DELETE FROM `endereco` WHERE `pessoa_id_pessoa` in ($codigo)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
      
        $sql = "DELETE  FROM `pessoa` WHERE `id_pessoa` in ($codigo);";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
       
	}

    public function listarPessoaPdf()
	{   
        $pessoaspdf =  $this->getPessoa();

        $html = "
		<style>
		.demo {
			border:1px sólido #C0C0C0;
			border-collapse:colapso;
			padding:5px;
		}
		.demo th {
			border:1px sólido #C0C0C0;
			padding:5px;
			background:#F0F0F0;
		}
		.demo td {
			border:1px sólido #C0C0C0;
			padding:5px;
		}
		</style>
		<table class='demo'>
			<caption>
			<h1>Lista Pessoas</h1>
			</caption>
			<thead>
			<tr>
				<th>Nome Completo</th>
				<th>Telefone</th>
				<th>CPF</th>
				<th>Data Nascimento</th>
				<th>CEP</th>
				<th>Logadouro</th>
				<th>Localidade</th>
				<th>Bairro</th>
				<th>UF</th>
				<th>Complemento</th>
			</tr>
			</thead>
			<tbody>";
		foreach ($pessoaspdf as $pessoa => $value) {
			$nome_completo = $value['nome_completo'];
			$telefone = $value['telefone'] ;
			$cpf = $value['cpf'] ;
			$data_nascimento = $value['data_nascimento'] ;
			$cep = $value['cep'];
			$logadouro = $value['logadouro'];
			$localidade = $value['localidade'] ;
			$bairro = $value['bairro'] ;
			$uf = $value['uf'] ;
			$complemento = $value['complemento'];
		$html .="	
			<tr>
				<td>$nome_completo</td>
				<td>$telefone</td>
				<td>$cpf</td>
				<td>$data_nascimento</td>
				<td>$cep</td>
				<td>$logadouro</td>
				<td>$localidade</td>
				<td>$bairro</td>
				<td>$uf</td>
				<td>$complemento</td>
			</tr>";
		}
		$html .="
			</tbody>
		</table>
		";
		
		$mpdf = new \Mpdf\Mpdf();

		$mpdf->WriteHTML($html);
		$mpdf->Output();
		

	}
    

    
}
