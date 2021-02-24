<?php

namespace Bancos\Sicoob\Boleto;

class Boleto
{
    public static $banco = 756;
    public static $moeda = 9;

    /**
     * Adiciona a linha digitavel com os digitos verificadores aos boletos
     *
     * @param array $parametros
     * @return void
     */
    public static function adicionarLinhaDigitavel(array $parametros)
    {
        foreach ($parametros['boletos'] as $key => $boletos) {
            // gerando o nosso numero com o digito verificador e adicionando a variavel $boletos
            $boletos['nosso_numero'] = \Bancos\Sicoob\Util\NossoNumero::gerarNossoNumero(
                $boletos['numero_titulo'],
                $boletos['parcela_unica'],
                $boletos['modalidade']
            );
            $boletos['nosso_numero'] .= \Bancos\Sicoob\Util\NossoNumero::gerarNossoNumeroDv(
                $boletos['agencia_cooperativa'],
                $boletos['codigo_cliente'],
                $boletos['nosso_numero']
            );

            // gerando a linha digitavel com os digitos verificadores exeto o digito do codigo de barras
            $_linha = \Bancos\Sicoob\Boleto\LinhaDigitavel::gerarLinhaDigitavel(
                self::$banco,
                self::$moeda,
                $boletos['carteira'],
                $boletos['agencia_cooperativa'],
                $boletos['modalidade'],
                $boletos['codigo_cliente'],
                $boletos['nosso_numero'],
                $boletos['numero_parcela'],
                $boletos['data_vencimento'],
                $boletos['valor_nominal']
            );

            // adicionando digito verificador do codigo de barras
            $_linha .= \Bancos\Sicoob\Boleto\CodigoBarras::gerarDvCodigoBarras();

            // adicionando Fator de vencimento a linha digitavel
            $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher(
                \Bancos\Sicoob\Util\FatorData::getFatorVcto($boletos['data_vencimento']),
                4,
                'Numerico'
            );

            // adicionando valor do boleto a linha digitavel
            $_linha .= \Bancos\Sicoob\Util\Preenchimento::preencher(
                \Bancos\Sicoob\Util\FatorData::getFatorVcto($boletos['valor_nominal']),
                10,
                'Numerico'
            );

            $boletos['linha_digitavel'] = $_linha;
        }
        return $parametros;
    }

    public static function adicionarCodigoBarras(array $parametros)
    {
        foreach ($parametros['boletos'] as $key => $boletos) {
            // gerando o nosso numero com o digito verificador e adicionando a variavel $boletos
            $boletos['nosso_numero'] = \Bancos\Sicoob\Util\NossoNumero::gerarNossoNumero(
                $boletos['numero_titulo'],
                $boletos['parcela_unica'],
                $boletos['modalidade']
            );
            $boletos['nosso_numero'] .= \Bancos\Sicoob\Util\NossoNumero::gerarNossoNumeroDv(
                $boletos['agencia_cooperativa'],
                $boletos['codigo_cliente'],
                $boletos['nosso_numero']
            );

            $_codigo_barras = \Bancos\Sicoob\Boleto\CodigoBarras::gerarCodigoBarras(
                self::$banco,
                self::$moeda,
                $boletos['data_vencimento'],
                $boletos['valor_nominal'],
                $boletos['carteira'],
                $boletos['agencia_cooperativa'],
                $boletos['modalidade'],
                $boletos['cliente'],
                $boletos['nosso_numero'],
                $boletos['parcela']
            );
            $_codigo_barras = \Bancos\Sicoob\Util\Preenchimento::inserirNaPosicao(
                $_codigo_barras,
                5,
                \Bancos\Sicoob\Boleto\CodigoBarras::gerarDvCodigoBarras($_codigo_barras)
            );

            $boletos['codigo_barras'] = $_codigo_barras;
        }

        return $parametros;
    }
}
