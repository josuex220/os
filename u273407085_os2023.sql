-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05/08/2023 às 11:42
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

--
-- Despejando dados para a tabela `equipamentos`
--

INSERT INTO `equipamentos` (`id_equipamento`, `tipo`, `status`, `modelo`, `marca`, `serie`, `ip`, `garantia`, `ref`, `num_patrimonio`, `descricao`, `codigo`) VALUES
(1, 'EQP', 1, '1231', 'DELL', '1', '192.168.1.1', '1 ano', 'preto', 'EQP-1231231', 'teste', '1000'),
(2, 'IMP', 1, '321', 'HP', 'DESKJET', '192.168.2.1', '', 'Branca', 'IMP-12312', NULL, '1001'),
(3, 'EQP', 0, 'Inspiron 15', 'Dell', '2', '127.0.0.1', 'Sem Garantia', 'PC Preto', 'EQP-64c9ada7a4dcb', 'teste213123', '10010'),
(5, 'IMP', 0, 'Deskjet', 'Hp', 'Serie 2', '127.0.0.1', 'teste', 'teste', 'EQP-64c9b071eb90c', 'teste', '1003');

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
  `solicitante` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

--
-- Despejando dados para a tabela `os`
--

INSERT INTO `os` (`id_os`, `status`, `id_user`, `data_hora`, `data_hora_update`, `id_equipamento`, `id_setor`, `problema_cliente`, `data_hora_agenda`, `diagnostico`, `solucao`, `previsao_entrega`, `data_entrega`, `valor`, `obs`, `id_tecnico`, `solicitante`) VALUES
(4, 1, 1, '2023-08-05 04:07:44', '2023-08-05 04:07:44', 1, 6, 'teste asd', NULL, NULL, NULL, NULL, NULL, NULL, 'teste asdteste asdteste asdteste asd', NULL, 'Josue Vidal');

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
(7, 'Sec Finanças', 1);

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
  MODIFY `id_equipamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `os`
--
ALTER TABLE `os`
  MODIFY `id_os` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `id_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
