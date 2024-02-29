<?php
// Your migration content here

use Fckin\core\Application;

class f20231230030259_adding_password_column
{
    public function up()
    {
        $db = Application::$app->db;
        $sql =<<<SQL
        ALTER TABLE users ADD COLUMN password VARCHAR(255) NOT NULL AFTER email;
        SQL;
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql =<<<SQL
        ALTER TABLE users DROP COLUMN password;
        SQL;
        $db->pdo->exec($sql);
    }
}
    
