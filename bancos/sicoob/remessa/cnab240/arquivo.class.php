<?php

namespace Bancos\Sicoob\Remessa\CNAB240;

class Arquivo
{

    /**
     * Gera string de remessa
     *
     * @param array $paramametros
     * @return void
     */
    public static function gerarRemessa(array $paramametros)
    {
        $_remessa = "";
        # Header
        $_remessa .= \Bancos\Sicoob\Remessa\CNAB240\HeaderArquivo::get(
            $paramametros['header'][0]['tipo_inscricao'],
            $paramametros['header'][0]['numero_inscricao'],
            $paramametros['header'][0]['codigo_convenio'],
            $paramametros['header'][0]['agencia_cooperativa'],
            $paramametros['header'][0]['dv_prefixo'],
            $paramametros['header'][0]['conta_corrente'],
            $paramametros['header'][0]['dv_conta_corrente'],
            $paramametros['header'][0]['nome_empresa'],
            $paramametros['header'][0]['data_geracao'],
            $paramametros['header'][0]['hora_geracao'],
        );
        $_remessa .= "\r\n";
        $_remessa .= \Bancos\Sicoob\Remessa\CNAB240\HeaderLote::get(
            $paramametros['header'][0]['tipo_inscricao'],
            $paramametros['header'][0]['numero_inscricao'],
            $paramametros['header'][0]['agencia_cooperativa'],
            $paramametros['header'][0]['dv_prefixo'],
            $paramametros['header'][0]['conta_corrente'],
            $paramametros['header'][0]['dv_conta_corrente'],
            $paramametros['header'][0]['nome_empresa'],
            $paramametros['header'][0]['num_controle_cobranca'],
            $paramametros['header'][0]['data_geracao']
        );
        $_remessa .= "\r\n";

        # Boletos
        $cont = 0;
        foreach ($paramametros['boletos'] as $key => $boletos) {
            # Nosso Numero
            $boletos['nosso_numero'] = \Bancos\Sicoob\Util\NossoNumero::gerarNossoNumero(
                $boletos['numero_titulo'],
                $boletos['numero_parcela'],
                $boletos['modalidade']
            );
            /*$boletos['nosso_numero'] .= \Bancos\Sicoob\Util\NossoNumero::gerarNossoNumeroDv(
                $boletos['agencia_cooperativa'],
                $boletos['codigo_cliente'],
                $boletos['nosso_numero']
            );*/
            # Seguimento P
            $_remessa .= \Bancos\Sicoob\Remessa\CNAB240\SeguimentoP::get(
                ($cont += 1),
                $boletos['agencia_cooperativa'],
                $boletos['dv_prefixo'],
                $boletos['conta_corrente'],
                $boletos['dv_conta_corrente'],
                $boletos['nosso_numero'],
                $boletos['carteira'],
                $boletos['numero_documento'],
                $boletos['data_vencimento'],
                $boletos['valor_nominal'],
                $boletos['data_emissao'],
                $boletos['cod_juros_mora'],
                $boletos['data_juros_mora'],
                $boletos['valor_juros_mora']
            );
            $_remessa .= "\r\n";
            # Seguimento Q
            $_remessa .= \Bancos\Sicoob\Remessa\CNAB240\SeguimentoQ::get(
                ($cont += 1),
                $boletos['tipo_inscricao_pagador'],
                $boletos['numero_inscricao'],
                $boletos['nome'],
                $boletos['endereco'],
                $boletos['bairro'],
                $boletos['cep'],
                $boletos['sufixo_cep'],
                $boletos['cidade'],
                $boletos['uf']
            );
            $_remessa .= "\r\n";
            # Seguimento R
            $_remessa .= \Bancos\Sicoob\Remessa\CNAB240\SeguimentoR::get(
                ($cont += 1),
                $boletos['codigo_multa'],
                $boletos['data_multa'],
                $boletos['valor_multa']
            );
            $_remessa .= "\r\n";
            # Seguimento S
            $_remessa .= \Bancos\Sicoob\Remessa\CNAB240\SeguimentoS::get(
                ($cont += 1)
            );
            $_remessa .= "\r\n";
        }

        # Trailler
        $_remessa .= \Bancos\Sicoob\Remessa\CNAB240\TraillerLote::get(
            $paramametros['trailler'][0]['cobranca_simples_quantide_total'],
            $paramametros['trailler'][0]['cobranca_simples_quantide_total'],
            $paramametros['trailler'][0]['cobranca_simples_valor_total'],
        );
        $_remessa .= "\r\n";
        $_remessa .= \Bancos\Sicoob\Remessa\CNAB240\TraillerArquivo::get(
            $paramametros['trailler'][0]['cobranca_simples_quantide_total']
        );
        return $_remessa;
    }
}
