-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/06/2024 às 01:15
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
  `fk_id_usuario` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `ra` varchar(20) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(8) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `semestre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_alunos`
--

INSERT INTO `tb_alunos` (`id_aluno`, `fk_id_usuario`, `nome`, `rg`, `ra`, `telefone`, `logradouro`, `numero`, `bairro`, `cidade`, `estado`, `cep`, `curso`, `semestre`, `email`) VALUES
(1, 1, 'Leonardo Sartorelli', '12.345.678-9', '2781392323005', '(19) 99999-9999', 'Rua dos Periquitos ', '370', 'Recanto dos Passaros', 'ITAPIRA ', 'São Paulo', '13970-000', 'Desenvolvimento de Software Multiplataforma ', '1 Semestre', 'leonardo.sartorelli@fatec.sp.gov.br\r\n'),
(2, 3, 'Jorge', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_atividades`
--

CREATE TABLE `tb_atividades` (
  `id_atividades` int(11) NOT NULL,
  `fk_id_aluno` int(11) DEFAULT NULL,
  `plano_atividades` varchar(512) DEFAULT NULL,
  `caminho_atividades` varchar(512) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `motivo_reprovacao` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_compromisso`
--

CREATE TABLE `tb_compromisso` (
  `id_compromisso` int(11) NOT NULL,
  `fk_id_aluno` int(11) DEFAULT NULL,
  `termo_compromisso` varchar(512) DEFAULT NULL,
  `caminho_compromisso` varchar(512) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `motivo_reprovacao` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_empresas`
--

CREATE TABLE `tb_empresas` (
  `id_empresa` int(11) NOT NULL,
  `fk_id_representante` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `cnpj` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_empresas`
--

INSERT INTO `tb_empresas` (`id_empresa`, `fk_id_representante`, `nome`, `cnpj`, `endereco`) VALUES
(3, 16, 'Rogério Tech ', '12.278.123/0001-01', 'Avenida das Rolinhas, 123, Centro, Itapira-Sp ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_estagios`
--

CREATE TABLE `tb_estagios` (
  `id_estagio` int(11) NOT NULL,
  `horario_inicio` varchar(255) DEFAULT NULL,
  `horario_termino` varchar(255) DEFAULT NULL,
  `inicio_intervalo` varchar(255) DEFAULT NULL,
  `termino_intervalo` varchar(255) DEFAULT NULL,
  `total_horas` varchar(255) DEFAULT NULL,
  `data_inicio` varchar(255) DEFAULT NULL,
  `data_termino` varchar(255) DEFAULT NULL,
  `salario` varchar(255) DEFAULT NULL,
  `apolice` varchar(255) DEFAULT NULL,
  `seguradora` varchar(255) DEFAULT NULL,
  `file_path` varchar(512) NOT NULL,
  `fk_id_aluno` int(11) DEFAULT NULL,
  `fk_id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_estagios`
--

INSERT INTO `tb_estagios` (`id_estagio`, `horario_inicio`, `horario_termino`, `inicio_intervalo`, `termino_intervalo`, `total_horas`, `data_inicio`, `data_termino`, `salario`, `apolice`, `seguradora`, `file_path`, `fk_id_aluno`, `fk_id_empresa`) VALUES
(4, '08:00', '16:00', '11:00', '13:00', '44', '2024-05-01', '2024-12-01', '1500', '121231231321', 'Porto', '', 1, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_professores`
--

CREATE TABLE `tb_professores` (
  `id_professor` int(11) NOT NULL,
  `fk_id_usuario` int(11) DEFAULT NULL,
  `nome_professor` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_professores`
--

INSERT INTO `tb_professores` (`id_professor`, `fk_id_usuario`, `nome_professor`) VALUES
(1, 2, 'João Oliveira');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_relatorio_final`
--

CREATE TABLE `tb_relatorio_final` (
  `id_final` int(11) NOT NULL,
  `fk_id_aluno` int(11) DEFAULT NULL,
  `relatorio_final` varchar(512) DEFAULT NULL,
  `caminho_final` varchar(512) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `motivo_reprovacao` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_relatorio_parcial`
--

CREATE TABLE `tb_relatorio_parcial` (
  `id_parcial` int(11) NOT NULL,
  `fk_id_aluno` int(11) DEFAULT NULL,
  `relatorio_parcial` varchar(512) DEFAULT NULL,
  `caminho_parcial` varchar(512) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `motivo_reprovacao` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_representantes`
--

CREATE TABLE `tb_representantes` (
  `id_representante` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `cargo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_representantes`
--

INSERT INTO `tb_representantes` (`id_representante`, `nome`, `cpf`, `cargo`) VALUES
(16, 'João da Silva ', '123.123.123-12', 'Gerente ');

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
(1, 'leonardo', '1234', 'aluno'),
(2, 'joao', '1234', 'prof'),
(3, 'jorge', '1234', 'aluno');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_alunos`
--
ALTER TABLE `tb_alunos`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `fk_id_usuario` (`fk_id_usuario`);

--
-- Índices de tabela `tb_atividades`
--
ALTER TABLE `tb_atividades`
  ADD PRIMARY KEY (`id_atividades`),
  ADD KEY `fk_id_aluno` (`fk_id_aluno`);

--
-- Índices de tabela `tb_compromisso`
--
ALTER TABLE `tb_compromisso`
  ADD PRIMARY KEY (`id_compromisso`),
  ADD KEY `fk_id_aluno` (`fk_id_aluno`);

--
-- Índices de tabela `tb_empresas`
--
ALTER TABLE `tb_empresas`
  ADD PRIMARY KEY (`id_empresa`),
  ADD KEY `fk_id_representante` (`fk_id_representante`);

--
-- Índices de tabela `tb_estagios`
--
ALTER TABLE `tb_estagios`
  ADD PRIMARY KEY (`id_estagio`),
  ADD KEY `fk_id_aluno` (`fk_id_aluno`),
  ADD KEY `fk_id_empresa` (`fk_id_empresa`);

--
-- Índices de tabela `tb_professores`
--
ALTER TABLE `tb_professores`
  ADD PRIMARY KEY (`id_professor`),
  ADD KEY `fk_id_usuario` (`fk_id_usuario`);

--
-- Índices de tabela `tb_relatorio_final`
--
ALTER TABLE `tb_relatorio_final`
  ADD PRIMARY KEY (`id_final`),
  ADD KEY `fk_id_aluno` (`fk_id_aluno`);

--
-- Índices de tabela `tb_relatorio_parcial`
--
ALTER TABLE `tb_relatorio_parcial`
  ADD PRIMARY KEY (`id_parcial`),
  ADD KEY `fk_id_aluno` (`fk_id_aluno`);

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
-- AUTO_INCREMENT de tabela `tb_atividades`
--
ALTER TABLE `tb_atividades`
  MODIFY `id_atividades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_compromisso`
--
ALTER TABLE `tb_compromisso`
  MODIFY `id_compromisso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_empresas`
--
ALTER TABLE `tb_empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_estagios`
--
ALTER TABLE `tb_estagios`
  MODIFY `id_estagio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_professores`
--
ALTER TABLE `tb_professores`
  MODIFY `id_professor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_relatorio_final`
--
ALTER TABLE `tb_relatorio_final`
  MODIFY `id_final` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_relatorio_parcial`
--
ALTER TABLE `tb_relatorio_parcial`
  MODIFY `id_parcial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_representantes`
--
ALTER TABLE `tb_representantes`
  MODIFY `id_representante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_alunos`
--
ALTER TABLE `tb_alunos`
  ADD CONSTRAINT `tb_alunos_ibfk_1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`);

--
-- Restrições para tabelas `tb_atividades`
--
ALTER TABLE `tb_atividades`
  ADD CONSTRAINT `tb_atividades_ibfk_1` FOREIGN KEY (`fk_id_aluno`) REFERENCES `tb_alunos` (`id_aluno`);

--
-- Restrições para tabelas `tb_compromisso`
--
ALTER TABLE `tb_compromisso`
  ADD CONSTRAINT `tb_compromisso_ibfk_1` FOREIGN KEY (`fk_id_aluno`) REFERENCES `tb_alunos` (`id_aluno`);

--
-- Restrições para tabelas `tb_empresas`
--
ALTER TABLE `tb_empresas`
  ADD CONSTRAINT `tb_empresas_ibfk_1` FOREIGN KEY (`fk_id_representante`) REFERENCES `tb_representantes` (`id_representante`);

--
-- Restrições para tabelas `tb_estagios`
--
ALTER TABLE `tb_estagios`
  ADD CONSTRAINT `tb_estagios_ibfk_1` FOREIGN KEY (`fk_id_aluno`) REFERENCES `tb_alunos` (`id_aluno`),
  ADD CONSTRAINT `tb_estagios_ibfk_2` FOREIGN KEY (`fk_id_empresa`) REFERENCES `tb_empresas` (`id_empresa`);

--
-- Restrições para tabelas `tb_professores`
--
ALTER TABLE `tb_professores`
  ADD CONSTRAINT `tb_professores_ibfk_1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`);

--
-- Restrições para tabelas `tb_relatorio_final`
--
ALTER TABLE `tb_relatorio_final`
  ADD CONSTRAINT `tb_relatorio_final_ibfk_1` FOREIGN KEY (`fk_id_aluno`) REFERENCES `tb_alunos` (`id_aluno`);

--
-- Restrições para tabelas `tb_relatorio_parcial`
--
ALTER TABLE `tb_relatorio_parcial`
  ADD CONSTRAINT `tb_relatorio_parcial_ibfk_1` FOREIGN KEY (`fk_id_aluno`) REFERENCES `tb_alunos` (`id_aluno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
