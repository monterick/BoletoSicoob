   /*
	( -- subselect para verificar se a compra teve apenas uma parcela
       SELECT CASE WHEN MAX(cp2.CartaoPar_parcela) = 1 THEN 1 ELSE 0 END
       FROM cartao_parcelas cp2
           INNER JOIN cartao_cliente cc2
               ON cc2.cartao_clientecpf = cp2.CartaoPar_cpf
           INNER JOIN contratante c2
               ON c2.usuario_LOGIN = cc2.cartao_clientecontratante
                   AND c2.usuario_LOGIN = cp2.CartaoPar_login
           INNER JOIN bancos b2
               ON b2.codigo_banco = c2.contratante_banco		
       WHERE cp2.CartaoPar_login = cp.CartaoPar_login
           AND cp2.CartaoPar_consulta = cp.CartaoPar_consulta
   ) AS parcela_unica
	*/