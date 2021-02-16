<?php

namespace Bancos\Sicoob\Remessa\CNAB240;

class SeguimentoR
{
    /**
     * Gera Seguimento R
     *
     * @param [integer] $registro_item
     * @param [string] $codigo_multa
     * @param [string] $data_multa
     * @param [numeric] $valor_multa
     * @return void
     */
    public static function get(
        $registro_item,
        $codigo_multa,
        $data_multa,
        $valor_multa
    ) {
        $banco = 756;
        $lote = 1;
        $tipo_registro = 3;
        //$registro_item
        $seguimento = "R";
        $cnab_1 = "";
        $codigo_movimento = 1;
        $codigo_desconto_2 = 0;
        $data_desconto_2 = 0;
        $valor_desconto_2 = 0;
        $codigo_desconto_3 = 0;
        $data_desconto_3 = 0;
        $valor_desconto_3 = 0;
        //$codigo_multa
        //$data_multa
        //$valor_multa
        $informacao_pagador = "";
        $informacao_3 = "";
        $informacao_4 = "";
        $cnab_2 = "";
        $cod_ocorrencia_pagador = 0;
        $debito_banco = 0;
        $debito_agencia = 0;
        $debito_agencia_dv = "";
        $debito_conta_corrente = 0;
        $debito_conta_corrente_dv = "";
        $debito_dv_ag_conta_corrente = "";
        $emissao_aviso_debito = 0;
        $cnab_3 = "";

        $_linha = "";
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($banco, 3, 'Numerico'); #SEQ 01.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($lote, 4, 'Numerico'); #SEQ 02.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($tipo_registro, 1, 'Numerico'); #SEQ 03.3R

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($registro_item, 5, 'Numerico'); #SEQ 04.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($seguimento, 1, 'Alfa Numerico'); #SEQ 05.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cnab_1, 1, 'Alfa Numerico'); #SEQ 06.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_movimento, 2, 'Numerico'); #SEQ 07.3R

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_desconto_2, 1, 'Numerico'); #SEQ 08.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($data_desconto_2, 8, 'Numerico'); #SEQ 09.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($valor_desconto_2, 13, 'Numerico'); #SEQ 10.3R

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_desconto_3, 1, 'Numerico'); #SEQ 11.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($data_desconto_3, 8, 'Numerico'); #SEQ 12.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($valor_desconto_3, 13, 'Numerico'); #SEQ 13.3R

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_multa, 1, 'Alfa Numerico'); #SEQ 14.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($data_multa, 8, 'Numerico'); #SEQ 15.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($valor_multa, 13, 'Numerico'); #SEQ 16.3R

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($informacao_pagador, 10, 'Alfa Numerico'); #SEQ 17.3R

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($informacao_3, 40, 'Alfa Numerico'); #SEQ 18.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($informacao_4, 40, 'Alfa Numerico'); #SEQ 19.3R

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cnab_2, 20, 'Alfa Numerico'); #SEQ 20.3R

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cod_ocorrencia_pagador, 8, 'Numerico'); #SEQ 21.3R

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($debito_banco, 3, 'Numerico'); #SEQ 22.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($debito_agencia, 5, 'Numerico'); #SEQ 23.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($debito_agencia_dv, 1, 'Alfa Numerico'); #SEQ 24.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($debito_conta_corrente, 12, 'Numerico'); #SEQ 25.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($debito_conta_corrente_dv, 1, 'Alfa Numerico'); #SEQ 26.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($debito_dv_ag_conta_corrente, 1, 'Alfa Numerico'); #SEQ 27.3R

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($emissao_aviso_debito, 1, 'Numerico'); #SEQ 28.3R
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cnab_3, 9, 'Alfa Numerico'); #SEQ 29.3R
        # preenchimento de espaçõs faltantes
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher(
            " ",
            6,
            'Alfa Numerico'
        ); #SEQ 30.3R
        return $_linha;
    }
}
