<?php

function dump($data)
{
    echo "<pre>";
    \var_dump($data);
    echo "</pre>";
    die();
}

function text_alt_formatter($input)
{
    // Convert camelCase or PascalCase to snake_case
    $snakeCase = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $input));

    // Explode snake_case into an array
    $exploded = explode('_', $snakeCase);

    // Capitalize the first letter of each word
    $capitalizedWords = array_map('ucfirst', $exploded);

    return implode(' ', $capitalizedWords);
}