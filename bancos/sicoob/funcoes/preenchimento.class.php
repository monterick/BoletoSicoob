<?php

namespace Bancos\Sicoob\Funcoes;

class Preenchimento
{
    /**
     * Preenche o campo
     *
     * @param [Campo a preencher (string)] $valor
     * @param [Comprimento do campo (int)] $tamanho
     * @param ['Numerico' ou 'Alfa Numerico'] $formato
     * @return void
     */
    public static function preencher($valor, $tamanho, $formato)
    {
        switch ($formato) {
            case 'Numerico':
                $caractere = 0;
                $posicao = STR_PAD_LEFT;
                break;
            case 'Alfa Numerico':
                $caractere = " ";
                $posicao = STR_PAD_RIGHT;
                break;
            default:
                $caractere = 0;
                $posicao = STR_PAD_LEFT;
                break;
        }

        $result = substr(str_pad($valor, $tamanho, $caractere, $posicao), 0, $tamanho);

        if (strlen($result) == $tamanho) {
            return $result;
        } else {
            return 'Erro ao Prencher valor';
        }
    }
}
