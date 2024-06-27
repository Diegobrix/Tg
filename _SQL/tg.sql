-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Jun-2024 às 06:50
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tg`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `emailUsuario` varchar(200) NOT NULL,
  `senhaUsuario` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `descricaoCategoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingrediente`
--

CREATE TABLE `ingrediente` (
  `idIngrediente` int(11) NOT NULL,
  `descricaoIngrediente` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingredientereceita`
--

CREATE TABLE `ingredientereceita` (
  `idReceita` int(11) NOT NULL,
  `idIngrediente` int(11) NOT NULL,
  `qtdeIngrediente` int(11) NOT NULL,
  `medida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medida`
--

CREATE TABLE `medida` (
  `idMedida` int(11) NOT NULL,
  `descricaoMedida` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

CREATE TABLE `receita` (
  `idReceita` int(11) NOT NULL,
  `tituloReceita` varchar(100) NOT NULL,
  `descricaoReceita` text NOT NULL,
  `beneficiosReceita` text NOT NULL,
  `modoDePreparoReceita` text NOT NULL,
  `fotoReceita` varchar(300) DEFAULT NULL,
  `categoriaReceita` int(11) NOT NULL,
  `editor` int(11) DEFAULT NULL,
  `autor` varchar(100) NOT NULL,
  `fonte` text DEFAULT NULL,
  `indicadaPara` varchar(10) NOT NULL,
  `dataReceita` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `video`
--

CREATE TABLE `video` (
  `idVideo` int(11) NOT NULL,
  `titVideo` varchar(100) NOT NULL,
  `descricaoVideo` text DEFAULT NULL,
  `urlVideo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `videoreceita`
--

CREATE TABLE `videoreceita` (
  `idReceita` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Índices para tabela `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`idIngrediente`);

--
-- Índices para tabela `ingredientereceita`
--
ALTER TABLE `ingredientereceita`
  ADD KEY `idReceita` (`idReceita`),
  ADD KEY `idIngrediente` (`idIngrediente`),
  ADD KEY `unidadeDeMedidaIngrediente` (`medida`);

--
-- Índices para tabela `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`idMedida`);

--
-- Índices para tabela `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`idReceita`),
  ADD KEY `categoriaReceita` (`categoriaReceita`),
  ADD KEY `autorFk` (`editor`);

--
-- Índices para tabela `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`idVideo`);

--
-- Índices para tabela `videoreceita`
--
ALTER TABLE `videoreceita`
  ADD KEY `idReceita` (`idReceita`),
  ADD KEY `idVideo` (`idVideo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `idIngrediente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `medida`
--
ALTER TABLE `medida`
  MODIFY `idMedida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `receita`
--
ALTER TABLE `receita`
  MODIFY `idReceita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `video`
--
ALTER TABLE `video`
  MODIFY `idVideo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ingredientereceita`
--
ALTER TABLE `ingredientereceita`
  ADD CONSTRAINT `ingredientereceita_ibfk_1` FOREIGN KEY (`idReceita`) REFERENCES `receita` (`idReceita`),
  ADD CONSTRAINT `ingredientereceita_ibfk_2` FOREIGN KEY (`idIngrediente`) REFERENCES `ingrediente` (`idIngrediente`),
  ADD CONSTRAINT `ingredientereceita_ibfk_3` FOREIGN KEY (`medida`) REFERENCES `medida` (`idMedida`);

--
-- Limitadores para a tabela `receita`
--
ALTER TABLE `receita`
  ADD CONSTRAINT `autorFk` FOREIGN KEY (`editor`) REFERENCES `administrador` (`idUsuario`),
  ADD CONSTRAINT `receita_ibfk_1` FOREIGN KEY (`categoriaReceita`) REFERENCES `categoria` (`idCategoria`);

--
-- Limitadores para a tabela `videoreceita`
--
ALTER TABLE `videoreceita`
  ADD CONSTRAINT `videoreceita_ibfk_1` FOREIGN KEY (`idReceita`) REFERENCES `receita` (`idReceita`),
  ADD CONSTRAINT `videoreceita_ibfk_2` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
