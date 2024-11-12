<?php
if (!function_exists('mascararCpfCnpj')) {
    function mascararCpfCnpj($cpfCnpj) {
        if (strlen($cpfCnpj) === 11) {
            // Máscara para CPF (exemplo: 710.212.302-78 -> ***.***.302-78)
            return '***.***.' . substr($cpfCnpj, 6, 3) . '-' . substr($cpfCnpj, 9, 2);
        } elseif (strlen($cpfCnpj) === 14) {
            // Máscara para CNPJ (exemplo: 12.345.678/0001-99 -> **.***.***/0001-99)
            return '**.***.***/' . substr($cpfCnpj, 8, 4) . '-' . substr($cpfCnpj, 12, 2);
        } else {
            return $cpfCnpj; // Retorna o valor original se não for um CPF ou CNPJ válido
        }
    }
}
