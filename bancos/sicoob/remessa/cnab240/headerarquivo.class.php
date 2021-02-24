<?php

namespace Bancos\Sicoob\Remessa\CNAB240;

class HeaderArquivo
{

    /**
     * Gera Header Arquivo
     *
     * @param [type] $tipo_inscricao
     * @param [type] $numero_inscricao
     * @param [type] $codigo_convenio
     * @param [type] $agencia_cooperativa
     * @param [type] $dv_prefixo
     * @param [type] $conta_corrente
     * @param [type] $dv_conta_corrente
     * @param [type] $nome_empresa
     * @param [type] $data_geracao
     * @param [type] $hora_geracao
     * @return void
     */
    public static function get(
        $tipo_inscricao,
        $numero_inscricao,
        $codigo_convenio,
        $agencia_cooperativa,
        $dv_prefixo,
        $conta_corrente,
        $dv_conta_corrente,
        $nome_empresa,
        $data_geracao,
        $hora_geracao
    ) {

        # Parametros
        $banco = 756;
        $lote = 0000;
        $tipo_registro = 0;
        $cnab_1 = " ";
        //$tipo_inscricao
        //$numero_inscricao
        //$codigo_convenio
        //$agencia_cooperativa
        //$dv_prefixo
        //$conta_corrente
        //$dv_conta_corrente
        $dv_ag_conta_corrente = "0";
        //$nome_empresa
        $nome_banco = "SICOOB";
        $cnab_2 = " ";
        $arquivo_codigo = 1;
        //$data_geracao
        //$hora_geracao
        $sequencial = 1;
        $layout_arquivo = 81;
        $densidade = 00000;
        $reservado_banco = " ";
        $reservado_empresa = " ";
        $cnab_3 = " ";

        # Linha
        $_linha = "";
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($banco, 3, 'Numerico'); #SEQ 01.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($lote, 4, 'Numerico'); #SEQ 02.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($tipo_registro, 1, 'Numerico'); #SEQ 03.0

        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($cnab_1, 9, 'Alfa Numerico'); #SEQ 04.0

        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($tipo_inscricao, 1, 'Numerico'); #SEQ 05.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($numero_inscricao, 14, 'Numerico'); #SEQ 06.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($codigo_convenio, 20, 'Alfa Numerico'); #SEQ 07.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($agencia_cooperativa, 5, 'Numerico'); #SEQ 08.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($dv_prefixo, 1, 'Alfa Numerico'); #SEQ 09.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($conta_corrente, 12, 'Numerico'); #SEQ 10.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($dv_conta_corrente, 1, 'Alfa Numerico'); #SEQ 11.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($dv_ag_conta_corrente, 1, 'Alfa Numerico'); #SEQ 12.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($nome_empresa, 30, 'Alfa Numerico'); #SEQ 13.0

        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($nome_banco, 30, 'Alfa Numerico'); #SEQ 14.0

        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($cnab_2, 10, 'Alfa Numerico'); #SEQ 15.0

        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($arquivo_codigo, 1, 'Numerico'); #SEQ 16.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($data_geracao, 8, 'Numerico'); #SEQ 17.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($hora_geracao, 6, 'Numerico'); #SEQ 18.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($sequencial, 6, 'Numerico'); #SEQ 19.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($layout_arquivo, 3, 'Numerico'); #SEQ 20.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($densidade, 5, 'Numerico'); #SEQ 21.0

        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($reservado_banco, 20, 'Alfa Numerico'); #SEQ 22.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($reservado_empresa, 20, 'Alfa Numerico'); #SEQ 23.0
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($cnab_3, 29, 'Alfa Numerico'); #SEQ 24.0
        return $_linha;
    }
}
