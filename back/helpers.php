<?php

function countWords(string $text): array
{
    $text = preg_replace('/[^\p{L}\p{N}\s]/u', '', trim($text));
    $words = preg_split('/\s+/', $text);

    $wordCounts = array_count_values($words);
    $wordCounts = array_filter($wordCounts, function ($count) {
        return $count > 1;
    });
    arsort($wordCounts);
    return $wordCounts;
}


/**
 * @param string $text
 * @return false|string
 */
function filterInputData(string $text)
{
    if (empty($text)) {
        return $text;
    }

    $text = trim($text);
    $text = htmlspecialchars($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return $text;
}
