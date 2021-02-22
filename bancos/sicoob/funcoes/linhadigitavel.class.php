<?php

namespace Bancos\Sicoob\Funcoes;

class LinhaDigitavel
{
    public static $banco = 756;
    public static $moeda = 9;

    public static function gerarLinhaDigitavel(
        $carteira,
        $agencia_cooperativa,
        $modalidade,
        $codigo_cliente,
        $nosso_numero,
        $parcela,
        $fatorVcto,
        $valor_nominal
    ) {

        $_linha = "";
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher(self::$banco, 3, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher(self::$moeda, 1, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($carteira, 1, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($agencia_cooperativa, 4, 'Numerico');
        // digito verificador
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($modalidade, 2, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_cliente, 7, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($nosso_numero, 8, 'Numerico');
        // digitos chamado
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($parcela, 3, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($fatorVcto, 4, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($valor_nominal, 10, 'Numerico');

        return $_linha;
    }

    public static function gerarDvLinhaDigitavel($linhaDigitavel)
    {
        $indice = '2121212120121212121201212121212';
        $teste = '75691434020187155900900011000015874410000001000';











        for ($i = 0; $i < strlen($linhaDigitavel); $i++) {
            # code...
        }




        $digito = 0;
        $soma = 0;
        $mult = 0;
        $contador = 0;

        for ($i = 0; $i < 9; $i++) {
            $mult = (intval($linhaDigitavel[$i])) * (intval($indice[$i]));

            if ($mult >= 10) {
                $soma = $soma + $mult[1] + $mult[2];
            } else {
                $soma = $soma + $mult;
            }
        }

        $digito = $multiplo10($soma) - $soma;

        $linhaDigitavel[10] = $digito[1];
    }
}


$teste = \Bancos\Sicoob\Funcoes\LinhaDigitavel::gerarLinhaDigitavel();
echo $teste;
