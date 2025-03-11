-- Garante índices corretos
ALTER TABLE clientes_locacoes
ADD INDEX idx_clientes_locacoes_tipos (idLocacao, tipo_relacao);

-- Limpa possíveis relacionamentos duplicados
DELETE t1 FROM clientes_locacoes t1
INNER JOIN clientes_locacoes t2 
WHERE t1.id > t2.id 
AND t1.idLocacao = t2.idLocacao 
AND t1.tipo_relacao = t2.tipo_relacao;
