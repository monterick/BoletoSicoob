<?php

namespace Bancos\Sicoob\Funcoes;

class LinhaDigitavel
{
    # Grupo 01
    public static $banco = 756;
    public static $moeda = 9;
    public static $carteira = 1;
    public static $agencia_cooperaiva = 4340;
    public static $modalidade = 01;
    public static $codigo_cliente = 9;
    public static $nosso_numero = 9;
    public static $nosso_numero_dv = 9;
    public static $parcela = 9;
    public static $fator_vcto = 9;
    public static $valor = 9;









    public static function gerarLinhaDigitavel($carteira, $agencia_cooperativa, $modalidade, $codigo_cliente)
    {


        $_linha = "";

        //-----GRUPO 01-----
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher(self::$banco, 3, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher(self::$moeda, 3, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($carteira, 3, 'Numerico');
        $_linha .= '.';
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($agencia_cooperativa, 3, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\LinhaDigitavel::gerarDvLinhaDigitavel(1);
        //-----GRUPO 02-----
        $_linha .= ' ';
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($modalidade, 2, 'Numerico');
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_cliente, 3, 'Numerico');




        return $_linha;
    }

    public static function gerarDvLinhaDigitavel($grupo)
    {
        $dv = 0;

        switch ($grupo) {
            case 1:
                # code...
                break;

            case 2:
                #code
                break;

            case 3:
                #code
                break;


            default:
                # code...
                break;
        }

        return $dv;
    }
}


$teste = \Bancos\Sicoob\Funcoes\LinhaDigitavel::gerarLinhaDigitavel();
echo $teste;
