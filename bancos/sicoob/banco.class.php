<?php

namespace Bancos\Sicoob\Remessa\CNAB240;

class Banco
{
    public static $banco = 756;
    public static $moeda = 9;

    public static function getLinhaDigitavel(array $parametros)
    {
        $boletos['nosso_numero'] = \Bancos\Sicoob\Funcoes\NossoNumero::gerarNossoNumero(
            $boletos['numero_titulo'],
            $boletos['parcela_unica'],
            $boletos['modalidade']
        );
        $boletos['nosso_numero'] .= \Bancos\Sicoob\Funcoes\NossoNumero::gerarNossoNumeroDv(
            $boletos['agencia_cooperativa'],
            $boletos['codigo_cliente'],
            $boletos['nosso_numero']
        );

        foreach ($parametros['boletos'] as $key => $boeltos) {
            $linha = \Bancos\Sicoob\Funcoes\LinhaDigitavel::gerarLinhaDigitavel(
                $boeltos['carteira'],
                $boeltos['agencia_cooperativa'],
                $boeltos['modalidade'],
                $boeltos['codigo_cliente'],
                $boletos['nosso_numero'],
                $boeltos[''],
                $boeltos[''],
                $boeltos[''],
                $boeltos['']
            )
        }







        $_linha = \Bancos\Sicoob\Funcoes\LinhaDigitavel::gerarLinhaDigitavel(
            self::$banco,
            self::$moeda,
            $parametros['boletos'][0]['carteira'],
            $agencia_cooperativa,
            $modalidade,
            $codigo_cliente,
            $nosso_numero,
            $parcela,
            $fatorVcto,
            $valor_nominal
        );





        $_linha = \Bancos\Sicoob\Funcoes\LinhaDigitavel::gerarDvLinhaDigitavel();

        return $_linha;
    }
}
