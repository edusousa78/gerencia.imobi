ALTER TABLE imoveis
ADD COLUMN created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP;
