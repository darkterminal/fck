<?php

namespace App\models;

use Fckin\core\db\Model;

class Contact extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $message = '';
    public string $job = '';

    public string $tableName = 'contacts';

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'message' => [self::RULE_REQUIRED],
            'job' => [self::RULE_REQUIRED],
        ];
    }
}
