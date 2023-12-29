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

function colorize($text, $color) {
    $colors = [
        'yellow' => '43',
        'green' => '42',
        'red' => '41',
    ];

    if (!isset($colors[$color])) {
        die("Invalid color specified");
    }

    $colorCode = $colors[$color];
    $resetCode = "\033[0m";

    return " \033[{$colorCode};30m {$text} {$resetCode}";
}

function env($key, $default = null) {
    if (is_null($default)) {
        return php_sapi_name() === 'cli' ? getenv($key) : $_ENV[$key];
    } else {
        return php_sapi_name() === 'cli' ? (getenv($key) ?? $default) : ($_ENV[$key] ?? $default);
    }
}