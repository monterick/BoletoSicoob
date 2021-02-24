<?php

namespace Bancos\Sicoob\Remessa\CNAB240;

class SeguimentoQ
{
    /**
     * Gera Seguimento Q
     *
     * @param [type] $registro_item
     * @param [type] $tipo_inscricao_pagador
     * @param [type] $numero_inscricao
     * @param [type] $nome
     * @param [type] $endereco
     * @param [type] $bairro
     * @param [type] $cep
     * @param [type] $sufixo_cep
     * @param [type] $cidade
     * @param [type] $uf
     * @return void
     */
    public static function get(
        $registro_item,
        $tipo_inscricao_pagador,
        $numero_inscricao,
        $nome,
        $endereco,
        $bairro,
        $cep,
        $sufixo_cep,
        $cidade,
        $uf
    ) {
        $banco = 756;
        $lote = 1;
        $tipo_registro = 3;
        //$registro_item
        $segmento = "Q";
        $cnab_1 = "";
        $codigo_movimento = 1;
        //$tipo_inscricao_pagador
        //$numero_inscricao
        //$nome
        //$endereco
        //$bairro
        //$cep
        //$sufixo_cep
        //$cidade
        //$uf
        $tipo_inscricao_sacador = 0;
        $numero_inscricao_sacador = 0;
        $nome_sacador = "";
        $codigo_banco_compensacao = 0;
        $nosso_numero_banco_compensacao = "";
        $cnab_2 = "";

        $_linha = "";
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($banco, 3, 'Numerico'); #SEQ 01.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($lote, 4, 'Numerico'); #SEQ 02.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($tipo_registro, 1, 'Numerico'); #SEQ 03.3Q

        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($registro_item, 5, 'Numerico'); #SEQ 04.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($segmento, 1, 'Alfa Numerico'); #SEQ 05.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($cnab_1, 1, 'Alfa Numerico'); #SEQ 06.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($codigo_movimento, 2, 'Numerico'); #SEQ 07.3Q

        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($tipo_inscricao_pagador, 1, 'Numerico'); #SEQ 08.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($numero_inscricao, 15, 'Numerico'); #SEQ 09.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($nome, 40, 'Alfa Numerico'); #SEQ 10.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($endereco, 40, 'Alfa Numerico'); #SEQ 11.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($bairro, 15, 'Alfa Numerico'); #SEQ 12.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($cep, 5, 'Numerico'); #SEQ 13.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($sufixo_cep, 3, 'Numerico'); #SEQ 14.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($cidade, 15, 'Alfa Numerico'); #SEQ 15.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($uf, 2, 'Alfa Numerico'); #SEQ 16.3Q

        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($tipo_inscricao_sacador, 1, 'Numerico'); #SEQ 17.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($numero_inscricao_sacador, 15, 'Numerico'); #SEQ 18.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($nome_sacador, 40, 'Alfa Numerico'); #SEQ 19.3Q

        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($codigo_banco_compensacao, 3, 'Numerico'); #SEQ 20.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($nosso_numero_banco_compensacao, 20, 'Alfa Numerico'); #SEQ 21.3Q
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($cnab_2, 8, 'Alfa Numerico'); #SEQ 22.3Q
        return $_linha;
    }
}
