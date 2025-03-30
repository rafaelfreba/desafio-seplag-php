<?php

if (!function_exists('calculaIdade')) {
    function calculaIdade($dataNascimento)
    {
        if (!$dataNascimento) {
            return null;
        }

        return \Carbon\Carbon::parse($dataNascimento)->age;
    }
}
