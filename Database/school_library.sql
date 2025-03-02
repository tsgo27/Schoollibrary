-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/03/2025 às 15:29
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
-- Banco de dados: `school_library`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acervo`
--

CREATE TABLE `acervo` (
  `id_acervo` int(4) NOT NULL,
  `acervo` varchar(10) DEFAULT NULL,
  `status_acervo` varchar(7) NOT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `acervo`
--

INSERT INTO `acervo` (`id_acervo`, `acervo`, `status_acervo`, `data_registro`) VALUES
(3, 'CA-LE-N1', 'Ativo', '2023-09-26 09:48:59'),
(4, 'CA-LE-N2', 'Ativo', '2023-09-29 17:30:50'),
(5, 'KC-LD-N1', 'Ativo', '2023-10-09 09:34:42'),
(6, 'CA-LD-N1', 'Ativo', '2023-10-09 09:35:16'),
(7, 'CA-LD-N9', 'Ativo', '2023-12-13 15:46:03'),
(9, 'CB-LD-NT', 'Ativo', '2024-08-02 17:14:37'),
(10, 'CA-LD-97', 'Ativo', '2024-08-02 17:14:47'),
(24, 'CB-LD-RW', 'Ativo', '2024-08-05 16:33:41'),
(25, 'CB-LD-RV', 'Ativo', '2024-08-09 16:59:17'),
(26, 'CB-LD-88', 'Ativo', '2025-02-19 16:59:34'),
(27, 'CB-LD-66', 'Ativo', '2025-03-02 10:43:26');

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id_aluno` int(4) NOT NULL,
  `matricula` int(9) NOT NULL,
  `turma` varchar(5) DEFAULT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `user_status` varchar(7) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id_aluno`, `matricula`, `turma`, `nome`, `telefone`, `email`, `user_status`, `data_registro`) VALUES
(24, 202320120, '3º A', 'Igor Silva', '6200000-0000', 'igor.silva@teste.com', 'Inativo', '2023-12-07 14:37:51'),
(26, 202320121, '1º A', 'Maria', '6200000-0000', 'maria.silva@teste.com', 'Ativo', '2023-12-07 16:01:58'),
(27, 202319202, '2º A', 'Daniel Soares', '6200000-0000', 'daniel.soares@teste.com', 'Ativo', '2023-12-13 15:28:11'),
(28, 202319203, '4º A', 'Dani Martins', '6200000-0000', 'dani.martins@teste.com', 'Ativo', '2023-12-13 16:58:23'),
(29, 202319204, '3º B', 'Carol Maia', '6200000-0000', 'carol.maia@teste.com', 'Ativo', '2023-12-13 16:59:29'),
(31, 202320206, '3º A', 'Rafal oliveira', '62992594657', 'rafael.oliveira@teste.com', 'Ativo', '2023-12-13 17:01:24'),
(32, 202320207, '3º A', 'Ivani Filho', '6200000-0000', 'ivani.filho@teste.com', 'Ativo', '2023-12-13 17:02:14'),
(33, 202320208, '3º A', 'joão Gustavo', '6200000-0000', 'joao.gustavo@teste.com', 'Inativo', '2023-12-13 17:02:50'),
(34, 202320209, '3º A', 'Debora Soares', '6201255-9899', 'debora.soares@teste.com', 'Ativo', '2023-12-13 17:03:26'),
(44, 202540034, '3º A', 'Maisa reis', '620025-60660', 'maisa@email.com', 'Inativo', '2025-02-22 12:24:16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `autor`
--

CREATE TABLE `autor` (
  `id_autor` int(4) NOT NULL,
  `nome_autor` varchar(100) NOT NULL,
  `status_autor` varchar(7) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `autor`
--

INSERT INTO `autor` (`id_autor`, `nome_autor`, `status_autor`, `data_registro`) VALUES
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
(37, 'Maria Silva', 'Ativo', '2024-08-05 17:08:46'),
(38, 'Marcos feliciano', 'Ativo', '2025-03-02 10:40:13'),
(39, 'Eleith', 'Ativo', '2025-03-02 10:40:37');

-- --------------------------------------------------------

--
-- Estrutura para tabela `editora`
--

CREATE TABLE `editora` (
  `id_editora` int(4) NOT NULL,
  `nome_editora` varchar(60) NOT NULL,
  `cidade_editora` varchar(60) NOT NULL,
  `estado_editora` varchar(50) NOT NULL,
  `status_editora` varchar(7) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `editora`
--

INSERT INTO `editora` (`id_editora`, `nome_editora`, `cidade_editora`, `estado_editora`, `status_editora`, `data_registro`) VALUES
(25, 'Imaginários Ltda.', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 10:18:25'),
(26, 'Conhecimento Press', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 10:18:43'),
(27, 'Contos Coloridos', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 10:18:56'),
(28, 'Editora Enigma', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 10:19:06'),
(29, 'Arte das Palavras', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 10:19:19'),
(30, 'Saraiva', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 10:23:57'),
(31, 'AstroEdições', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 15:20:13'),
(32, 'Exploração Livros', 'Aparecida de Goiânia', 'Goiás-GO', 'Ativo', '2023-12-13 15:48:14'),
(33, 'Fan', 'Osasco', 'São Paulo-SP', 'Ativo', '2024-08-07 11:55:33'),
(34, 'Teste', 'Aparecida', 'Goiás-GO', 'Ativo', '2025-02-19 16:57:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `id_emprestimo` int(4) NOT NULL,
  `matricula_aluno` int(9) NOT NULL,
  `turma_aluno` varchar(5) DEFAULT NULL,
  `nome_aluno` varchar(50) NOT NULL,
  `titulo_livro` varchar(100) NOT NULL,
  `data_emprestimo` date NOT NULL,
  `data_devolucao` date NOT NULL,
  `status_emprestimo` varchar(15) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `emprestimo`
--

INSERT INTO `emprestimo` (`id_emprestimo`, `matricula_aluno`, `turma_aluno`, `nome_aluno`, `titulo_livro`, `data_emprestimo`, `data_devolucao`, `status_emprestimo`, `data_registro`) VALUES
(1, 202319204, '3º B', 'Carol Maia', 'Java ', '2025-02-23', '2025-02-26', 'Emprestado', '2025-02-23 00:22:17'),
(27, 202320209, '3º A', 'Debora Soares', 'Poesias Efêmeras', '2025-02-15', '2025-02-18', 'Emprestado', '2025-02-18 17:13:37'),
(32, 202320208, '3º A', 'joão Gustavo', 'Avançao da IA', '2025-02-22', '2025-02-19', 'Disponível', '2025-02-19 14:09:25'),
(33, 202320207, '3º A', 'Ivani Filho', ' O Jardim Secreto', '2025-02-16', '2025-02-23', 'Disponível', '2025-02-23 15:23:14'),
(34, 202319203, '4º A', 'Dani Martins', 'O Código da História', '2025-02-16', '2025-02-23', 'Emprestado', '2025-02-23 15:28:18'),
(35, 202320206, '3º A', 'Rafal oliveira', ' O Jardim Secreto', '2025-02-16', '2025-02-23', 'Emprestado', '2025-02-23 21:52:28'),
(36, 202320207, '3º A', 'Ivani Filho', 'O Último Refúgio ', '2025-02-16', '2025-02-23', 'Emprestado', '2025-02-23 22:00:07'),
(37, 202319202, '2º A', 'Daniel Soares', 'Aventuras Fantásticas', '2025-02-16', '2025-03-02', 'Emprestado', '2025-02-23 22:02:20'),
(38, 202320121, '1º A', 'Maria', 'Java ', '2025-02-16', '2025-02-23', 'Emprestado', '2025-02-23 22:27:43');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(4) NOT NULL,
  `nome_estado` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estado`
