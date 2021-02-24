<?php

namespace Bancos\Sicoob\Util;

class NossoNumero
{
    public static $tipo_formulario = 4;
    public static $brancos = "";

    /**
     * Gera nosso numero sicoob
     *
     * @param [numeric] $numero_titulo
     * @param [numeric] $numero_parcela
     * @param [numeric] $modalidade
     * @return void
     */
    public static function gerarNossoNumero($numero_titulo, $numero_parcela, $modalidade)
    {
        $_nosso_numero = "";
        $_nosso_numero .= \Bancos\Sicoob\Util\Preenchimento::preencher($numero_titulo, 10, 'Numerico');
        $_nosso_numero .= \Bancos\Sicoob\Util\Preenchimento::preencher($numero_parcela, 2, 'Numerico');
        $_nosso_numero .= \Bancos\Sicoob\Util\Preenchimento::preencher($modalidade, 2, 'Numerico');
        $_nosso_numero .= \Bancos\Sicoob\Util\Preenchimento::preencher(self::$tipo_formulario, 1, 'Numerico');
        $_nosso_numero .= \Bancos\Sicoob\Util\Preenchimento::preencher(self::$brancos, 5, 'Numerico');
        return $_nosso_numero;
    }

    /**
     * Gera digito verificador do "nosso numero"
     *
     * @param [numeric] $agencia_cooperativa
     * @param [numeric] $codigo_cliente
     * @param [alfanumeric] $nosso_numero
     * @return void
     */
    public static function gerarNossoNumeroDv($agencia_cooperativa, $codigo_cliente, $nosso_numero)
    {
        $digito_verificador = 0;

        //contratante_cooperado
        $cooperativa = \Bancos\Sicoob\Util\Preenchimento::preencher($agencia_cooperativa, 4, 'Numerico');
        $codigo_cliente = \Bancos\Sicoob\Util\Preenchimento::preencher($codigo_cliente, 10, 'Numerico');
        $nosso_numero = \Bancos\Sicoob\Util\Preenchimento::preencher($nosso_numero, 7, 'Numerico');

        $sequencia = $cooperativa . $codigo_cliente . $nosso_numero;
        $constante = 3197;
        $calculo = 0;
        $cont = 0;

        for ($i = strlen($sequencia); $i > 0; $i--) {
            $cont++;
            switch ($cont) {
                case 1:
                    $constante = 3;
                    break;
                case 2:
                    $constante = 1;
                    break;
                case 3:
                    $constante = 9;
                    break;
                case 4:
                    $constante = 7;
                    $cont = 0;
                    break;
            }
            $calculo = $calculo + (substr($sequencia, $i, -1) * $constante);
        }

        $resto = $calculo % 11;
        switch ($resto) {
            case 0:
                $digito_verificador = 0;
                break;
            case 1:
                $digito_verificador = 0;
                break;
            default:
                $digito_verificador = 11 - $resto;
                break;
        }
        return $digito_verificador;
    }
}
