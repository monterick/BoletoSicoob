<?php

namespace Bancos\Sicoob\Funcoes;

class LinhaDigitavel
{
    # Grupo 01
    public static $banco = 756;
    public static $moeda = 9;
    public static $carteira = 1;
    public static $agencia_cooperativa = 4340;




    public static function gerarLinhaDigitavel($carteira, $agencia_cooperativa)
    {





        $_linha = "";

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher(self::$banco, 3, 'Numerico');

        return $_linha;
    }

    public static function gerarLinhaDigitavelDv()
    {
    }
}


$teste = \Bancos\Sicoob\Funcoes\LinhaDigitavel::gerarLinhaDigitavel();
echo $teste;
