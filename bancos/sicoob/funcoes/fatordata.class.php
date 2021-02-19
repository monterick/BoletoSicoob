<?php

namespace Bancos\Sicoob\Funcoes;

use DateInterval;
use DateTime;

class FatorData
{
    public static $data_sicoob = '03-07-2000';

    /**
     * Funcao para conversão de data para fator de vencimento.
     *
     * @param [type] $data_vencimento
     * @return void
     */
    public static function getFatorVcto($data_vencimento)
    {
        $data_vencimento = \Bancos\Sicoob\Funcoes\FatorData::formataData($data_vencimento);
        $data_sicoob = new DateTime(self::$data_sicoob);
        $_fator = (date_diff($data_sicoob, $data_vencimento)->days + 1000);
        return $_fator;
    }

    /**
     * Funcao de conversao de fator de vencimento para data.
     *
     * @param [type] $data_vencimento
     * @return void
     */
    public static function getFatorData($data_vencimento)
    {
        $fator = \Bancos\Sicoob\Funcoes\FatorData::getFatorVcto($data_vencimento);
        if ($fator == 0) {
            $_data = 0;
        } else {
            $data_sicoob = new DateTime(self::$data_sicoob);
            $fator = (int)$fator - 1000;
            $_data = $data_sicoob->add(new DateInterval('P' . $fator . 'D'));
        }
        return $_data->format('d-m-Y');
    }

    /**
     * Função para instanciar um novo objeto DateTime a apartir de uma string de data sem separações
     *
     * @param [type] $data
     * @return void
     */
    public static function formataData($data)
    {
        if (strlen($data) == 8) {
            $dia = substr($data, 0, 2);
            $mes = substr($data, 2, 2);
            $ano = substr($data, 4, 4);
            $data = $dia . '-' . $mes . '-' . $ano;
            $_data = new DateTime($data);
        }
        return $_data;
    }
}
