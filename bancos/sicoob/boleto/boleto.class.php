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

            // gerando a linha digitavel sem os digitos verificadores
            $_linha = \Bancos\Sicoob\Boleto\LinhaDigitavel::gerarLinhaDigitavel(
                self::$banco,
                self::$moeda,
                $boletos['carteira'],
                $boletos['agencia_cooperativa'],
                $boletos['modalidade'],
                $boletos['codigo_cliente'],
                $boletos['nosso_numero'],
                $boletos['numero_parcela']
            );

            // gerando digito verificador por grupo e adicionando a linha
            $dv_grupo_1 = \Bancos\Sicoob\Boleto\LinhaDigitavel::gerarDvLinhaDigitavel($_linha, 1);
            $dv_grupo_2 = \Bancos\Sicoob\Boleto\LinhaDigitavel::gerarDvLinhaDigitavel($_linha, 2);
            $dv_grupo_3 = \Bancos\Sicoob\Boleto\LinhaDigitavel::gerarDvLinhaDigitavel($_linha, 3);
            $_linha = \Bancos\Sicoob\Funcoes\InsereNaPosicao::inserir($_linha, 10, $dv_grupo_1);
            $_linha = \Bancos\Sicoob\Funcoes\InsereNaPosicao::inserir($_linha, 21, $dv_grupo_2);
            $_linha = \Bancos\Sicoob\Funcoes\InsereNaPosicao::inserir($_linha, 32, $dv_grupo_3);

            // adicionando digito verificador do codigo de barras
            $_linha .= \Bancos\Sicoob\Funcoes\CodigoBarras::gerarDvCodigoBarras();

            // adicionando Fator de vencimento a linha digitavel
            $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher(
                \Bancos\Sicoob\Funcoes\FatorData::getFatorVcto($boletos['data_vencimento']),
                4,
                'Numerico'
            );

            // adicionando valor do boleto a linha digitavel
            $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher(
                \Bancos\Sicoob\Funcoes\FatorData::getFatorVcto($boletos['valor_nominal']),
                10,
                'Numerico'
            );

            $boletos['linha_digitavel'] = $_linha;
        }
        return $parametros;
    }

    public static function adicionarCodigoBarras(array $parametros)
    {

        return $parametros;
    }
}
