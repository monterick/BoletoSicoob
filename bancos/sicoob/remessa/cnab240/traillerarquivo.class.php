<?php

namespace Bancos\Sicoob\Remessa\CNAB240;

class TraillerArquivo
{

    /**
     * Gera trailler arquivo
     *
     * @param [integer] $qtd_reg_arquivo
     * @return void
     */
    public static function get($qtd_reg_arquivo)
    {
        # Parametros
        $banco = 756;
        $lote = 9999;
        $tipo_registro = 9;
        $qnab_1 = "";
        $quantidade_lotes = 1;
        $quantidade_contas = 0;
        $qnab_2 = "";

        # Linha
        $_linha = "";
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($banco, 3, 'Numerico'); # SEQ 01.9
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($lote, 4, 'Numerico'); #SEQ 02.9
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($tipo_registro, 1, 'Numerico'); #SEQ 03.9
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($qnab_1, 9, 'Alfa Numerico'); #SEQ 04.9
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($quantidade_lotes, 6, 'Numerico'); #SEQ 04.9
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($qtd_reg_arquivo, 6, 'Numerico'); #SEQ 06.9
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($quantidade_contas, 6, 'Numerico'); #SEQ 07.9
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($qnab_2, 205, 'Alfa Numerico'); #SEQ 08.9
        return $_linha;
    }
}
