<?php

namespace Bancos\Sicoob\Remessa\CNAB240;

class SeguimentoP
{

    /**
     * Gera seguimento P
     *
     * @param [type] $registro_item
     * @param [type] $agencia_cooperativa
     * @param [type] $dv_prefixo
     * @param [type] $conta_corrente
     * @param [type] $dv_conta_corrente
     * @param [type] $nosso_numero
     * @param [type] $carteira
     * @param [type] $numero_documento
     * @param [type] $data_vencimento
     * @param [type] $valor_nominal
     * @param [type] $data_emissao
     * @param [type] $cod_juros_mora
     * @param [type] $data_juros_mora
     * @param [type] $valor_juros_mora
     * @return void
     */
    public static function get(
        $registro_item,
        $agencia_cooperativa,
        $dv_prefixo,
        $conta_corrente,
        $dv_conta_corrente,
        $nosso_numero,
        $carteira,
        $numero_documento,
        $data_vencimento,
        $valor_nominal,
        $data_emissao,
        $cod_juros_mora,
        $data_juros_mora,
        $valor_juros_mora
    ) {

        #Parametros
        $banco = 756;
        $lote = 1;
        $tipo_registro = 3;
        //$registro_item
        $seguimento = "P";
        $cnab_1 = "";
        $codigo_movimento = 1;
        //$agencia_cooperativa
        //$dv_prefixo
        //$conta_corrente
        //$dv_conta_corrente
        $dv_ag_conta_corrente = "";
        //$nosso_numero
        //$carteira
        $cadastramento = 0;
        $tipo_documento = "";
        $tipo_emissao = 1;
        $tipo_distribuicao = 1;
        //$numero_documento
        //$data_vencimento
        //$valor_nominal
        $agencia_encarregada = 0;
        $dv_agencia_encarregada = "";
        $especie_titulo = 2;
        $aceite = "A";
        //$data_emissao
        //$cod_juros_mora
        //$data_juros_mora
        //$valor_juros_mora
        $codigo_desconto_1 = 0;
        $data_desconto_1 = 0;
        $vlr_percent_desc_1 = 0;
        $valor_iof = 0;
        $valor_abatimento = 0;
        $empresa_beneficiario = "";
        $codigo_protesto = 3;
        $dias_protesto = 0;
        $codigo_baixa_devolucao = 0;
        $prazo_baixa_devolucao = "";
        $codigo_moeda = 9;
        $numero_contrato = 0;
        $cnab_2 = "";

        # Linha
        $_linha = "";
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($banco, 3, 'Numerico'); #SEQ 01.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($lote, 4, 'Numerico'); #SEQ 02.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($tipo_registro, 1, 'Numerico'); #SEQ 03.3P

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($registro_item, 5, 'Numerico'); #SEQ 04.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($seguimento, 1, 'Alfa Numerico'); #SEQ 05.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cnab_1, 1, 'Alfa Numerico'); #SEQ 06.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_movimento, 2, 'Numerico'); #SEQ 07.3P

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($agencia_cooperativa, 5, 'Numerico'); #SEQ 08.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($dv_prefixo, 1, 'Alfa Numerico'); #SEQ 09.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($conta_corrente, 12, 'Numerico'); #SEQ 10.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($dv_conta_corrente, 1, 'Alfa Numerico'); #SEQ 11.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($dv_ag_conta_corrente, 1, 'Alfa Numerico'); #SEQ 12.3P

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($nosso_numero, 20, 'Alfa Numerico'); #SEQ 13.3P

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($carteira, 1, 'Numerico'); #SEQ 14.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cadastramento, 1, 'Numerico'); #SEQ 15.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($tipo_documento, 1, 'Alfa Numerico'); #SEQ 16.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($tipo_emissao, 1, 'Numerico'); #SEQ 17.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($tipo_distribuicao, 1, 'Alfa Numerico'); #SEQ 18.3P

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($numero_documento, 15, 'Alfa Numerico'); #SEQ 19.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($data_vencimento, 8, 'Numerico'); #SEQ 20.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($valor_nominal, 15, 'Numerico'); #SEQ 21.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($agencia_encarregada, 5, 'Numerico'); #SEQ 22.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($dv_agencia_encarregada, 1, 'Alfa Numerico'); #SEQ 23.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($especie_titulo, 2, 'Numerico'); #SEQ 24.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($aceite, 1, 'Alfa Numerico'); #SEQ 25.3P

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($data_emissao, 8, 'Numerico'); #SEQ 26.3P

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cod_juros_mora, 1, 'Numerico'); #SEQ 27.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($data_juros_mora, 8, 'Numerico'); #SEQ 28.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($valor_juros_mora, 15, 'Numerico'); #SEQ 29.3P

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_desconto_1, 1, 'Numerico'); #SEQ 30.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($data_desconto_1, 8, 'Numerico'); #SEQ 31.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($vlr_percent_desc_1, 15, 'Numerico'); #SEQ 32.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($valor_iof, 15, 'Numerico'); #SEQ 33.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($valor_abatimento, 15, 'Numerico'); #SEQ 34.3P

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($empresa_beneficiario, 25, 'Alfa Numerico'); #SEQ 35.3P

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_protesto, 1, 'Numerico'); #SEQ 36.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($dias_protesto, 2, 'Numerico'); #SEQ 37.3P

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_baixa_devolucao, 1, 'Numerico'); #SEQ 38.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($prazo_baixa_devolucao, 3, 'Alfa Numerico'); #SEQ 39.3P

        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($codigo_moeda, 2, 'Numerico'); #SEQ 40.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($numero_contrato, 10, 'Numerico'); #SEQ 41.3P
        $_linha .= \Bancos\Sicoob\Funcoes\Preenchimento::preencher($cnab_2, 1, 'Alfa Numerico'); #SEQ 42.3P

        return $_linha;
    }
}
