-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/05/2024 às 21:05
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `intern_hub`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_alunos`
--

CREATE TABLE `tb_alunos` (
  `id_aluno` int(11) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `ra` varchar(20) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(8) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `cep` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_alunos`
--

INSERT INTO `tb_alunos` (`id_aluno`, `fk_id_usuario`, `nome`, `rg`, `ra`, `logradouro`, `numero`, `bairro`, `cidade`, `cep`) VALUES
(1, 0, 'Leonardo Sartorelli', '45.678.912-3', '2781392323005', 'Rua das Flores', '123', 'Jardim Primavera', 'Belo Horizonte', '30123-456');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_empresas`
--

CREATE TABLE `tb_empresas` (
  `id_empresa` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `id_representante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_empresas`
--

INSERT INTO `tb_empresas` (`id_empresa`, `nome`, `cnpj`, `endereco`, `id_representante`) VALUES
(4, 'VKGTech ', '12.345.678/0001-90', 'Rua Fictícia, 123, Bairro Novo, Cidade Fictícia', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_estagios`
--

CREATE TABLE `tb_estagios` (
  `id_estagio` int(11) NOT NULL,
  `horario_inicio` varchar(255) NOT NULL,
  `horario_termino` varchar(255) NOT NULL,
  `inicio_intervalo` varchar(255) NOT NULL,
  `termino_intervalo` varchar(255) NOT NULL,
  `total_horas` varchar(255) NOT NULL,
  `data_inicio` varchar(255) NOT NULL,
  `data_termino` varchar(255) NOT NULL,
  `salario` varchar(255) NOT NULL,
  `vt` varchar(255) NOT NULL,
  `apolice` varchar(255) NOT NULL,
  `seguradora` varchar(255) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_representante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_estagios`
--

INSERT INTO `tb_estagios` (`id_estagio`, `horario_inicio`, `horario_termino`, `inicio_intervalo`, `termino_intervalo`, `total_horas`, `data_inicio`, `data_termino`, `salario`, `vt`, `apolice`, `seguradora`, `id_aluno`, `id_empresa`, `id_representante`) VALUES
(1, '08:30', '18:00', '11:00', '12:30', '44', '2024-05-01', '2025-02-01', '1500', '200', '14567', 'Porto', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_representantes`
--

CREATE TABLE `tb_representantes` (
  `id_representante` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_representantes`
--

INSERT INTO `tb_representantes` (`id_representante`, `nome`, `cpf`, `cargo`, `id_empresa`) VALUES
(2, ' João da Silva', 'Gerente de Oper', '123.456.789-00', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `permissao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `usuario`, `senha`, `permissao`) VALUES
(1, 'admin', '1234', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_alunos`
--
ALTER TABLE `tb_alunos`
  ADD PRIMARY KEY (`id_aluno`);

--
-- Índices de tabela `tb_empresas`
--
ALTER TABLE `tb_empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices de tabela `tb_estagios`
--
ALTER TABLE `tb_estagios`
  ADD PRIMARY KEY (`id_estagio`);

--
-- Índices de tabela `tb_representantes`
--
ALTER TABLE `tb_representantes`
  ADD PRIMARY KEY (`id_representante`);

--
-- Índices de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_alunos`
--
ALTER TABLE `tb_alunos`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_empresas`
--
ALTER TABLE `tb_empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_estagios`
--
ALTER TABLE `tb_estagios`
  MODIFY `id_estagio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_representantes`
--
ALTER TABLE `tb_representantes`
  MODIFY `id_representante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
