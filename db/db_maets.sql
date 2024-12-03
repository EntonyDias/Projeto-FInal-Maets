-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/12/2024 às 02:07
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_maets`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_administrador`
--

CREATE TABLE `tb_administrador` (
  `idAdm` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_biblioteca`
--

CREATE TABLE `tb_biblioteca` (
  `idBiblioteca` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `fk_itens` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_carrino`
--

CREATE TABLE `tb_carrino` (
  `idCarrinho` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `fk_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_desenvolvedor`
--

CREATE TABLE `tb_desenvolvedor` (
  `idDes` int(11) NOT NULL,
  `cnpjDes` varchar(18) NOT NULL,
  `nomeDes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_itens`
--

CREATE TABLE `tb_itens` (
  `idItens` int(11) NOT NULL,
  `fk_jogos` int(11) NOT NULL,
  `fk_carrinho` int(11) NOT NULL,
  `fk_biblioteca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_jogos`
--

CREATE TABLE `tb_jogos` (
  `idJogos` int(11) NOT NULL,
  `nomeJogo` varchar(255) NOT NULL,
  `ImgJogo` varchar(255) NOT NULL,
  `descricaoJogo` text NOT NULL,
  `precoJogo` float NOT NULL,
  `idadeCategJogo` int(11) NOT NULL,
  `fk_desenvolvedora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsu` varchar(100) NOT NULL,
  `cpfUsu` varchar(14) NOT NULL,
  `emailUsu` varchar(255) NOT NULL,
  `senhaUsu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_administrador`
--
ALTER TABLE `tb_administrador`
  ADD PRIMARY KEY (`idAdm`),
  ADD KEY `fk_usuario` (`fk_usuario`);

--
-- Índices de tabela `tb_biblioteca`
--
ALTER TABLE `tb_biblioteca`
  ADD PRIMARY KEY (`idBiblioteca`),
  ADD KEY `fk_usuario` (`fk_usuario`),
  ADD KEY `fk_itens` (`fk_itens`);

--
-- Índices de tabela `tb_carrino`
--
ALTER TABLE `tb_carrino`
  ADD PRIMARY KEY (`idCarrinho`),
  ADD KEY `fk_usuario` (`fk_usuario`);

--
-- Índices de tabela `tb_desenvolvedor`
--
ALTER TABLE `tb_desenvolvedor`
  ADD PRIMARY KEY (`idDes`);

--
-- Índices de tabela `tb_itens`
--
ALTER TABLE `tb_itens`
  ADD PRIMARY KEY (`idItens`),
  ADD KEY `fk_jogos` (`fk_jogos`),
  ADD KEY `fk_carrinho` (`fk_carrinho`),
  ADD KEY `fk_biblioteca` (`fk_biblioteca`);

--
-- Índices de tabela `tb_jogos`
--
ALTER TABLE `tb_jogos`
  ADD PRIMARY KEY (`idJogos`),
  ADD KEY `fk_desenvolvedora` (`fk_desenvolvedora`);

--
-- Índices de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_administrador`
--
ALTER TABLE `tb_administrador`
  MODIFY `idAdm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_biblioteca`
--
ALTER TABLE `tb_biblioteca`
  MODIFY `idBiblioteca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_carrino`
--
ALTER TABLE `tb_carrino`
  MODIFY `idCarrinho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_desenvolvedor`
--
ALTER TABLE `tb_desenvolvedor`
  MODIFY `idDes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_itens`
--
ALTER TABLE `tb_itens`
  MODIFY `idItens` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_jogos`
--
ALTER TABLE `tb_jogos`
  MODIFY `idJogos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_administrador`
--
ALTER TABLE `tb_administrador`
  ADD CONSTRAINT `tb_administrador_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `tb_usuarios` (`idUsuario`);

--
-- Restrições para tabelas `tb_biblioteca`
--
ALTER TABLE `tb_biblioteca`
  ADD CONSTRAINT `tb_biblioteca_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `tb_usuarios` (`idUsuario`),
  ADD CONSTRAINT `tb_biblioteca_ibfk_2` FOREIGN KEY (`fk_itens`) REFERENCES `tb_itens` (`idItens`);

--
-- Restrições para tabelas `tb_carrino`
--
ALTER TABLE `tb_carrino`
  ADD CONSTRAINT `tb_carrino_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `tb_usuarios` (`idUsuario`);

--
-- Restrições para tabelas `tb_itens`
--
ALTER TABLE `tb_itens`
  ADD CONSTRAINT `tb_itens_ibfk_1` FOREIGN KEY (`fk_jogos`) REFERENCES `tb_jogos` (`idJogos`),
  ADD CONSTRAINT `tb_itens_ibfk_2` FOREIGN KEY (`fk_carrinho`) REFERENCES `tb_carrino` (`idCarrinho`),
  ADD CONSTRAINT `tb_itens_ibfk_3` FOREIGN KEY (`fk_biblioteca`) REFERENCES `tb_biblioteca` (`idBiblioteca`);

--
-- Restrições para tabelas `tb_jogos`
--
ALTER TABLE `tb_jogos`
  ADD CONSTRAINT `tb_jogos_ibfk_1` FOREIGN KEY (`fk_desenvolvedora`) REFERENCES `tb_desenvolvedor` (`idDes`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;