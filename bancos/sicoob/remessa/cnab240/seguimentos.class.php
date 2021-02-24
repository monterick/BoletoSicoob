<?php

namespace Bancos\Sicoob\Remessa\CNAB240;

class SeguimentoS
{
    /**
     * Gera Seguimento S
     *
     * @param [type] $registro_item
     * @return void
     */
    public static function get($registro_item)
    {

        $banco = 756;
        $lote = 1;
        $tipo_registro = 3;
        //$registro_item
        $seguimento = "S";
        $cnab_1 = "";
        $codigo_movimento = 1;
        $tipo_impressao = 3;
        $informacao5 = "";
        $informacao6 = "";
        $informacao7 = "";
        $informacao8 = "";
        $informacao9 = "";
        $cnab_2 = "";

        $_linha = "";
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($banco, 3, 'Numerico'); #SEQ 01.3S
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($lote, 4, 'Numerico'); #SEQ 02.3S
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($tipo_registro, 1, 'Numerico'); #SEQ 03.3S
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($registro_item, 5, 'Numerico'); #SEQ 04.3S
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($seguimento, 1, 'Alfa Numerico'); #SEQ 05.3S
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($cnab_1, 1, 'Alfa Numerico'); #SEQ 06.3S
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($codigo_movimento, 2, 'Numerico'); #SEQ 07.3S
        # Para tipo de impressão '3'
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($tipo_impressao, 1, 'Numerico'); #SEQ 08.3S
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($informacao5, 40, 'Alfa Numerico'); #SEQ 09.3S
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($informacao6, 40, 'Alfa Numerico'); #SEQ 10.3S
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($informacao7, 40, 'Alfa Numerico'); #SEQ 11.3S
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($informacao8, 40, 'Alfa Numerico'); #SEQ 12.3S
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($informacao9, 40, 'Alfa Numerico'); #SEQ 13.3S
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($cnab_2, 22, 'Alfa Numerico'); #SEQ 14.3S
        return $_linha;
    }
}
