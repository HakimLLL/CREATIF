<?php

namespace Core\Helpers;

function slugify(string $text): string
{
    // 1. Remplacer les caractères accentués par leur équivalent non accentué
    $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);


    // 2. Mettre en minuscules
    $text = strtolower($text);


    // 3. Remplacer tout ce qui n'est pas une lettre, un chiffre ou un tiret par un tiret
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);


    // 4. Supprimer les tirets en début et fin de chaîne
    $text = trim($text, '-');


    return $text;
}

// Tronquage du texte à 10 mots

function truncate(string $string, int $lg_max = 10): string
{
    if (strlen($string) > $lg_max):

        $string = substr($string, 0, $lg_max);
        $last_space = strrpos($string, " ");
        return substr($string, 0, $last_space) . "...";;
    endif;
    return $string;
}
