SELECT
	COUNT(cp.CartaoPar_id) AS cobranca_simples_quantide_total,
	REPLACE(REPLACE(ROUND(SUM(cp.CartaoPar_valorparcela), 2), '.', ''), ',', '') AS cobranca_simples_valor_total
FROM cartao_parcelas cp            
	INNER JOIN cartao_cliente cc
		ON cc.cartao_clientecpf = cp.CartaoPar_cpf
	INNER JOIN contratante c
		ON c.usuario_LOGIN = cc.cartao_clientecontratante
			AND c.usuario_LOGIN = cp.CartaoPar_login
	INNER JOIN bancos b
		ON b.codigo_banco = c.contratante_banco    
WHERE cp.CartaoPar_login = 8001
	-- AND cp.CartaoPar_Remessa = 0
	-- AND cp.CartaoPar_Remessa = CURRENT_DATE        
ORDER BY
	cp.CartaoPar_consulta,
	cp.CartaoPar_parcela