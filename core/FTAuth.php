<?php

namespace Fckin\core;

class FTAuth
{
    private $secretKey;
    protected $data = [];

    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function generateToken($userId, $algorithm = 'haval256,5', $expirationTime = 3600)
    {
        $header = json_encode(['typ' => 'FTA', 'alg' => $algorithm]);
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        $payload = json_encode(['user_id' => $userId, 'exp' => time() + $expirationTime]);
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        $signature = hash_hmac($algorithm, "$base64UrlHeader.$base64UrlPayload", $this->secretKey, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        return "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature";
    }

    public function verifyToken($token)
    {
        list($base64UrlHeader, $base64UrlPayload, $base64UrlSignature) = explode('.', $token);

        $header = json_decode(base64_decode($base64UrlHeader), true);
        $algorithm = isset($header['alg']) ? $header['alg'] : 'haval256,5';

        $signature = hash_hmac($algorithm, "$base64UrlHeader.$base64UrlPayload", $this->secretKey, true);
        $base64UrlComputedSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        if ($base64UrlSignature === $base64UrlComputedSignature) {
            $payload = json_decode(base64_decode($base64UrlPayload), true);

            // Check token expiration
            if (isset($payload['exp']) && $payload['exp'] >= time()) {
                return $payload;
            }
        }

        return false;
    }

    public function setAuth($token, $expirationTime = 3600, $path = '/', $domain = '', $secure = false, $httpOnly = true)
    {
        return setcookie('FTA_TOKEN', $token, time() + $expirationTime, $path, $domain, $secure, $httpOnly);
    }

    public function isAuthenticate()
    {
        $token = isset($_COOKIE['FTA_TOKEN']) ? $_COOKIE['FTA_TOKEN'] : null;
        return !is_null($token) && !is_null($this->verifyToken($token));
    }

    public function unsetAuth()
    {
        setcookie('FTA_TOKEN', '', time() - (3600 * 2), '/');
        return isset($_COOKIE['FTA_TOKEN']);
    }

    public function getData()
    {
        $token = isset($_COOKIE['FTA_TOKEN']) ? $_COOKIE['FTA_TOKEN'] : null;
        return $this->verifyToken($token);
    }
}
