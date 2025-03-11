-- Ajusta a tabela clientes_locacoes
ALTER TABLE clientes_locacoes MODIFY COLUMN tipo_relacao enum('locador','locatario','fiador') NOT NULL;

-- Garante que os relacionamentos estejam corretos
ALTER TABLE clientes_locacoes
ADD CONSTRAINT unique_cliente_locacao_tipo UNIQUE (idLocacao, tipo_relacao);

-- Índice para melhorar performance das buscas
CREATE INDEX idx_cliente_locacao_tipo ON clientes_locacoes (idLocacao, tipo_relacao);
