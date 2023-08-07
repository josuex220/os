-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 07/08/2023 às 03:23
-- Versão do servidor: 10.6.12-MariaDB-cll-lve
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u273407085_os2023`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `id_equipamento` int(11) NOT NULL,
  `tipo` enum('IMP','EQP') DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `serie` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `garantia` varchar(255) DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `num_patrimonio` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `codigo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura para tabela `os`
--

CREATE TABLE `os` (
  `id_os` int(11) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `data_hora` datetime DEFAULT NULL,
  `data_hora_update` datetime DEFAULT NULL,
  `id_equipamento` int(11) DEFAULT NULL,
  `id_setor` int(11) DEFAULT NULL,
  `problema_cliente` varchar(255) DEFAULT NULL,
  `data_hora_agenda` varchar(255) DEFAULT NULL,
  `diagnostico` text DEFAULT NULL,
  `solucao` text DEFAULT NULL,
  `previsao_entrega` datetime DEFAULT NULL,
  `data_entrega` datetime DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `id_tecnico` int(11) DEFAULT NULL,
  `solicitante` varchar(200) NOT NULL,
  `home_is_visible` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE `setor` (
  `id_setor` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

--
-- Despejando dados para a tabela `setor`
--

INSERT INTO `setor` (`id_setor`, `name`, `status`) VALUES
(1, 'Sec Obras', 1),
(2, 'Sec Educação ', 1),
(3, 'Sec Saude', 1),
(6, 'NTI', 1),
(7, 'Sec Finanças', 1),
(8, 'Ass-Social', 1),
(9, 'Sec Administração', 1),
(10, 'CRAS', 1),
(11, 'Conselho Tutelar', 1),
(12, 'Contabilidade', 1),
(13, 'Departamento Pessoal', 1),
(14, 'Tributos', 1),
(15, 'Compras', 1),
(16, 'Posto Saúde -SEDE', 1),
(17, 'Posto Saúde - Povinho', 1),
(18, 'Posto Saúde - Encruzinhada', 1),
(19, 'Posto Saúde - Serra Iguariaça', 1),
(20, 'Posto Saúde - São Donato', 1),
(21, 'Posto Saúde - Bororé', 1),
(22, 'Posto Saúde - Passo do Goularte', 1),
(23, 'Escola Jose Piegas', 1),
(24, 'Escola Euclides Aranha', 1),
(25, 'Escola Marechal Rondon', 1),
(26, 'Procuradoria', 1),
(27, 'Juridico', 1),
(28, 'Patrimonio', 1),
(29, 'PIM', 1),
(30, 'Meio Ambiente', 1),
(31, 'Auditoria', 1),
(32, 'Farmacia', 1),
(33, 'Engenharia', 1),
(34, 'Vigilancia Sanitaria', 1),
(35, 'ICMS', 1),
(36, 'Centro Fisio', 1),
(37, 'Imprensa', 1),
(38, 'Tesouraria', 1),
(39, 'Seg Trabalho', 1),
(40, 'Licitação', 1),
(41, 'Sec - Agricultura', 1),
(42, 'Nutrição', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `roles` enum('ADMIN','TECNICO','USER') DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id_user`, `name`, `username`, `password`, `roles`, `status`) VALUES
(1, 'Admin', 'admin', '$2y$10$3xJAYuq9sKt4aaPLtIJ8F.MEqyGIvkx5xakkOTDg4aDDs.NC0X/tO', 'ADMIN', 1),
(5, 'Felipe', 'Felipe@felipe', '$2y$10$U66KrW5E9KadLvn90ZOomecg9IKh0LEWC76othM6DXJACK3ubYESi', 'TECNICO', 1),
(6, 'Lucas Navarro', 'Lucas@lucas', '$2y$10$1hyomK/EYH42CI3j4OoAqucUUZjnsPdDMnTFrucm9BcpHdRtNX1pK', 'TECNICO', 1),
(7, 'Rodrigo Borges', 'Rodrigo@rodrigo', '$2y$10$UENA.AfiwuW8YvELGRU0Oe6VCk2rkceVrUJEW0dNIQ1aBYwplXbXS', 'TECNICO', 1),
(8, 'PMM', 'Pmm', '$2y$10$2/TqqySuhUzcszSp3wYeI.wcvpBRqy5Ie/5QkfqEA1xnNamrGhole', 'USER', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`id_equipamento`) USING BTREE;

--
-- Índices de tabela `os`
--
ALTER TABLE `os`
  ADD PRIMARY KEY (`id_os`) USING BTREE;

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id_setor`) USING BTREE;

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `id_equipamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `os`
--
ALTER TABLE `os`
  MODIFY `id_os` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `id_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
