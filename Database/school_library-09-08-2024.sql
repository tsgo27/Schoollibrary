-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/08/2024 às 22:45
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
-- Banco de dados: `school_library`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acervo`
--

CREATE TABLE `acervo` (
  `codAcervo` int(4) NOT NULL,
  `Acervo` varchar(10) DEFAULT NULL,
  `StatusAcervo` varchar(7) NOT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `acervo`
--

INSERT INTO `acervo` (`codAcervo`, `Acervo`, `StatusAcervo`, `data_registro`) VALUES
(3, 'CA-LE-N1', 'Ativo', '2023-09-26 09:48:59'),
(4, 'CA-LE-N2', 'Ativo', '2023-09-29 17:30:50'),
(5, 'KC-LD-N1', 'Ativo', '2023-10-09 09:34:42'),
(6, 'CA-LD-N1', 'Ativo', '2023-10-09 09:35:16'),
(7, 'CA-LD-N9', 'Ativo', '2023-12-13 15:46:03'),
(9, 'CB-LD-N8', 'Ativo', '2024-08-02 17:14:37'),
(10, 'CA-LD-95', 'Ativo', '2024-08-02 17:14:47'),
(24, 'CB-LD-YY', 'Ativo', '2024-08-05 16:33:41'),
(25, 'GB-4-L-1-9', 'Ativo', '2024-08-09 16:59:17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id_Aluno` int(4) NOT NULL,
  `matricula` int(9) NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `user_status` varchar(7) DEFAULT NULL,
  `observacao` varchar(60) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id_Aluno`, `matricula`, `nome`, `telefone`, `email`, `user_status`, `observacao`, `data_registro`) VALUES
(24, 202320120, 'Igor Silva', '6200000-0000', 'igor.silva@teste.com', 'Inativo', 'Obra em atraso', '2023-12-07 14:37:51'),
(26, 202320121, 'Maria', '6200000-0000', 'maria.silva@teste.com', 'Inativo', 'Obra em atraso', '2023-12-07 16:01:58'),
(27, 202319202, 'Daniel Soares', '6200000-0000', 'daniel.soares@teste.com', 'Ativo', NULL, '2023-12-13 15:28:11'),
(28, 202319203, 'Dani Martins', '6200000-0000', 'dani.martins@teste.com', 'Ativo', NULL, '2023-12-13 16:58:23'),
(29, 202319204, 'Carol Maia', '6200000-0000', 'carol.maia@teste.com', 'Ativo', NULL, '2023-12-13 16:59:29'),
(30, 202320205, 'Eminem Soares', '6200000-0000', 'eminem.soares@teste.com', 'Ativo', NULL, '2023-12-13 17:00:42'),
(31, 202320206, 'Rafal oliveira', '62992594657', 'rafael.oliveira@teste.com', 'Ativo', NULL, '2023-12-13 17:01:24'),
(32, 202320207, 'Ivani Filho', '6200000-0000', 'ivani.filho@teste.com', 'Ativo', NULL, '2023-12-13 17:02:14'),
(33, 202320208, 'joão Gustavo', '6200000-0000', 'joao.gustavo@teste.com', 'Ativo', NULL, '2023-12-13 17:02:50'),
(34, 202320209, 'Debora Soares', '6200000-0000', 'debora.soares@teste.com', 'Ativo', '', '2023-12-13 17:03:26'),
(35, 548789889, 'Mia Silva', '62992594657', 'dani@email.com', 'Ativo', NULL, '2024-08-09 11:22:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `autor`
--

CREATE TABLE `autor` (
  `codAutor` int(4) NOT NULL,
  `NomeAutor` varchar(100) NOT NULL,
  `StatusAutor` varchar(7) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `autor`
--

INSERT INTO `autor` (`codAutor`, `NomeAutor`, `StatusAutor`, `data_registro`) VALUES
(1, 'Igor Silva', 'Ativo', '2023-09-26 22:13:24'),
(2, 'Amanda Silva', 'Ativo', '2023-09-26 22:13:28'),
(3, 'Flavio Santos', 'Ativo', '2023-09-27 17:51:27'),
(4, 'Fernando Bras', 'Ativo', '2023-09-29 11:26:51'),
(5, 'Martine', 'Ativo', '2023-10-04 13:22:10'),
(6, 'Vanessa Santos', 'Ativo', '2023-10-06 12:25:36'),
(7, 'Laura A. Escritora', 'Ativo', '2023-12-13 10:15:18'),
(8, 'Carlos Cientista', 'Ativo', '2023-12-13 10:15:26'),
(9, ' Sofia Jardineira', 'Ativo', '2023-12-13 10:15:33'),
(36, 'Maria Rita', 'Ativo', '2024-08-05 16:57:29'),
(37, 'Maria Linda', 'Ativo', '2024-08-05 17:08:46');

-- --------------------------------------------------------

--
-- Estrutura para tabela `editora`
--

CREATE TABLE `editora` (
  `codEditora` int(4) NOT NULL,
  `NomeEditora` varchar(60) NOT NULL,
  `Cidade` varchar(60) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `StatusEditora` varchar(7) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `editora`
--

INSERT INTO `editora` (`codEditora`, `NomeEditora`, `Cidade`, `Estado`, `StatusEditora`, `data_registro`) VALUES
(25, 'Imaginários Ltda.', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 10:18:25'),
(26, 'Conhecimento Press', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 10:18:43'),
(27, 'Contos Coloridos', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 10:18:56'),
(28, 'Editora Enigma', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 10:19:06'),
(29, 'Arte das Palavras', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 10:19:19'),
(30, 'Saraiva', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 10:23:57'),
(31, 'AstroEdições', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 15:20:13'),
(32, 'Exploração Livros', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 15:48:14'),
(33, 'Fan', 'Osasco', 'São Paulo-SP', 'Ativo', '2024-08-07 11:55:33');

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `codEmprestimo` int(4) NOT NULL,
  `MatriculaAluno` int(9) NOT NULL,
  `NomeAluno` varchar(50) NOT NULL,
  `TituloLivro` varchar(100) NOT NULL,
  `SubTituloLivro` varchar(100) DEFAULT NULL,
  `DataEmprestimo` date NOT NULL,
  `DataDevolucao` date NOT NULL,
  `StatusEmprestimo` varchar(15) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `emprestimo`
--

INSERT INTO `emprestimo` (`codEmprestimo`, `MatriculaAluno`, `NomeAluno`, `TituloLivro`, `SubTituloLivro`, `DataEmprestimo`, `DataDevolucao`, `StatusEmprestimo`, `data_registro`) VALUES
(13, 202320121, 'Maria', 'Poesias Efêmeras', 'Ana Poetisa', '2023-10-12', '2023-12-20', 'Disponível', '2023-12-13 11:01:50'),
(14, 202320120, 'Igor Silva', 'Noite de Mistérios ', 'Sombras Do Passado', '2023-11-15', '2023-12-20', 'Emprestado', '2023-12-13 11:04:46'),
(20, 202320209, 'Debora Soares', 'O Último Refúgio ', 'Entre Montanhas', '2023-12-13', '2023-12-20', 'Disponível', '2023-12-13 17:04:23'),
(21, 202320208, 'joão Gustavo', ' O Jardim Secreto', 'Flores da Esperança', '2023-12-22', '2023-12-20', 'Disponível', '2023-12-13 17:06:04');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estado`
--

