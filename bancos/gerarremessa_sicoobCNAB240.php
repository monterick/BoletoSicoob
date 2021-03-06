<?php

include('../../conexao.php');
require '../../../config.inc.php';
require FILE_BASE_API . '/autoload/autoload.inc.php';

    $login = $_GET['codigo'];
    $parametros = array();
    $pdo = Database\MySQL::creditall();

    ############################ Header ############################
    $stm = $pdo->prepare(
        "SELECT
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
    WHERE c.usuario_LOGIN = ?"
    );
    $stm->bindParam(1, $login, PDO::PARAM_INT);
    $stm->execute();
    $parametros['header'] = $stm->fetchAll(PDO::FETCH_ASSOC);

    ############################ Boletos ############################
    $stm = $pdo->prepare(
        "SELECT
        cp.CartaoPar_id,
        c.usuario_LOGIN AS login,   
         --	contratante / cedente --
        c.contratante_agencia AS agencia_cooperativa,
        c.contratante_agenciaDV AS dv_prefixo,
        c.contratante_conta AS conta_corrente,
        c.contratante_contaDV AS dv_conta_corrente,
        c.contratante_carteira AS carteira,   
         c.contratante_cooperado AS codigo_cliente,
         CASE WHEN c.contratante_comando = '     ' THEN 1 ELSE 3 END AS modalidade,    
         -- cliente / pagador --
        CASE WHEN CHAR_LENGTH(cp.CartaoPar_cpf) > 14 THEN '2' ELSE '1' END AS tipo_inscricao_pagador,
        REPLACE(REPLACE(REPLACE(cp.CartaoPar_cpf, '.', ''), '-', ''), '/', '') AS numero_inscricao,
        cc.cartao_clientenome AS nome,
        CONCAT(cc.cartao_clienteendereco, ' ', cc.cartao_clientenumero, ' ', cc.cartao_clientecomplemento) AS endereco,
        cc.cartao_clientebairro AS bairro,
        REPLACE(SUBSTRING(cc.cartao_clientecep, 1, (LOCATE('-', cc.cartao_clientecep) - 1)), '.', '') AS cep,
        SUBSTRING(cc.cartao_clientecep, (LOCATE('-', cc.cartao_clientecep) + 1), 3) AS sufixo_cep,
        cc.cartao_clientecidade AS cidade,
        cc.cartao_clienteuf AS uf,   
         --	cobran??a / boleto --
        c.contratante_sequencia AS numero_titulo,
         cp.CartaoPar_parcela AS numero_parcela,
        CONCAT(cp.CartaoPar_consulta, cp.CartaoPar_parcela) AS numero_documento,	
        CAST(DATE_FORMAT(cp.CartaoPar_datavencimento,'%d%m%Y') AS CHAR) AS data_vencimento,
        REPLACE(REPLACE(ROUND(cp.CartaoPar_valorparcela, 2), '.',''), ',','') AS valor_nominal,
        CAST(DATE_FORMAT(cp.CartaoPar_datacadastro,'%d%m%Y') AS CHAR) AS data_emissao,	 
         --	juros
        CASE WHEN c.contratante_juroboleto > 0 THEN '1' ELSE '0' END AS cod_juros_mora,
        CAST(DATE_FORMAT(cp.CartaoPar_datavencimento,'%d%m%Y') AS CHAR) AS data_juros_mora,
        REPLACE(REPLACE(ROUND(cp.CartaoPar_valorparcela * (c.contratante_juroboleto/30), 2), '.', ''), ',', '') AS valor_juros_mora,
         -- multa
        CASE WHEN c.contratante_txboleto > 0 THEN '1' ELSE '0' END AS codigo_multa,
        CAST(DATE_FORMAT(cp.CartaoPar_datavencimento,'%d%m%Y') AS CHAR) AS data_multa,
        REPLACE(REPLACE(ROUND(cp.CartaoPar_valorparcela * c.contratante_txboleto / 100, 2), '.', ''), ',', '') AS valor_multa,
         (SELECT '')	AS nosso_numero,
        (SELECT '')	AS linha_digitavel,
        (SELECT '')	AS codigo_barras       
     FROM cartao_parcelas cp
        INNER JOIN cartao_cliente cc
            ON cc.cartao_clientecpf = cp.CartaoPar_cpf
        INNER JOIN contratante c
            ON c.usuario_LOGIN = cc.cartao_clientecontratante
                AND c.usuario_LOGIN = cp.CartaoPar_login	
        INNER JOIN bancos b
            ON b.codigo_banco = c.contratante_banco       
     WHERE cp.CartaoPar_login = ?
        -- AND cp.CartaoPar_Remessa = 0
        -- AND cp.CartaoPar_Remessa = CURRENT_DATE   
     ORDER BY
        cp.CartaoPar_consulta,
        cp.CartaoPar_parcela LIMIT 1"
    );
    $stm->bindParam(1, $login, PDO::PARAM_INT);
    $stm->execute();
    $parametros['boletos'] = $stm->fetchAll(PDO::FETCH_ASSOC);

    ############################ Trailer ############################
    $stm = $pdo->prepare(
        "SELECT
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
        cp.CartaoPar_parcela"
    );
    $stm->bindParam(1, $login, PDO::PARAM_INT);
    $stm->execute();
    $parametros['trailler'] = $stm->fetchAll(PDO::FETCH_ASSOC);

    $_arquivo_remessa = \Bancos\Sicoob\Remessa\CNAB240\Arquivo::gerarRemessa($parametros);

    $_nosso_numero = \Bancos\Sicoob\Boleto\Boleto::adicionarCodigoBarras($parametros);
    $_linha_digitavel = \Bancos\Sicoob\Boleto\Boleto::adicionarLinhaDigitavel($parametros);
    $_codigo_barras = \Bancos\Sicoob\Boleto\Boleto::adicionarNossoNumero($parametros);

    echo $_nosso_numero . "\r\n" . $_linha_digitavel . $_codigo_barras;


    //var_dump($_arquivo_remessa);



    $diretorio = "/var/www/html/siscredit/siscred/operacional/arquivos/" . $login . "/";
    $nome_arquivo = "remessa_" . date('dmY') . ".rem";
    $caminho = $diretorio . $nome_arquivo;

    file_put_contents($caminho, $_arquivo_remessa);
