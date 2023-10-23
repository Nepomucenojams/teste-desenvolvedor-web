-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/10/2023 às 14:23
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco_projeto`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `endereco_item` int(11) NOT NULL,
  `id_endereco` int(11) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `logadouro` varchar(120) NOT NULL,
  `localidade` varchar(120) NOT NULL,
  `bairro` varchar(80) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `complemento` varchar(80) DEFAULT NULL,
  `pessoa_id_pessoa` int(11) NOT NULL,
  `nome_endereco` varchar(60) NOT NULL,
  `numero` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`endereco_item`, `id_endereco`, `cep`, `logadouro`, `localidade`, `bairro`, `uf`, `complemento`, `pessoa_id_pessoa`, `nome_endereco`, `numero`) VALUES
(1, 17, '54321-987', 'Rua das Palmeiras', 'Cidade A', 'Bairro X', 'SP', 'Apto 301', 17, 'Endereço 17', '987'),
(1, 18, '12345-678', 'Avenida Central', 'Cidade B', 'Bairro Y', 'RJ', 'Sala 202', 18, 'Endereço 18', '654'),
(1, 19, '55555-555', 'Rua dos Pinheiros', 'Cidade C', 'Bairro Z', 'BA', 'Casa 2', 19, 'Endereço 19', '789'),
(1, 20, '77777-777', 'Avenida dos Lírios', 'Cidade A', 'Bairro X', 'SP', 'Casa 1', 20, 'Endereço 20', '101'),
(1, 21, '54321-987', 'Rua das Palmeiras', 'Cidade A', 'Bairro X', 'SP', 'Apto 301', 21, 'Endereço 21', '987'),
(1, 22, '12345-678', 'Avenida Central', 'Cidade B', 'Bairro Y', 'RJ', 'Sala 202', 22, 'Endereço 22', '654'),
(1, 23, '55555-555', 'Rua dos Pinheiros', 'Cidade C', 'Bairro Z', 'BA', 'Casa 2', 23, 'Endereço 23', '789'),
(1, 24, '77777-777', 'Avenida dos Lírios', 'Cidade A', 'Bairro X', 'SP', 'Casa 1', 24, 'Endereço 24', '101'),
(1, 25, '54321-987', 'Rua das Palmeiras', 'Cidade A', 'Bairro X', 'SP', 'Apto 301', 25, 'Endereço 25', '987'),
(1, 26, '12345-678', 'Avenida Central', 'Cidade B', 'Bairro Y', 'RJ', 'Sala 202', 26, 'Endereço 26', '654'),
(1, 27, '55555-555', 'Rua dos Pinheiros', 'Cidade C', 'Bairro Z', 'BA', 'Casa 2', 27, 'Endereço 27', '789'),
(1, 28, '77777-777', 'Avenida dos Lírios', 'Cidade A', 'Bairro X', 'SP', 'Casa 1', 28, 'Endereço 28', '101'),
(1, 79, '72146-032', 'QNM 40 Conjunto B2', 'Brasília', 'Taguatinga Norte (Taguatinga)', 'DF', 'Rua sem saida', 74, 'Casa do pai', '20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id_pessoa` int(11) NOT NULL,
  `nome_completo` varchar(120) NOT NULL,
  `telefone` varchar(17) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `nome_completo`, `telefone`, `cpf`, `data_nascimento`) VALUES
(17, 'Joana Pereira', '555-444-3333', '55544433303', '1990-07-12'),
(18, 'Rodrigo Alves', '888-999-7777', '88899977703', '1985-11-29'),
(19, 'Clara Ferreira', '111-222-3333', '11122233303', '1977-04-05'),
(20, 'Marcelo Santos', '444-555-6666', '44455566603', '1994-09-18'),
(21, 'Eduardo Ribeiro', '555-444-3333', '55544433304', '1982-06-21'),
(22, 'Larissa Souza', '888-999-7777', '88899977704', '1999-03-15'),
(23, 'Rafaela Almeida', '111-222-3333', '11122233304', '1986-02-10'),
(24, 'Carlos Oliveira', '444-555-6666', '44455566604', '1988-05-25'),
(25, 'Thiago Martins', '555-444-3333', '55544433305', '1995-10-12'),
(26, 'Aline Costa', '888-999-7777', '88899977705', '1983-09-14'),
(27, 'Vanessa Silva', '111-222-3333', '11122233305', '1997-01-30'),
(28, 'Renata Lima', '444-555-6666', '44455566605', '1991-07-18'),
(74, 'James Nepomuceno', '(61) 9 8468-2558', '000.000.000-00', '1996-11-24');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id_endereco`),
  ADD KEY `fk_endereco_pessoa_idx` (`pessoa_id_pessoa`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_endereco_pessoa` FOREIGN KEY (`pessoa_id_pessoa`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