--

INSERT INTO `estado` (`id_estado`, `nome_estado`) VALUES
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
  `id_genero` int(11) NOT NULL,
  `nome_genero` varchar(100) NOT NULL,
  `status_genero` varchar(7) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `genero`
--

INSERT INTO `genero` (`id_genero`, `nome_genero`, `status_genero`, `data_registro`) VALUES
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
(29, 'Literatura Infantojuvenil', 'Ativo', '2024-08-09 11:35:03'),
(30, 'Alegria', 'Ativo', '2025-02-19 14:46:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `obra`
--

CREATE TABLE `obra` (
  `codObra` int(4) NOT NULL,
  `Isbn` varchar(20) DEFAULT NULL,
  `Titulo` varchar(100) NOT NULL,
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

INSERT INTO `obra` (`codObra`, `Isbn`, `Titulo`, `Autor`, `Edicao`, `Ano`, `Copia`, `Acervo`, `Genero`, `Editora`, `Situacao`, `data_registro`) VALUES
(13, '978-0-123456-7', 'Aventuras Fantásticas', 'Laura A. Escritora', 1, 2022, 2, 'GV-TR-1', 'Fantasia', 'Saraiva', 'Emprestado', '2023-12-13 10:17:43'),
(14, '978-0-234567-10', 'Enigmas da Ciência', 'Carlos Cientista', 3, 2020, 3, 'CA-LE-N2', 'Drama', 'Imaginários Ltda.', 'Disponível', '2023-12-13 10:26:06'),
(15, '978-0-345678-9', ' O Jardim Secreto', ' Sofia Jardineira', 2, 2019, 1, 'CA-LE-N2', 'Infantojuvenil', 'Imaginários Ltda.', NULL, '2023-12-13 10:27:51'),
(16, '978-0-456789-0', 'Noite de Mistérios ', 'Rodrigo Detetive', 1, 2021, 4, 'GB-4-L-1-2', 'Mistério', 'Imaginários Ltda.', 'Disponível', '2023-12-13 10:37:41'),
(17, ' 978-0-567890-1', 'Poesias Efêmeras', 'Ana Poetisa  ', 4, 2018, 2, 'GB-4-L-1-2', 'Poesia', 'Imaginários Ltda.', 'Emprestado', '2023-12-13 10:38:49'),
(18, '978-0-678901-2', 'O Último Refúgio ', 'Victor Viajante', 5, 1995, 1, 'CA-LE-N2', 'Ficção Científica', 'Exploração Livros', 'Emprestado', '2023-12-13 15:52:10'),
(19, '978-0-123456-7', 'Além das Estrelas ', 'Lucas Astrônomo', 4, 2021, 1, 'GB-4-L-1-3', 'Aventura', 'Conhecimento Press', 'Reservado', '2023-12-13 16:03:35'),
(20, '978-0-234567-2', 'O Código da História', 'Clara Historiadora', 1, 1993, 5, 'CA-LE-N1', 'Mistério', 'Contos Coloridos', NULL, '2023-12-13 16:11:20'),
(21, '978-0-345678-7', 'Entre Dois Mundos', 'Roberto Viajante', 1, 1993, 5, 'GB-4-L-1-3', 'Mistério', 'Editora Enigma', 'Disponível', '2023-12-13 16:14:05'),
(22, '978-0-4567890-9', 'Poemas da Meia-Noite', 'Lídia Poetisa', 1, 1998, 1, 'GB-4-L-1-1', 'Literatura Infantojuvenil', 'Saraiva', 'Disponível', '2023-12-13 16:15:49'),
(28, '985-59-562-10', 'Java ', 'Martine', 1, 1992, 1, 'CB-LD-NT', 'Aventura', 'Arte das Palavras', 'Emprestado', '2025-02-19 13:25:39'),
(30, '234-443-44-24', 'Avançao da IA', 'Monteiro Lobato', 1, 2024, 1, 'CB-LD-NT', 'Alegria', 'Arte das Palavras', 'Disponível', '2025-02-19 23:51:49'),
(31, '234-443-44-2', 'Histórica de Zico', 'Flavio Santos', 1, 1981, 1, 'CB-LD-NT', 'Alegria', 'Arte das Palavras', 'Disponível', '2025-02-25 14:36:22'),
(32, '234-443-44-2', 'Flamengo campeão', 'Marcos feliciano', 1, 1993, 1, 'CB-LD-NT', 'Historia', 'Editora Enigma', 'Disponível', '2025-03-02 10:49:40'),
(33, '234-443-44-2', 'Eleith', 'Eleith', 1, 2025, 1, 'CB-LD-88', 'Alegria', 'Arte das Palavras', 'Disponível', '2025-03-02 10:51:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(4) NOT NULL,
  `matricula_aluno` int(9) NOT NULL,
  `turma_aluno` varchar(5) NOT NULL,
  `nome_aluno` varchar(50) NOT NULL,
  `titulo_livro` varchar(100) NOT NULL,
  `data_reserva` date NOT NULL,
  `data_expiracao` date NOT NULL,
  `situacao_reserva` varchar(15) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `matricula_aluno`, `turma_aluno`, `nome_aluno`, `titulo_livro`, `data_reserva`, `data_expiracao`, `situacao_reserva`, `data_registro`) VALUES
(4, 202320208, '3º A', 'joão Gustavo', 'Além das Estrelas ', '2025-02-16', '2025-02-23', 'Reservado', '2025-02-23 15:09:12'),
(5, 202320206, '3º A', 'Rafal oliveira', 'O Código da História', '2025-02-16', '2025-02-23', 'Disponível', '2025-02-23 15:10:33'),
(6, 202319203, '4º A', 'Dani Martins', 'O Último Refúgio ', '2025-02-16', '2025-02-23', 'Disponível', '2025-02-23 15:31:40'),
(7, 202319203, '4º A', 'Dani Martins', 'O Último Refúgio ', '2025-02-16', '2025-02-23', 'Disponível', '2025-02-23 15:43:30'),
(8, 202320206, '3º A', 'Rafal oliveira', ' O Jardim Secreto', '2025-02-16', '2025-02-23', 'Disponível', '2025-02-23 21:51:09');

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
(1, 202120120, 'Tiago', '6299259-4657', 'tsgo.soares@gmail.com', '$2y$10$U1bMtvFli0fUfGinjKXzpeRqXinr/j6dRAGSC.iumv63XmDvt7KKq', 'Ativo', 'Administrador', '2023-08-30 20:11:45'),
(18, 458441255, 'Daniel Soares', '6299259-4658', 'daniel.soares@teste.com', '$2y$10$x.IO33DqNErx9vcec7o7euMg64dIj.c52b8OlA9zQ5kkNYcdYpBMK', 'Ativo', 'Administrador', '2024-08-07 17:23:58');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acervo`
--
ALTER TABLE `acervo`
  ADD PRIMARY KEY (`id_acervo`);

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id_aluno`);

--
-- Índices de tabela `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id_autor`);

--
-- Índices de tabela `editora`
--
ALTER TABLE `editora`
  ADD PRIMARY KEY (`id_editora`);

--
-- Índices de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`id_emprestimo`);

--
-- Índices de tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`),
  ADD UNIQUE KEY `uq_nome_estado` (`nome_estado`);

--
-- Índices de tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Índices de tabela `obra`
--
ALTER TABLE `obra`
  ADD PRIMARY KEY (`codObra`);

--
-- Índices de tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`);

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
  MODIFY `id_acervo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id_aluno` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `autor`
--
ALTER TABLE `autor`
  MODIFY `id_autor` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `editora`
--
ALTER TABLE `editora`
  MODIFY `id_editora` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `id_emprestimo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `obra`
--
ALTER TABLE `obra`
  MODIFY `codObra` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
