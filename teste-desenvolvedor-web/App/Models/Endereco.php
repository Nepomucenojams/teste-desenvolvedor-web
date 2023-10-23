<?php

namespace App\Models;

use MF\Model\Model;

class Endereco extends Model
{	
	
    private $enderecoItem;
    private $idEndereco;
    private $nomeEndereco;
    private $cep;
    private $logradouro;
    private $localidade;
    private $bairro;
    private $uf;
    private $complemento;
    private $pessoa_id_pessoa;
    private $numero;
    

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

	public function insertEndereco()
	{   
    
        $enderecoItem =$this->__get('enderecoItem');
        $codigo_pessoa =$this->__get('codigo_pessoa');
		$nome_Endereco =$this->__get('nome_Endereco');
		$cep           =$this->__get('cep');
		$logradouro    =$this->__get('logradouro');
		$localidade    =$this->__get('localidade');
		$bairro        =$this->__get('bairro');
		$uf            =$this->__get('uf');
		$complemento   =$this->__get('complemento');
		$numero        =$this->__get('numero');


        $data = [
            'enderecoItem'      => $enderecoItem,
            'cep'               => $cep,
            'logadouro'         => $logradouro,
            'localidade'        => $localidade,
            'bairro'            => $bairro,
            'uf'                => $uf,
            'complemento'       => $complemento,
            'pessoa_id_pessoa'  => $codigo_pessoa,
            'nome_endereco'     => $nome_Endereco,
            'numero'            => $numero
        ];

    
        $sql = "INSERT INTO `endereco` (
            `cep`,
            `logadouro`,
            `localidade`,
            `bairro`,
            `uf`,
            `complemento`,
            `pessoa_id_pessoa`,
            `nome_endereco`,
            `numero`,
            endereco_item) 
        VALUES (
            :cep,
            :logadouro,
            :localidade,
            :bairro,
            :uf,
            :complemento,
            :pessoa_id_pessoa,
            :nome_endereco,
            :numero,
            :enderecoItem)";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($data);
        
        $stmt = $this->conexao->query("SELECT LAST_INSERT_ID()");
        $lastId = $stmt->fetchColumn();
        return $lastId;
	}

    public function updateEndereco()
	{   
        
        $codigo_pessoa =$this->__get('codigo_pessoa');
		$nome_Endereco =$this->__get('nome_Endereco');
		$cep           =$this->__get('cep');
		$logradouro    =$this->__get('logradouro');
		$localidade    =$this->__get('localidade');
		$bairro        =$this->__get('bairro');
		$uf            =$this->__get('uf');
		$complemento   =$this->__get('complemento');
		$numero        =$this->__get('numero');
		$idEndereco    =$this->__get('idEndereco');


        $data = [
            'cep'               => $cep,
            'logadouro'         => $logradouro,
            'localidade'        => $localidade,
            'bairro'            => $bairro,
            'uf'                => $uf,
            'complemento'       => $complemento,
            'pessoa_id_pessoa'  => $codigo_pessoa,
            'nome_endereco'     => $nome_Endereco,
            'numero'            => $numero,
            'id_endereco'       => $idEndereco
        ];

    
        $sql = "UPDATE
        `endereco`
        SET
            `cep` = :cep,
            `logadouro` = :logadouro,
            `localidade` = :localidade,
            `bairro` = :bairro,
            `uf` = :uf,
            `complemento` = :complemento,
            `pessoa_id_pessoa` = :pessoa_id_pessoa,
            `nome_endereco` = :nome_endereco,
            `numero` = :numero
        WHERE
        id_endereco = :id_endereco";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($data);
	}

    function somaUf(){
        $query = "SELECT uf, COUNT(*) AS quantidade FROM endereco GROUP BY uf";
        return $this->conexao->query($query)->fetchAll();
    }
}
