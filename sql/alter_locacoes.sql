-- Criar tabela de relacionamento entre locações e clientes
CREATE TABLE IF NOT EXISTS `clientes_locacoes` (
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
