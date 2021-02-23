<?php

namespace Bancos\Sicoob\Funcoes;

class Multiplo
{
    /**
     * Funcao para calcular o proximo multiplo de 10 do digito
     *
     * @param [int] $numero
     * @return int
     */
    public static function getMultiplo10(int $numero)
    {
        while (($numero % 10) <> 0) {
            $numero++;
        }
        return $numero;
    }
}
