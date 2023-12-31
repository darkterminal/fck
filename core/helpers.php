<?php

use Fckin\core\Application;
use Fckin\core\FTAuth;

function isGuest()
{
    return !isset($_COOKIE['FTA_TOKEN']);
}

function unAuthorized()
{
    $auth = new FTAuth('randomsecretovertheworld0123456789');
    return $auth->unsetAuth();
}

function isAuthenticate()
{
    $auth = new FTAuth('randomsecretovertheworld0123456789');
    return $auth->isAuthenticate();
}

function addToast($key, $message)
{
    Application::$app->session->setFlashMessage($key, $message);
}

function toast($key)
{
    if (Application::$app->session->getFlashMessage($key)):
        return '<div role="alert" class="alert alert-' . $key . ' w-[30rem] mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>' . Application::$app->session->getFlashMessage($key) . '</span>
        </div>';
    endif;
}

function display_info()
{
    echo phpinfo();
    die();
}

function dump($data, $exit = false)
{
    echo "<pre>";
    \var_dump($data);
    echo "</pre>";
    if ($exit) {
        die();
    }
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

function colorize($text, $color)
{
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

function env($key, $default = null)
{
    if (is_null($default)) {
        return php_sapi_name() === 'cli' ? getenv($key) : $_ENV[$key];
    } else {
        return php_sapi_name() === 'cli' ? (getenv($key) ?? $default) : ($_ENV[$key] ?? $default);
    }
}
