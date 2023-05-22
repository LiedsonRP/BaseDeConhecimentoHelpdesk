<?php

namespace App\Contracts;

/**
 * Estabele um contrato que permite que duas categorias tenham a permissão ser serem comparadas
 */
interface ComparableCategory 
{
    /**
     * Verifica se duas categorias comparáveis são iguais
     */
    public function equals(ComparableCategory $comparableCategory) : bool;
}