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
        $numero_parcela
    ) {

        $_linha = "";
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($banco, 3, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($moeda, 1, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($carteira, 1, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($agencia_cooperativa, 4, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($modalidade, 2, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_cliente, 7, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($nosso_numero, 8, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($numero_parcela, 3, 'Numerico');
        return $_linha;
    }

    public static function gerarDvLinhaDigitavel($linha_digitavel, $modulo)
    {
        $dv = 0;
        $indice = 2;

        switch ($modulo) {
            case 1:
                for ($i = strlen($linha_digitavel); $i > 0; $i--) {
                    $linha[$i] = substr($linha_digitavel, $i - 1, 1);

                    $temp = $linha[$i] * $indice;

                    if ($temp > 9) {
                        $temp = substr($temp, 0, 1) + substr($temp, 1, 1)
                    };

                    $dv += $temp;

                    if ($indice == 2) {
                        $indice = 1;
                    } else {
                        $indice = 2;
                    }
                }







                break;











            case 2:
                # code...
                break;

            case 2:
                # code...
                break;

            default:
                # code...
                break;
        }












        $digito = 0;
        $soma = 0;
        $mult = 0;
        $indice = "";
        for ($i = 0; $i < strlen($linha_digitavel); $i++) {
            if ($i % 2 == 0) {
                $indice .= 2;
            } else {
                $indice .= 1;
            }
        }

        $soma = 0;
        $mult = 0;
        $digito = 0;
        for ($i = 1; $i <= 9; $i++) {
            $mult = $linhaDigitavel[$i] * $indice[$i];
            if ($mult >= 10) {
                $soma = $soma + $mult[1] + $mult[2];
            } else {
                $soma += $mult;
            }
        }

        $multiplo10 = \Bancos\Sicoob\Funcoes\Multiplo::getMultiplo10($soma);
        $digito = $multiplo10 - $soma;
        $linhaDigitavel[10] = $digito[1];

        echo $linhaDigitavel;









        $indice = '2121212120121212121201212121212';
        $soma = 0;
        for ($i = 0; $i <= strlen($_linha); $i++) {
        }

        $_linha;


        $soma = 0;
    }
}
