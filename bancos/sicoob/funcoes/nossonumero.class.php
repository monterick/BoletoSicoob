<?php

namespace Bancos\Sicoob\Funcoes;

class NossoNumero
{

    /**
     * Gera nosso numero sicoob
     *
     * @param [numeric] $numero_titulo
     * @param [numeric] $parcela_unica
     * @param [numeric] $modalidade
     * @return void
     */
    public static function gerarNossoNumero($numero_titulo, $parcela_unica, $modalidade)
    {
        $tipo_formulario = 4;
        $brancos = "";
        $_nosso_numero = "";
        $_nosso_numero .= str_pad($numero_titulo, 10, 0, STR_PAD_LEFT);
        $_nosso_numero .= str_pad($parcela_unica, 2, 0, STR_PAD_LEFT);
        $_nosso_numero .= str_pad($modalidade, 2, 0, STR_PAD_LEFT);
        $_nosso_numero .= str_pad($tipo_formulario, 1, 0, STR_PAD_LEFT);
        $_nosso_numero .= str_pad($brancos, 5, " ", STR_PAD_LEFT);
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
        $cooperativa = \Bancos\Sicoob\Funcoes\Preenchimento::preencher($agencia_cooperativa, 4, 'Numerico'); #07.Pré-homologação
        $codigo_cliente = \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_cliente, 10, 'Numerico'); #07.Pré-homologação
        $nosso_numero = \Bancos\Sicoob\Funcoes\Preenchimento::preencher($nosso_numero, 7, 'Numerico'); #07.Pré-homologação

        $sequencia = $cooperativa . $codigo_cliente . $nosso_numero;
        $constante = 3197;
        $calculo = 0;
        $cont = 0;

        for ($i = 0; $i <= strlen($sequencia); $i++) {
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
            $calculo = $calculo + (substr($sequencia, $i, 1) * $constante);
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
