<?php

namespace App\models;

use Fckin\core\FTAuth;
use Fckin\core\db\Model;

class Login extends Model
{
    public string $email = '';
    public string $password = '';

    public string $tableName = 'users';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function login()
    {
        $user = $this->table($this->tableName)->select('*')->where('email', '=', $this->email)->get();
        if (!$user) {
            $this->addError('email', 'User does not exist with this email');
            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect!');
            return false;
        }

        $auth = new FTAuth(env('FTA_SECRET'));
        $token = $auth->generateToken($user->id);
        return $auth->setAuth($token);
    }
}
