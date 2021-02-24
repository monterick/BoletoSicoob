SELECT
	c.usuario_LOGIN AS login,
	--
	CASE WHEN CHAR_LENGTH(c.cont_cnpj) > 14 THEN 2 ELSE 1 END AS tipo_inscricao,
	REPLACE(REPLACE(REPLACE(c.cont_cnpj, '.', ''), '-', ''), '/', '') AS numero_inscricao,
	c.contratante_convenio AS codigo_convenio,
	c.contratante_agencia AS agencia_cooperativa,
	c.contratante_agenciaDV AS dv_prefixo,
	c.contratante_conta AS conta_corrente,
	c.contratante_contaDV AS dv_conta_corrente,
	c.cont_nomefantasia AS nome_empresa,
	c.contratante_sequencia AS num_controle_cobranca,
	CAST(DATE_FORMAT(NOW(), '%d%m%Y') AS CHAR) AS data_geracao,
	REPLACE(TIME_FORMAT(NOW(), '%T'), ':', '') AS hora_geracao	
FROM contratante c
WHERE c.usuario_LOGIN = 8001