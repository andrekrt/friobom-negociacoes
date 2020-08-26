-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 19/08/2020 às 08:08
-- Versão do servidor: 10.4.13-MariaDB
-- Versão do PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `friobom`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `movimentacoes`
--

CREATE TABLE `movimentacoes` (
  `id` int(11) NOT NULL,
  `codForn` varchar(10) NOT NULL,
  `dataAtual` date NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `codCli` varchar(10) NOT NULL,
  `nomeCli` varchar(100) NOT NULL,
  `produto` varchar(100) NOT NULL,
  `tipoPag` varchar(100) NOT NULL,
  `valor` varchar(10) NOT NULL,
  `statusPed` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `arquivo` varchar(250) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `movimentacoes`
--

INSERT INTO `movimentacoes` (`id`, `codForn`, `dataAtual`, `motivo`, `codCli`, `nomeCli`, `produto`, `tipoPag`, `valor`, `statusPed`, `tipo`, `arquivo`, `idUsuario`) VALUES
(40, '9867', '2020-07-27', 'Verba Sell Out', '02', 'friobom', 'teste', 'Bonificação', '45.89', 'Reservado p/ Receber', 'Saída', 'cores invertidas.png', 15),
(41, '1414', '2020-07-27', 'Negociação Pontual (Cliente)', '2', 'friobom', 'teste', 'Bonificação', '678.09', 'Recebido', 'Entrada', '', 15),
(42, '9867', '2020-07-30', 'Negociação Pontual (Cliente)', '2', 'friobom', 'teste para ve', 'Bonificação', '123.76', 'Reservado p/ Receber', 'Saída', '', 23);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipoUsuario`
--

CREATE TABLE `tipoUsuario` (
  `id` int(11) NOT NULL,
  `nomeTipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tipoUsuario`
--

INSERT INTO `tipoUsuario` (`id`, `nomeTipo`) VALUES
(1, 'adm'),
(2, 'fornec');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUser` int(11) NOT NULL,
  `codInt` int(11) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `representante` varchar(150) NOT NULL,
  `telefone` varchar(18) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `idTipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUser`, `codInt`, `cnpj`, `nome`, `representante`, `telefone`, `senha`, `idTipo`) VALUES
(15, 2, '69.550.645/0001-02', 'Friobom', 'André Santos', '(99) 981161777', '47c9b1ed07e085dd7ceb010660126e6f', 1),
(22, 1414, '49.068.917/0001-17', 'Davi e Giovanni Gráfica Ltda', 'pedro paulo', '(99) 98214-5679', 'adcebeafbb16fc1ac715d06e0d66b986', 2),
(23, 9867, '86.390.064/0001-61', 'Julia e Ryan Pizzaria ME', 'Joao Pedro', '(99) 98114-2665', '3dfcab79ed21fd89c9eb25e9864a6155', 2);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tipoUsuario`
--
ALTER TABLE `tipoUsuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `tipoUsuario`
--
ALTER TABLE `tipoUsuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
