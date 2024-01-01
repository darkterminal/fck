<?php

namespace Fckin\models;

use Fckin\core\db\Model;

class User extends Model
{
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $password = '';
    public string $repeatPassword = '';

    public string $tableName = 'users';

    public function rules(): array
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
            'repeatPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function register() {
        $result = $this->table($this->tableName)->insert([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'password' => password_hash($this->password, PASSWORD_DEFAULT)
        ]);
        return $result > 0;
    }

    public function detail()
    {
        $authData = getAuthData();
        $data = $this->table('users')->where('id', '=', (int) $authData['user_id'])->get();
        return $data;
    }
}