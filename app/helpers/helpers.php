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

// Função para extrair o ID do YouTube
if (!function_exists('embedVideo')) {
    function embedVideo($url) {
        if (strpos($url, 'youtu') !== false) {
            if (strpos($url, 'youtu.be') !== false) {
                $id = explode('youtu.be/', $url)[1];
            } else {
                parse_str(parse_url($url, PHP_URL_QUERY), $params);
                $id = $params['v'] ?? '';
            }
            return $id ? "https://www.youtube.com/embed/$id" : '';
        }

        if (strpos($url, 'vimeo.com') !== false) {
            if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
                return "https://player.vimeo.com/video/{$matches[1]}";
            }
        }

        if (strpos($url, 'facebook.com') !== false) {
            return "https://www.facebook.com/plugins/video.php?href=" . urlencode($url) . "&show_text=false&width=560";
        }

        return '';
    }
}