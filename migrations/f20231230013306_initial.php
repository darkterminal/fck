<?php
// Your migration content here

use App\core\Application;

class f20231230013306_initial
{
    public function up()
    {
        $db = Application::$app->db;
        $sql =<<<SQL
        CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstName VARCHAR(255) NOT NULL,
            lastName VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            status TINYINT NOT NULL DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            deleted_at TIMESTAMP NULL
        ) ENGINE=INNODB;
        SQL;
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql =<<<SQL
        DROP TABLE users;
        SQL;
        $db->pdo->exec($sql);
    }
}
    
