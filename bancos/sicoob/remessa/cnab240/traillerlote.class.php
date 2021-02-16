<?php

namespace Bancos\Sicoob\Remessa\CNAB240;

class TraillerLote
{

    /**
     * Gera trailler lote
     *
     * @param [integer] $qtd_reg_lote
     * @param [integer] $cob_simples_qtd_total
     * @param [numeric] $cob_simples_vlr_total
     * @return void
     */
    public static function get($qtd_reg_lote, $cob_simples_qtd_total, $cob_simples_vlr_total)
    {
        # Paramentros
        $banco = 756;
        $lote = 1;
        $tipo_registro = 5;

        $cnab_1  = "";

        $cob_vinculada_qtd_total = 0;
        $cob_vinculada_total = 0;

        $cob_caucionada_qtd_total = 0;
        $cob_caucionada_total = 0;

        $cob_descontada_qtd_total = 0;
        $cob_descontada_total = 0;

        $numero_aviso = "";

        $cnab_2 = "";

        # Linha
        $_linha = "";
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($banco, 3, 'Numerico'); #SEQ 01.5
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($lote, 4, 'Numerico'); #SEQ 02.5
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($tipo_registro, 1, 'Numerico'); #SEQ 03.5

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cnab_1, 9, 'Alfa Numerico'); #SEQ 04.5

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($qtd_reg_lote, 6, 'Numerico'); #SEQ 05.5

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cob_simples_qtd_total, 6, 'Numerico'); #SEQ 06.5
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cob_simples_vlr_total, 15, 'Numerico'); #SEQ 07.5

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cob_vinculada_qtd_total, 6, 'Numerico'); #SEQ 08.5
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cob_vinculada_total, 15, 'Numerico'); #SEQ 09.5

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cob_caucionada_qtd_total, 6, 'Numerico'); #SEQ 10.5
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cob_caucionada_total, 15, 'Numerico'); #SEQ 11.5

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cob_descontada_qtd_total, 6, 'Numerico'); #SEQ 12.5
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cob_descontada_total, 15, 'Numerico'); #SEQ 13.5

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($numero_aviso, 8, 'Alfa Numerico'); #SEQ 14.5

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cnab_2, 117, 'Alfa Numerico'); #SEQ 15.5

        return $_linha;
    }
}
