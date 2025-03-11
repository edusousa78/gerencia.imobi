-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/03/2025 às 12:51
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
-- Banco de dados: `dbgerencia`
--
DROP DATABASE IF EXISTS `dbgerencia`;
CREATE DATABASE IF NOT EXISTS `dbgerencia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbgerencia`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissoes`
--

CREATE TABLE `permissoes` (
  `idPermissao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `permissoes` text DEFAULT NULL,
  `situacao` tinyint(1) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`idPermissao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `permissoes`
--

INSERT INTO `permissoes` (`idPermissao`, `nome`, `permissoes`, `situacao`, `data`) VALUES
(1, 'Administrador', 'a:24:{s:8:\"aCliente\";s:1:\"1\";s:8:\"eCliente\";s:1:\"1\";s:8:\"dCliente\";s:1:\"1\";s:8:\"vCliente\";s:1:\"1\";s:7:\"aImovel\";s:1:\"1\";s:7:\"eImovel\";s:1:\"1\";s:7:\"dImovel\";s:1:\"1\";s:7:\"vImovel\";s:1:\"1\";s:8:\"aLocacao\";s:1:\"1\";s:8:\"eLocacao\";s:1:\"1\";s:8:\"dLocacao\";s:1:\"1\";s:8:\"vLocacao\";s:1:\"1\";s:15:\"aEmpreendimento\";s:1:\"1\";s:15:\"eEmpreendimento\";s:1:\"1\";s:15:\"dEmpreendimento\";s:1:\"1\";s:15:\"vEmpreendimento\";s:1:\"1\";s:6:\"aVenda\";s:1:\"1\";s:6:\"eVenda\";s:1:\"1\";s:6:\"dVenda\";s:1:\"1\";s:6:\"vVenda\";s:1:\"1\";s:8:\"cUsuario\";s:1:\"1\";s:9:\"cEmitente\";s:1:\"1\";s:10:\"cPermissao\";s:1:\"1\";s:7:\"cBackup\";s:1:\"1\";}', 1, '2025-03-05'),
(2, 'Gestor', 'a:16:{s:8:\"aCliente\";s:1:\"1\";s:8:\"eCliente\";s:1:\"1\";s:8:\"dCliente\";s:1:\"1\";s:8:\"vCliente\";s:1:\"1\";s:7:\"aImovel\";s:1:\"1\";s:7:\"eImovel\";s:1:\"1\";s:7:\"dImovel\";s:1:\"1\";s:7:\"vImovel\";s:1:\"1\";s:8:\"aLocacao\";s:1:\"1\";s:8:\"eLocacao\";s:1:\"1\";s:8:\"dLocacao\";s:1:\"1\";s:8:\"vLocacao\";s:1:\"1\";s:15:\"aEmpreendimento\";s:1:\"1\";s:15:\"eEmpreendimento\";s:1:\"1\";s:15:\"dEmpreendimento\";s:1:\"1\";s:15:\"vEmpreendimento\";s:1:\"1\";}', 1, '2025-03-06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `situacao` tinyint(1) NOT NULL,
  `dataCadastro` date NOT NULL,
  `permissoes_id` int(11) NOT NULL,
  PRIMARY KEY (`idUsuarios`),
  KEY `permissoes_id` (`permissoes_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`permissoes_id`) REFERENCES `permissoes` (`idPermissao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `nome`, `email`, `senha`, `telefone`, `situacao`, `dataCadastro`, `permissoes_id`) VALUES
(2, 'Administrador', 'admin@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(11) 99999-9999', 1, '2025-03-05', 1),
(3, 'Luis Eduardo', 'sousa.ej@gmail.com', '$2y$10$VsrDqIP5WxrKX2kQyk8Fr.yy515k9oAGoiJxL0BXUAGRcJX5DZ6V2', '11960876411', 1, '2025-03-06', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `acessos_sistema`
--

CREATE TABLE `acessos_sistema` (
  `idAcesso` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuarios` int(11) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `dataHora` datetime DEFAULT current_timestamp(),
  `sucesso` tinyint(1) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  PRIMARY KEY (`idAcesso`),
  KEY `idUsuarios` (`idUsuarios`),
  CONSTRAINT `acessos_sistema_ibfk_1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `idClientes` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCliente` varchar(255) NOT NULL,
  `tipo` enum('Pessoa Física','Pessoa Jurídica') NOT NULL,
  `tipo_cliente` set('locador','locatario','fiador','vendedor','comprador','proprietario') DEFAULT NULL,
  `documento` varchar(20) NOT NULL,
  `inscEstadual` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `telefone2` varchar(20) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(2) NOT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `status` enum('Ativo','Inativo') DEFAULT 'Ativo',
  `email` varchar(100) NOT NULL,
  `observacoes` text DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  PRIMARY KEY (`idClientes`),
  UNIQUE KEY `documento` (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`idClientes`, `nomeCliente`, `tipo`, `tipo_cliente`, `documento`, `inscEstadual`, `telefone`, `telefone2`, `data_nascimento`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `status`, `email`, `observacoes`, `dataCadastro`) VALUES
(1, 'João Paulo da Silva', 'Pessoa Física', 'locatario,comprador', '563.356.998-78', '', '(11) 96633-2500', '', NULL, 'Avenida Vereador José Diniz', '1250', '', 'Parque Viana', 'São Paulo', 'SP', '06502-333', 'Ativo', 'jpsilva@gmail.com', '', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chave` varchar(50) NOT NULL,
  `valor` text DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `grupo` varchar(50) NOT NULL,
  `dataAlteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `chave` (`chave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `chave`, `valor`, `descricao`, `grupo`, `dataAlteracao`) VALUES
(1, 'empresa_nome', 'Consultoria Imobi', NULL, 'empresa', '2025-03-06 17:04:53'),
(2, 'empresa_cnpj', '12598737/0001-01', NULL, 'empresa', '2025-03-06 17:04:53'),
(3, 'empresa_endereco', 'Rua Getúlio Vargas, 385', NULL, 'empresa', '2025-03-06 17:04:53'),
(4, 'empresa_telefone', '11960876411', NULL, 'empresa', '2025-03-06 17:04:54'),
(5, 'empresa_email', 'sousa.ej@gmail.com', NULL, 'empresa', '2025-03-06 23:03:51'),
(6, 'empresa_site', '', NULL, 'empresa', '2025-03-06 17:04:54'),
(7, 'empresa_logo', '1741280855_066a7cd83f1b77f439b2.png', NULL, 'empresa', '2025-03-06 17:07:35'),
(8, 'email_protocol', NULL, NULL, 'email', '2025-03-06 17:09:20'),
(9, 'email_SMTPHost', 'smtp.gmail.com', NULL, 'email', '2025-03-06 17:24:47'),
(10, 'email_SMTPUser', 'sousa.ej@gmail.com', NULL, 'email', '2025-03-06 17:09:21'),
(11, 'email_SMTPPass', 'Cogumelo12@', NULL, 'email', '2025-03-06 17:09:21'),
(12, 'email_SMTPPort', '587', NULL, 'email', '2025-03-06 17:09:21'),
(13, 'email_SMTPCrypto', 'tls', NULL, 'email', '2025-03-06 17:09:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `corretores`
--

CREATE TABLE `corretores` (
  `idCorretor` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `creci` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `status` enum('ativo','inativo') NOT NULL,
  PRIMARY KEY (`idCorretor`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `corretores_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `corretores`
--

INSERT INTO `corretores` (`idCorretor`, `idUsuario`, `creci`, `telefone`, `status`) VALUES
(2, 2, '193175-F', '11968103521', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `corretores_desempenho`
--

CREATE TABLE `corretores_desempenho` (
  `idDesempenho` int(11) NOT NULL AUTO_INCREMENT,
  `idCorretor` int(11) NOT NULL,
  `mes` int(2) NOT NULL,
  `ano` int(4) NOT NULL,
  `totalVendas` int(11) DEFAULT 0,
  `valorVendas` decimal(15,2) DEFAULT 0,
  `valorComissoes` decimal(15,2) DEFAULT 0,
  `metaAtingida` decimal(5,2) DEFAULT 0,
  `pontuacao` int(11) DEFAULT 0,
  PRIMARY KEY (`idDesempenho`),
  KEY `idCorretor` (`idCorretor`),
  CONSTRAINT `fk_desempenho_corretor` FOREIGN KEY (`idCorretor`) REFERENCES `corretores` (`idCorretor`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `empreendimentos`
--

CREATE TABLE `empreendimentos` (
  `idEmpreendimento` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `tipo` enum('Residencial','Comercial','Misto') NOT NULL,
  `status` enum('lançamento','em_obras','pronto','vendido','inativo') NOT NULL,
  `valorMedio` decimal(15,2) DEFAULT NULL,
  `numUnidades` int(11) DEFAULT NULL,
  `areaTotal` decimal(10,2) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `dataCadastro` date NOT NULL,
  PRIMARY KEY (`idEmpreendimento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `empreendimentos`
--

INSERT INTO `empreendimentos` (`idEmpreendimento`, `nome`, `tipo`, `status`, `valorMedio`, `numUnidades`, `areaTotal`, `cidade`, `estado`, `dataCadastro`) VALUES
(1, 'Condominio residencial', 'Residencial', 'pronto', 68000.00, 25, 3850.00, 'Barueri', 'SP', '0000-00-00'),
(2, 'Rua Publica', 'Residencial', 'pronto', 0.00, 0, 0.00, 'Barueri', 'SP', '0000-00-00'),
(3, 'Rua Pública', 'Residencial', 'pronto', 0.00, 0, 0.00, 'São Paulo', 'SP', '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empreendimentos_midias`
--

CREATE TABLE `empreendimentos_midias` (
  `idMidia` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpreendimento` int(11) NOT NULL,
  `tipo` enum('foto','video') NOT NULL,
  `url` varchar(255) NOT NULL,
  `ordem` int(11) NOT NULL DEFAULT 0,
  `thumbnail` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`idMidia`),
  KEY `idEmpreendimento` (`idEmpreendimento`),
  CONSTRAINT `empreendimentos_midias_ibfk_1` FOREIGN KEY (`idEmpreendimento`) REFERENCES `empreendimentos` (`idEmpreendimento`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `empreendimentos_midias`
--

INSERT INTO `empreendimentos_midias` (`idMidia`, `idEmpreendimento`, `tipo`, `url`, `ordem`, `thumbnail`) VALUES
(2, 1, 'foto', '1741219542_52188f93574af4caeb8f.jpg', 999, 0),
(3, 1, 'foto', '1741219542_b886c29d34501ed400af.jpg', 999, 1),
(4, 1, 'foto', '1741219542_22e9db83c5409fcde2f0.jpg', 999, 0),
(5, 1, 'foto', '1741219542_733fcd9c5c3600705721.jpg', 999, 0),
(6, 1, 'foto', '1741219542_4c8c9ec28d7f7e120a03.jpg', 999, 0),
(7, 1, 'foto', '1741219542_50bfcfb4f070ab277024.jpg', 999, 0),
(8, 1, 'foto', '1741219542_4bd93e5f71fba938cee4.jpg', 999, 0),
(9, 2, 'foto', '1741269531_250a9ed289109c093e35.jpg', 999, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `imoveis`
--

CREATE TABLE `imoveis` (
  `idImovel` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpreendimento` int(11) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `tipo` enum('Apartamento','Casa','Terreno','Comercial') NOT NULL,
  `metragem` decimal(10,2) NOT NULL,
  `quartos` int(2) NOT NULL,
  `banheiros` int(2) NOT NULL,
  `vagas` int(2) NOT NULL,
  `valor` decimal(15,2) NOT NULL,
  `status` enum('disponível','vendido','alugado','inativo') NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` char(2) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idImovel`),
  KEY `idEmpreendimento` (`idEmpreendimento`),
  CONSTRAINT `imoveis_ibfk_1` FOREIGN KEY (`idEmpreendimento`) REFERENCES `empreendimentos` (`idEmpreendimento`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `imoveis`
--

INSERT INTO `imoveis` (`idImovel`, `idEmpreendimento`, `titulo`, `descricao`, `tipo`, `metragem`, `quartos`, `banheiros`, `vagas`, `valor`, `status`, `endereco`, `cidade`, `estado`, `dataCadastro`) VALUES
(2, 1, 'Casa Assobradada em Barueri', 'Imóvel recem reformado com sol da manha e bem arejado', 'Casa', 255.00, 4, 2, 2, 680000.00, 'alugado', 'Av vente e seis de março,125', 'Barueri', 'SP', '2025-03-06 00:01:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imoveis_corretores`
--

CREATE TABLE `imoveis_corretores` (
  `idImovel` int(11) NOT NULL,
  `idCorretor` int(11) NOT NULL,
  PRIMARY KEY (`idImovel`,`idCorretor`),
  KEY `idCorretor` (`idCorretor`),
  CONSTRAINT `imoveis_corretores_ibfk_1` FOREIGN KEY (`idImovel`) REFERENCES `imoveis` (`idImovel`) ON DELETE CASCADE,
  CONSTRAINT `imoveis_corretores_ibfk_2` FOREIGN KEY (`idCorretor`) REFERENCES `corretores` (`idCorretor`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imoveis_midias`
--

CREATE TABLE `imoveis_midias` (
  `idMidia` int(11) NOT NULL AUTO_INCREMENT,
  `idImovel` int(11) NOT NULL,
  `tipo` enum('foto','video') NOT NULL,
  `url` varchar(255) NOT NULL,
  `ordem` int(11) NOT NULL DEFAULT 0,
  `thumbnail` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`idMidia`),
  KEY `idImovel` (`idImovel`),
  CONSTRAINT `imoveis_midias_ibfk_1` FOREIGN KEY (`idImovel`) REFERENCES `imoveis` (`idImovel`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------
-- Estrutura para tabela `clientes_imoveis`
--

CREATE TABLE `clientes_imoveis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `idImovel` int(11) NOT NULL,
  `tipo_relacao` enum('vendedor','comprador','proprietario') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idCliente` (`idCliente`),
  KEY `idImovel` (`idImovel`),
  CONSTRAINT `clientes_imoveis_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idClientes`),
  CONSTRAINT `clientes_imoveis_ibfk_2` FOREIGN KEY (`idImovel`) REFERENCES `imoveis` (`idImovel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estrutura para tabela `locacoes`
--

CREATE TABLE `locacoes` (
  `idLocacao` int(11) NOT NULL AUTO_INCREMENT,
  `idImovel` int(11) NOT NULL,
  `idClientes` int(11) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataTermino` date NOT NULL,
  `valorAluguel` decimal(15,2) NOT NULL,
  `status` enum('ativa','encerrada','inadimplente') NOT NULL,
  `diaVencimento` int(2) NOT NULL,
  `valorCondominio` decimal(15,2) DEFAULT NULL,
  `valorIPTU` decimal(15,2) DEFAULT NULL,
  `valorSeguro` decimal(15,2) DEFAULT NULL,
  `duracao` int(3) NOT NULL COMMENT 'Duração em meses',
  `reajuste` decimal(5,2) DEFAULT NULL COMMENT 'Percentual de reajuste anual',
  `indexador` enum('IGPM','IPCA','INPC') DEFAULT NULL,
  `fiador` tinyint(1) DEFAULT 0,
  `seguroFianca` tinyint(1) DEFAULT 0,
  `depositoCaucao` decimal(15,2) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `garantia` enum('fiador','caucao','seguro') DEFAULT NULL,
  `valorGarantia` decimal(15,2) DEFAULT 0.00,
  PRIMARY KEY (`idLocacao`),
  KEY `idImovel` (`idImovel`),
  KEY `idCliente` (`idClientes`),
  CONSTRAINT `locacoes_ibfk_1` FOREIGN KEY (`idImovel`) REFERENCES `imoveis` (`idImovel`) ON DELETE CASCADE,
  CONSTRAINT `locacoes_ibfk_2` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `locacoes`
--

INSERT INTO `locacoes` (`idLocacao`, `idImovel`, `idClientes`, `dataInicio`, `dataTermino`, `valorAluguel`, `status`, `diaVencimento`, `valorCondominio`, `valorIPTU`, `valorSeguro`, `duracao`, `reajuste`, `indexador`, `fiador`, `seguroFianca`, `depositoCaucao`, `observacoes`, `garantia`, `valorGarantia`) VALUES
(1, 2, 1, '2025-03-07', '2027-03-06', 2600.00, 'ativa', 0, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, NULL, 0.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `locacoes_ocorrencias`
--

CREATE TABLE `locacoes_ocorrencias` (
  `idOcorrencia` int(11) NOT NULL AUTO_INCREMENT,
  `idLocacao` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `tipo` enum('manutencao','reclamacao','vistoria','notificacao','outros') DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `status` enum('aberto','em_andamento','resolvido','cancelado') DEFAULT NULL,
  PRIMARY KEY (`idOcorrencia`),
  KEY `idLocacao` (`idLocacao`),
  CONSTRAINT `locacoes_ocorrencias_ibfk_1` FOREIGN KEY (`idLocacao`) REFERENCES `locacoes` (`idLocacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `locacoes_ocorrencias`
--

INSERT INTO `locacoes_ocorrencias` (`idOcorrencia`, `idLocacao`, `data`, `tipo`, `descricao`, `status`) VALUES
(1, 1, NULL, 'notificacao', 'agua está saido fraca', 'aberto');

-- --------------------------------------------------------

--
-- Estrutura para tabela `locacoes_pagamentos`
--

CREATE TABLE `locacoes_pagamentos` (
  `idPagamento` int(11) NOT NULL AUTO_INCREMENT,
  `idLocacao` int(11) DEFAULT NULL,
  `competencia` date DEFAULT NULL,
  `vencimento` date DEFAULT NULL,
  `dataPagamento` date DEFAULT NULL,
  `valorAluguel` decimal(15,2) DEFAULT NULL,
  `valorCondominio` decimal(15,2) DEFAULT NULL,
  `valorIPTU` decimal(15,2) DEFAULT NULL,
  `valorMulta` decimal(15,2) DEFAULT NULL,
  `valorJuros` decimal(15,2) DEFAULT NULL,
  `valorTotal` decimal(15,2) DEFAULT NULL,
  `status` enum('pendente','pago','atrasado','parcial') DEFAULT NULL,
  PRIMARY KEY (`idPagamento`),
  KEY `idLocacao` (`idLocacao`),
  CONSTRAINT `locacoes_pagamentos_ibfk_1` FOREIGN KEY (`idLocacao`) REFERENCES `locacoes` (`idLocacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `locacoes_vistorias`
--

CREATE TABLE `locacoes_vistorias` (
  `idVistoria` int(11) NOT NULL AUTO_INCREMENT,
  `idLocacao` int(11) DEFAULT NULL,
  `tipo` enum('entrada','saida') DEFAULT NULL,
  `data` date DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  PRIMARY KEY (`idVistoria`),
  KEY `idLocacao` (`idLocacao`),
  CONSTRAINT `locacoes_vistorias_ibfk_1` FOREIGN KEY (`idLocacao`) REFERENCES `locacoes` (`idLocacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `locacoes_vistorias_itens`
--

CREATE TABLE `locacoes_vistorias_itens` (
  `idItem` int(11) NOT NULL AUTO_INCREMENT,
  `idVistoria` int(11) DEFAULT NULL,
  `comodo` varchar(50) DEFAULT NULL,
  `item` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idItem`),
  KEY `idVistoria` (`idVistoria`),
  CONSTRAINT `locacoes_vistorias_itens_ibfk_1` FOREIGN KEY (`idVistoria`) REFERENCES `locacoes_vistorias` (`idVistoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Estrutura para tabela `clientes_locacoes`
--

CREATE TABLE `clientes_locacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idClientes` int(11) NOT NULL,
  `idLocacao` int(11) NOT NULL,
  `tipo_relacao` enum('locador','locatario','fiador') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idClientes` (`idClientes`),
  KEY `idLocacao` (`idLocacao`),
  CONSTRAINT `clientes_locacoes_ibfk_1` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`),
  CONSTRAINT `clientes_locacoes_ibfk_2` FOREIGN KEY (`idLocacao`) REFERENCES `locacoes` (`idLocacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estrutura para tabela `logs_sistema`
--

CREATE TABLE `logs_sistema` (
  `idLog` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuarios` int(11) DEFAULT NULL,
  `acao` varchar(50) NOT NULL,
  `tabela` varchar(50) NOT NULL,
  `registro_id` int(11) DEFAULT NULL,
  `dados_antigos` text DEFAULT NULL,
  `dados_novos` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `dataHora` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`idLog`),
  KEY `idUsuarios` (`idUsuarios`),
  CONSTRAINT `logs_sistema_ibfk_1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `metas_corretores`
--

CREATE TABLE `metas_corretores` (
  `idMeta` int(11) NOT NULL AUTO_INCREMENT,
  `idCorretor` int(11) NOT NULL,
  `mes` int(2) NOT NULL,
  `ano` int(4) NOT NULL,
  `valorMeta` decimal(15,2) NOT NULL,
  `valorAlcancado` decimal(15,2) DEFAULT 0.00,
  `status` enum('Em Andamento','Concluída','Não Alcançada') NOT NULL DEFAULT 'Em Andamento',
  `bonificacao` decimal(15,2) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  PRIMARY KEY (`idMeta`),
  KEY `idCorretor` (`idCorretor`),
  CONSTRAINT `fk_metas_corretor` FOREIGN KEY (`idCorretor`) REFERENCES `corretores` (`idCorretor`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `idPagamento` int(11) NOT NULL AUTO_INCREMENT,
  `idLocacao` int(11) DEFAULT NULL,
  `mesReferencia` date DEFAULT NULL,
  `dataVencimento` date DEFAULT NULL,
  `valorBase` decimal(10,2) DEFAULT NULL,
  `multaAtraso` decimal(10,2) DEFAULT NULL,
  `jurosAtraso` decimal(10,2) DEFAULT NULL,
  `multa` decimal(10,2) DEFAULT NULL,
  `juros` decimal(10,2) DEFAULT NULL,
  `valorTotal` decimal(10,2) DEFAULT NULL,
  `formaPagamento` varchar(50) DEFAULT NULL,
  `dataPagamento` date DEFAULT NULL,
  `status` enum('pendente','pago','atrasado') DEFAULT 'pendente',
  `comprovante` varchar(255) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  PRIMARY KEY (`idPagamento`),
  KEY `idLocacao` (`idLocacao`),
  CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`idLocacao`) REFERENCES `locacoes` (`idLocacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `receitas`
--

CREATE TABLE `receitas` (
  `idReceita` int(11) NOT NULL AUTO_INCREMENT,
  `idPagamento` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `dataRecebimento` date NOT NULL,
  `formaPagamento` varchar(50) NOT NULL,
  `comprovante` varchar(255) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  PRIMARY KEY (`idReceita`),
  KEY `idPagamento` (`idPagamento`),
  CONSTRAINT `fk_receitas_pagamentos` FOREIGN KEY (`idPagamento`) REFERENCES `pagamentos` (`idPagamento`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `repasses`
--

CREATE TABLE `repasses` (
  `idRepasse` int(11) NOT NULL AUTO_INCREMENT,
  `idPagamento` int(11) DEFAULT NULL,
  `valorRepasse` decimal(10,2) DEFAULT NULL,
  `dataRepasse` date DEFAULT NULL,
  `status` enum('pendente','efetuado','cancelado') DEFAULT NULL,
  `comprovante` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idRepasse`),
  KEY `idPagamento` (`idPagamento`),
  CONSTRAINT `repasses_ibfk_1` FOREIGN KEY (`idPagamento`) REFERENCES `pagamentos` (`idPagamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `idVenda` int(11) NOT NULL AUTO_INCREMENT,
  `idImovel` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idCorretor` int(11) NOT NULL,
  `valor` decimal(15,2) NOT NULL,
  `dataVenda` date NOT NULL,
  `formaPagamento` enum('À Vista','Financiamento','Permuta','Parcelado') NOT NULL,
  `status` enum('Proposta','Em Andamento','Concluída','Cancelada') NOT NULL,
  `valorComissao` decimal(15,2) NOT NULL,
  `percentualComissao` decimal(5,2) NOT NULL,
  `observacoes` text DEFAULT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idVenda`),
  KEY `idImovel` (`idImovel`),
  KEY `idCliente` (`idCliente`),
  KEY `idCorretor` (`idCorretor`),
  CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`idImovel`) REFERENCES `imoveis` (`idImovel`),
  CONSTRAINT `vendas_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idClientes`),
  CONSTRAINT `vendas_ibfk_3` FOREIGN KEY (`idCorretor`) REFERENCES `corretores` (`idCorretor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comissoes`
--

CREATE TABLE `comissoes` (
  `idComissao` int(11) NOT NULL AUTO_INCREMENT,
  `idVenda` int(11) NOT NULL,
  `valor` decimal(15,2) NOT NULL,
  `percentual` decimal(5,2) NOT NULL,
  `dataVencimento` date NOT NULL,
  `dataPagamento` date DEFAULT NULL,
  `status` enum('Pendente','Pago','Cancelado') NOT NULL DEFAULT 'Pendente',
  `formaPagamento` varchar(50) DEFAULT NULL,
  `comprovante` varchar(255) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  PRIMARY KEY (`idComissao`),
  KEY `idVenda` (`idVenda`),
  CONSTRAINT `comissoes_ibfk_1` FOREIGN KEY (`idVenda`) REFERENCES `vendas` (`idVenda`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comissoes_parcelas`
--

CREATE TABLE `comissoes_parcelas` (
  `idParcela` int(11) NOT NULL AUTO_INCREMENT,
  `idComissao` int(11) NOT NULL,
  `numeroParcela` int(11) NOT NULL,
  `valor` decimal(15,2) NOT NULL,
  `vencimento` date NOT NULL,
  `dataPagamento` date DEFAULT NULL,
  `status` enum('Pendente','Pago','Atrasado') NOT NULL DEFAULT 'Pendente',
  PRIMARY KEY (`idParcela`),
  KEY `idComissao` (`idComissao`),
  CONSTRAINT `comissoes_parcelas_ibfk_1` FOREIGN KEY (`idComissao`) REFERENCES `comissoes` (`idComissao`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `idNotificacao` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `mensagem` text NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `lida` tinyint(1) DEFAULT 0,
  `data` datetime DEFAULT current_timestamp(),
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idNotificacao`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `propostas`
--

CREATE TABLE `propostas` (
  `idProposta` int(11) NOT NULL AUTO_INCREMENT,
  `idImovel` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idCorretor` int(11) NOT NULL,
  `tipo` enum('compra','locacao') NOT NULL,
  `valor` decimal(15,2) NOT NULL,
  `dataProposta` date NOT NULL,
  `dataValidade` date NOT NULL,
  `status` enum('em_analise','aprovada','recusada','cancelada') NOT NULL DEFAULT 'em_analise',
  `observacoes` text DEFAULT NULL,
  `condicoesPagamento` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idProposta`),
  KEY `idImovel` (`idImovel`),
  KEY `idCliente` (`idCliente`),
  KEY `idCorretor` (`idCorretor`),
  CONSTRAINT `propostas_ibfk_1` FOREIGN KEY (`idImovel`) REFERENCES `imoveis` (`idImovel`),
  CONSTRAINT `propostas_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idClientes`),
  CONSTRAINT `propostas_ibfk_3` FOREIGN KEY (`idCorretor`) REFERENCES `corretores` (`idCorretor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `documentos`
--

CREATE TABLE `documentos` (
  `idDocumento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  `idReferencia` int(11) NOT NULL,
  `tipoReferencia` enum('imovel','cliente','locacao','venda') NOT NULL,
  `nomeArquivo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `dataCadastro` datetime DEFAULT current_timestamp(),
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idDocumento`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
