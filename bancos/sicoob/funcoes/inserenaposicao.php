<?php

namespace Bancos\Sicoob\Funcoes;

class InsereNaPosicao
{

    /**
     * insere digito na posição desejada
     *
     * @param [type] $string
     * @param [type] $posicao
     * @param [type] $caracter
     * @return void
     */
    public static function inserir($string, $posicao, $caracter)
    {
        return substr_replace($string, $posicao, $caracter, 0);
    }
}
