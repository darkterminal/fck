<?php

namespace Fckin\core\db;

use Fckin\core\Application;
use PDO;

class Database
{
    public PDO $pdo;

    public function __construct(array $config)
    {
        $host       = $config['host'] ?? '';
        $port       = $config['port'] ?? '';
        $dbname     = $config['dbname'] ?? '';
        $user       = $config['user'] ?? '';
        $password   = $config['password'] ?? '';

        $this->pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];

        $files = scandir(Application::$ROOT_DIR . DIRECTORY_SEPARATOR .'migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        
        foreach ($toApplyMigrations as $migration) {
            if($migration === '.' || $migration === '..') continue;
            require_once Application::$ROOT_DIR . DIRECTORY_SEPARATOR .'migrations'. DIRECTORY_SEPARATOR .$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied!");
        }
    }

    public function droppedMigrations()
    {
        $appliedMigrations = array_reverse($this->getAppliedMigrations(), true);

        $newMigrations = [];
        
        foreach ($appliedMigrations as $migration) {
            if($migration === '.' || $migration === '..') continue;
            require_once Application::$ROOT_DIR . DIRECTORY_SEPARATOR .'migrations'. DIRECTORY_SEPARATOR .$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Dropping migration $migration");
            $instance->down();
            $this->log("Dropped migration $migration");
            $newMigrations[] = $migration;
        }

        $this->deleteMigrations($newMigrations);

        if (!empty($newMigrations)) {
            $this->deleteMigrations($newMigrations);
        } else {
            $this->log("All migrations are dropped!");
        }
    }

    public function createMigrationTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function getAppliedMigrations()
    {
        $statment = $this->pdo->prepare("SELECT migration FROM migrations");
        $statment->execute();
        return $statment->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        $query = implode(',', array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $query");
        $statement->execute();
    }

    public function deleteMigrations(array $migrations)
    {
        rsort($migrations);
        $placeholders = implode(', ', array_fill(0, count($migrations), '?'));
        $statement = $this->pdo->prepare("DELETE FROM migrations WHERE migration IN ($placeholders)");
        $statement->execute($migrations);
    }

    protected function log($message)
    {
        echo '['.date('Y-m-d H:i:s').'] - ' . $message . colorize('OK', 'green') .PHP_EOL;
    }

}
