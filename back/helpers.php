<?php
function countWords(string $text):array
{
    $text = preg_replace('/[^\p{L}\p{N}\s]/u', '', trim($text));

    // Разбиваем текст на отдельные слова
    $words = preg_split('/\s+/', $text);

    $wordCounts = array();

    // Перебираем все слова и увеличиваем счетчик каждого слова в массиве
    foreach ($words as $word) {
        if (isset($wordCounts[$word])) {
            $wordCounts[$word]++;
        } else {
            $wordCounts[$word] = 1;
        }
    }

    foreach ($wordCounts as $word => $count) {
        if($count == 1)
            unset($wordCounts[$word]);
    }

    return $wordCounts;
}