CREATE TABLE `estado` (
  `codEstado` int(4) NOT NULL,
  `nome_estado` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estado`
--

INSERT INTO `estado` (`codEstado`, `nome_estado`) VALUES
(1, 'Acre-AC'),
(2, 'Alagoas-AL'),
(3, 'Amapá-AP'),
(4, 'Amazonas-AM'),
(5, 'Bahia-BA'),
(6, 'Ceará-CE'),
(7, 'Distrito Federal-DF'),
(8, 'Espírito Santo-ES'),
(9, 'Goiás-GO'),
(10, 'Maranhão-MA'),
(12, 'Mato Grosso do Sul-MS'),
(11, 'Mato Grosso-MT'),
(13, 'Minas Gerais-MG'),
(14, 'Pará-PA'),
(15, 'Paraíba-PB'),
(16, 'Paraná-PR'),
(17, 'Pernambuco-PE'),
(18, 'Piauí-PI'),
(19, 'Rio de Janeiro-RJ'),
(20, 'Rio Grande do Norte-RN'),
(21, 'Rio Grande do Sul-RS'),
(22, 'Rondônia-RO'),
(23, 'Roraima-RR'),
(24, 'Santa Catarina-SC'),
(25, 'São Paulo-SP'),
(26, 'Sergipe-SE'),
(27, 'Tocantins-TO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `genero`
--

CREATE TABLE `genero` (
  `CodGenero` int(11) NOT NULL,
  `NomeGenero` varchar(100) NOT NULL,
  `StatusGenero` varchar(7) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `genero`
--

INSERT INTO `genero` (`CodGenero`, `NomeGenero`, `StatusGenero`, `data_registro`) VALUES
(1, 'Ficção Científica', 'Ativo', '2023-09-26 21:03:00'),
(2, 'Historia', 'Ativo', '2023-09-29 17:52:54'),
(3, 'Romance', 'Ativo', '2023-10-04 13:09:04'),
(4, 'Fantasia', 'Ativo', '2023-10-04 13:09:14'),
(5, 'Mistério', 'Ativo', '2023-10-04 13:09:21'),
(6, 'Suspense', 'Ativo', '2023-10-04 13:09:28'),
(8, 'Policial', 'Ativo', '2023-10-04 13:09:42'),
(9, 'Aventura', 'Ativo', '2023-10-04 13:09:49'),
(10, 'Horror', 'Ativo', '2023-10-04 13:09:56'),
(11, 'Drama', 'Ativo', '2023-10-04 13:10:03'),
(29, 'Literatura Infantojuvenil', 'Ativo', '2024-08-09 11:35:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `obra`
--

CREATE TABLE `obra` (
  `codObra` int(4) NOT NULL,
  `Isbn` varchar(20) DEFAULT NULL,
  `Titulo` varchar(100) NOT NULL,
  `SubTitulo` varchar(100) DEFAULT NULL,
  `Autor` varchar(100) DEFAULT NULL,
  `Edicao` int(11) DEFAULT NULL,
  `Ano` int(4) DEFAULT NULL,
  `Copia` int(4) NOT NULL,
  `Acervo` varchar(20) DEFAULT NULL,
  `Genero` varchar(100) DEFAULT NULL,
  `Editora` varchar(60) DEFAULT NULL,
  `Situacao` varchar(15) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `obra`
--

INSERT INTO `obra` (`codObra`, `Isbn`, `Titulo`, `SubTitulo`, `Autor`, `Edicao`, `Ano`, `Copia`, `Acervo`, `Genero`, `Editora`, `Situacao`, `data_registro`) VALUES
(13, '978-0-123456-7', 'Aventuras Fantásticas', 'Descobrindo Mundos ', 'Laura A. Escritora', 1, 2022, 2, 'GV-TR-1', 'Fantasia', 'Saraiva', 'Disponível', '2023-12-13 10:17:43'),
(14, '978-0-234567-8', 'Enigmas da Ciência', 'Desvendando o Inexplorado', 'Carlos Cientista', 3, 2020, 3, 'CA-LE-N2', 'Ciência', 'Imaginários Ltda.', 'Reservado', '2023-12-13 10:26:06'),
(15, '978-0-345678-9', ' O Jardim Secreto', 'Flores da Esperança', ' Sofia Jardineira', 2, 2019, 1, 'CA-LE-N2', 'Infantojuvenil', 'Imaginários Ltda.', 'Disponível', '2023-12-13 10:27:51'),
(16, '978-0-456789-0', 'Noite de Mistérios ', 'Sombras do Passado', 'Rodrigo Detetive', 1, 2021, 4, 'GB-4-L-1-2', 'Mistério', 'Imaginários Ltda.', 'Disponível', '2023-12-13 10:37:41'),
(17, ' 978-0-567890-1', 'Poesias Efêmeras', 'Versos do Coração ', 'Ana Poetisa  ', 4, 2018, 2, 'GB-4-L-1-2', 'Poesia', 'Imaginários Ltda.', 'Disponível', '2023-12-13 10:38:49'),
(18, '978-0-678901-2', 'O Último Refúgio ', 'Entre Montanhas', 'Victor Viajante', 5, 1995, 1, 'CA-LE-N2', 'Ficção Científica', 'Exploração Livros', 'Disponível', '2023-12-13 15:52:10'),
(19, '978-0-123456-0', 'Além das Estrelas ', 'Explorando o Cosmos', 'Lucas Astrônomo', 4, 2021, 1, 'GB-4-L-1-3', 'Aventura', 'Conhecimento Press', 'Disponível', '2023-12-13 16:03:35'),
(20, '978-0-234567-1', 'O Código da História', 'Desvendando o Passado', 'Clara Historiadora', 1, 1993, 5, 'CA-LE-N1', 'Poesia', 'Contos Coloridos', 'Disponível', '2023-12-13 16:11:20'),
(21, '978-0-345678-2', 'Entre Dois Mundos', 'A Fronteira Invisível', 'Roberto Viajante', 1, 1993, 5, 'GB-4-L-1-3', 'Mistério', 'Editora Enigma', 'Disponível', '2023-12-13 16:14:05'),
(22, '978-0-456789-7', 'Poemas da Meia-Noite', 'Versos Sob a Lua', 'Lídia Poetisa', 1, 1998, 1, 'GB-4-L-1-1', 'Literatura Infantojuvenil', 'Saraiva', 'Disponível', '2023-12-13 16:15:49'),
(23, '489-457-58-65', 'Livros de teste', 'Principe', 'Tiago,', 5, 1993, 4, 'CA-LE-N2', 'Historia', 'AstroEdições', 'Disponível', '2024-08-09 16:26:41'),
(24, '489-457-58-65', 'Livros de teste1', 'testando1', 'Igor Silva', 7, 1998, 1, 'CB-LD-WR', 'Historia', 'AstroEdições', 'Disponível', '2024-08-09 16:34:20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas`
--

CREATE TABLE `reservas` (
  `CodReserva` int(4) NOT NULL,
  `Matricula` int(9) NOT NULL,
  `NomeAluno` varchar(50) NOT NULL,
  `Titulo` varchar(100) NOT NULL,
  `SubTitulo` varchar(100) DEFAULT NULL,
  `DataReserva` date NOT NULL,
  `DataExpiracao` date NOT NULL,
  `Situacao` varchar(15) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reservas`
--

INSERT INTO `reservas` (`CodReserva`, `Matricula`, `NomeAluno`, `Titulo`, `SubTitulo`, `DataReserva`, `DataExpiracao`, `Situacao`, `data_registro`) VALUES
(13, 202320209, 'Debora Soares', ' O Jardim Secreto', 'Flores da Esperança', '2024-08-09', '2024-08-16', 'Disponível', '2024-08-09 14:51:53'),
(15, 202320206, 'Rafal oliveira', 'Entre Dois Mundos', 'A Fronteira Invisível', '2024-08-09', '2024-08-16', 'Disponível', '2024-08-09 15:05:38'),
(16, 202320205, 'Eminem Soares', 'O Código da História', 'Desvendando o Passado', '2024-08-16', '2024-08-23', 'Disponível', '2024-08-09 15:06:17'),
(17, 202319204, 'Carol Maia', 'Enigmas da Ciência', 'Desvendando o Inexplorado', '2024-08-10', '2024-08-16', 'Reservado', '2024-08-09 15:07:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(4) NOT NULL,
  `matricula` int(9) NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `senha` varchar(150) NOT NULL,
  `user_status` varchar(7) DEFAULT NULL,
  `user_tipo` varchar(18) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `matricula`, `nome`, `telefone`, `email`, `senha`, `user_status`, `user_tipo`, `data_registro`) VALUES
(1, 202120120, 'Tiago', '62 99259-4657', 'tsgo.soares@gmail.com', '$2y$10$U1bMtvFli0fUfGinjKXzpeRqXinr/j6dRAGSC.iumv63XmDvt7KKq', 'Ativo', 'Administrador', '2023-08-30 20:11:45'),
(18, 458441258, 'Daniel Soares', '62992594657', 'daniel.soares@teste.com', '$2y$10$x.IO33DqNErx9vcec7o7euMg64dIj.c52b8OlA9zQ5kkNYcdYpBMK', 'Ativo', 'Administrador', '2024-08-07 17:23:58');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acervo`
--
ALTER TABLE `acervo`
  ADD PRIMARY KEY (`codAcervo`);

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id_Aluno`);

--
-- Índices de tabela `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`codAutor`);

--
-- Índices de tabela `editora`
--
ALTER TABLE `editora`
  ADD PRIMARY KEY (`codEditora`);

--
-- Índices de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`codEmprestimo`);

--
-- Índices de tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`codEstado`),
  ADD UNIQUE KEY `uq_nome_estado` (`nome_estado`);

--
-- Índices de tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`CodGenero`);

--
-- Índices de tabela `obra`
--
ALTER TABLE `obra`
  ADD PRIMARY KEY (`codObra`);

--
-- Índices de tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`CodReserva`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acervo`
--
ALTER TABLE `acervo`
  MODIFY `codAcervo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id_Aluno` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `autor`
--
ALTER TABLE `autor`
  MODIFY `codAutor` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `editora`
--
ALTER TABLE `editora`
  MODIFY `codEditora` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `codEmprestimo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `codEstado` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `genero`
--
ALTER TABLE `genero`
  MODIFY `CodGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `obra`
--
ALTER TABLE `obra`
  MODIFY `codObra` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `CodReserva` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
