<?php

namespace Bancos\Sicoob\Remessa\CNAB240;

class HeaderLote
{

    /**
     * Gera Header Lote
     *
     * @param [integer] $tipo_inscricao
     * @param [integer] $numero_inscricao
     * @param [integer] $agencia_cooperativa
     * @param [string] $dv_prefixo
     * @param [integer] $conta_corrente
     * @param [string] $dv_conta_corrente
     * @param [string] $nome_empresa
     * @param [integer] $num_controle_cobranca
     * @param [integer] $data_geracao
     * @return void
     */
    public static function get(
        $tipo_inscricao,
        $numero_inscricao,
        $agencia_cooperativa,
        $dv_prefixo,
        $conta_corrente,
        $dv_conta_corrente,
        $nome_empresa,
        $num_controle_cobranca,
        $data_geracao
    ) {

        # Parametros
        $banco = 756;
        $lote = 1;
        $tipo_registro = 1;
        $tipo_operacao = "R";
        $tipo_servico = 1;
        $cnab_1 = " ";
        $layout_lote = 40;
        $cnab_2 = " ";
        //$tipo_inscricao
        //$numero_inscricao
        $codigo_convenio = " ";
        //$agencia_cooperativa
        //$dv_prefixo
        //$conta_corrente
        //$dv_conta_corrente
        $dv_ag_conta_corrente = " ";
        //$nome_empresa
        $informacao_1 = " ";
        $informacao_2 = " ";
        //$num_controle_cobranca
        $data_credito = 0;
        $data_gravacao = $data_geracao;
        $cnab_3 = " ";

        # Linha
        $_linha = "";
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($banco, 3, 'Numerico'); #SEQ 01.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($lote, 4, 'Numerico'); #SEQ 02.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($tipo_registro, 1, 'Numerico'); #SEQ 03.1

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($tipo_operacao, 1, 'Alfa Numerico'); #SEQ 04.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($tipo_servico, 2, 'Numerico'); #SEQ 05.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cnab_1, 2, 'Alfa Numerico'); #SEQ 06.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($layout_lote, 3, 'Numerico'); #SEQ 07.1

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cnab_2, 1, 'Alfa Numerico'); #SEQ 08.1

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($tipo_inscricao, 1, 'Numerico'); #SEQ 09.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($numero_inscricao, 15, 'Numerico'); #SEQ 10.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_convenio, 20, 'Alfa Numerico'); #SEQ 11.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($agencia_cooperativa, 5, 'Numerico'); #SEQ 12.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($dv_prefixo, 1, 'Alfa Numerico'); #SEQ 13.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($conta_corrente, 12, 'Numerico'); #SEQ 14.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($dv_conta_corrente, 1, 'Alfa Numerico'); #SEQ 15.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($dv_ag_conta_corrente, 1, 'Alfa Numerico'); #SEQ 16.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($nome_empresa, 30, 'Alfa Numerico'); #SEQ 17.1

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($informacao_1, 40, 'Alfa Numerico'); #SEQ 18.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($informacao_2, 40, 'Alfa Numerico'); #SEQ 19.1

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($num_controle_cobranca, 8, 'Numerico'); #SEQ 20.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($data_gravacao, 8, 0, 'Numerico'); #SEQ 21.1

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($data_credito, 8, 0, 'Numerico'); #SEQ 22.1
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cnab_3, 33, 'Alfa Numerico'); #SEQ 23.1
        return $_linha;
    }
}
