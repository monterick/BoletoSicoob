<?php

namespace Bancos\Sicoob\Boleto;

class LinhaDigitavel
{

    public static function gerarLinhaDigitavel(
        $banco,
        $moeda,
        $carteira,
        $agencia_cooperativa,
        $modalidade,
        $codigo_cliente,
        $nosso_numero,
        $numero_parcela,
        $data_vencimento,
        $valor_nominal
    ) {
        $_linha = "";
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($banco, 3, 'Numerico');
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($moeda, 1, 'Numerico');
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($carteira, 1, 'Numerico');
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($agencia_cooperativa, 4, 'Numerico');
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($modalidade, 2, 'Numerico');
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($codigo_cliente, 7, 'Numerico');
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($nosso_numero, 8, 'Numerico');
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($numero_parcela, 3, 'Numerico');

        $_linha = \Bancos\Sicoob\Boleto\LinhaDigitavel::gerarDvLinhaDigitavel($_linha);

        $_linha .= \Bancos\Sicoob\Boleto\CodigoBarras::gerarDvCodigoBarras($_linha);
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher(
            \Bancos\Sicoob\Util\FatorData::getFatorVcto($data_vencimento),
            4,
            'Numerico'
        );
        $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher($valor_nominal, 10, 'Numerico');
        return $_linha;
    }



    public static function gerarDvLinhaDigitavel($linha_digitavel)
    {
        $indice = 2;
        $grupo_1 = substr($linha_digitavel, 0, 9);
        $grupo_2 = substr($linha_digitavel, 10, 10);
        $grupo_3 = substr($linha_digitavel, 21, 10);
        $dv_grupo_1 = 0;
        $dv_grupo_2 = 0;
        $dv_grupo_3 = 0;

        //$linha_digitavel = '756914340201871559009000110000158'; //74410000001000

        # Grupo 1 #
        for ($i = strlen($grupo_1); $i > 0; $i--) {
            $linha[$i] = substr($grupo_1, $i - 1, 1);

            $temp = $linha[$i] * $indice;

            while ($temp > 9) {
                $temp = substr($temp, 0, 1) + substr($temp, 1, 1);
            }

            $temp += $temp;

            if ($indice == 2) {
                $indice = 1;
            } else {
                $indice = 2;
            }
        }
        $dv_grupo_1 = \Bancos\Sicoob\Util\Multiplo::getMultiplo10($temp) - $temp;

        # Grupo 2 #
        for ($i = strlen($grupo_2); $i > 0; $i--) {
            $linha[$i] = substr($grupo_2, $i - 1, 1);

            $temp = $linha[$i] * $indice;

            while ($temp > 9) {
                $temp = substr($temp, 0, 1) + substr($temp, 1, 1);
            }

            $temp += $temp;

            if ($indice == 2) {
                $indice = 1;
            } else {
                $indice = 2;
            }
        }
        $dv_grupo_2 = \Bancos\Sicoob\Util\Multiplo::getMultiplo10($temp) - $temp;

        # Grupo 3 #
        for ($i = strlen($grupo_3); $i > 0; $i--) {
            $linha[$i] = substr($grupo_3, $i - 1, 1);

            $temp = $linha[$i] * $indice;

            while ($temp > 9) {
                $temp = substr($temp, 0, 1) + substr($temp, 1, 1);
            }

            $temp += $temp;

            if ($indice == 2) {
                $indice = 1;
            } else {
                $indice = 2;
            }
        }
        $dv_grupo_3 = \Bancos\Sicoob\Util\Multiplo::getMultiplo10($temp) - $temp;

        $linha_digitavel = \Bancos\Sicoob\Util\Preenchimento::inserirNaPosicao($linha_digitavel, 10, $dv_grupo_1);
        $linha_digitavel = \Bancos\Sicoob\Util\Preenchimento::inserirNaPosicao($linha_digitavel, 21, $dv_grupo_2);
        $linha_digitavel = \Bancos\Sicoob\Util\Preenchimento::inserirNaPosicao($linha_digitavel, 32, $dv_grupo_3);

        return $linha_digitavel;
    }
}
