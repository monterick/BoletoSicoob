<?php

namespace Bancos\Sicoob\Boleto;

class CodigoBarras
{
    public static function gerarCodigoBarras(
        $banco,
        $moeda,
        $data_vencimento,
        $valor_nominal,
        $carteira,
        $agencia_cooperativa,
        $modalidade,
        $cliente,
        $nosso_numero,
        $parcela
    ) {

        $_codigo_barras = "";
        $_codigo_barras .= \Bancos\Sicoob\Util\Preenchimento::preencher($banco, 3, 'Numerico');
        $_codigo_barras .= \Bancos\Sicoob\Util\Preenchimento::preencher($moeda, 1, 'Numerico');
        #digito verificador
        $_codigo_barras .= \Bancos\Sicoob\Util\Preenchimento::preencher(
            \Bancos\Sicoob\Util\FatorData::getFatorVcto($data_vencimento),
            4,
            'Numerico'
        );
        $_codigo_barras .= \Bancos\Sicoob\Util\Preenchimento::preencher($valor_nominal, 10, 'Numerico');
        $_codigo_barras .= \Bancos\Sicoob\Util\Preenchimento::preencher($carteira, 1, 'Numerico');
        $_codigo_barras .= \Bancos\Sicoob\Util\Preenchimento::preencher($agencia_cooperativa, 4, 'Numerico');
        $_codigo_barras .= \Bancos\Sicoob\Util\Preenchimento::preencher($modalidade, 2, 'Numerico');
        $_codigo_barras .= \Bancos\Sicoob\Util\Preenchimento::preencher($cliente, 7, 'Numerico');
        $_codigo_barras .= \Bancos\Sicoob\Util\Preenchimento::preencher($nosso_numero, 8, 'Numerico');
        $_codigo_barras .= \Bancos\Sicoob\Util\Preenchimento::preencher($parcela, 3, 'Numerico');
        return $_codigo_barras;
    }


    public static function gerarDvCodigoBarras($sequencia)
    {

        $calculo = 0;
        $indice = 0;
        $cont = 0;
        for ($i = strlen($sequencia); $i > 0; $i--) {
            $cont++;
            switch ($cont) {
                case 1:
                    $indice = 2;
                    break;
                case 2:
                    $indice = 3;
                    break;
                case 3:
                    $indice = 4;
                    break;
                case 4:
                    $indice = 5;
                    break;
                case 5:
                    $indice = 6;
                    break;
                case 6:
                    $indice = 7;
                    break;
                case 7:
                    $indice = 8;
                    break;
                case 8:
                    $indice = 9;
                    $cont = 0;
                    break;
            }
            $calculo = $calculo + (substr($sequencia, $i, -1) * $indice);
        }

        $resto = $calculo % 11;
        switch ($resto) {
            case 0:
                $digito_verificador = 1;
                break;
            case 1:
                $digito_verificador = 1;
                break;
            case $resto > 9:
                $digito_verificador = 1;
                break;
            default:
                $digito_verificador = 11 - $resto;
                break;
        }
        return $digito_verificador;
    }
}
