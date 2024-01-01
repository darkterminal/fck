<?php

namespace Fckin\core\db;

use Fckin\core\Application;
use PDO;

/**
 * Query Builder Class
 * 
 * is designed for the lazy ones who don't want to write SQL.
 * 
 */
class QueryBuilder
{
    // PDO Connection instance as you can see
    private $pdo;

    // Table property for current working database table
    private $table;

    // Select property statement with the star default
    private $select = '*';

    // Where property where you can ask what you need
    private $where = '';

    // Everything else you know about this
    private $params = [];

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
    }

    /**
     * Set the database table for the query.
     *
     * @param string $table The name of the database table.
     * @return $this Returns an instance of the QueryBuilder for method chaining.
     */
    public function table(string $table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Set the columns to be selected in a SELECT query.
     *
     * @param string|array $columns The columns to be selected. Can be a string or an array of column names.
     * @return $this Returns an instance of the QueryBuilder for method chaining.
     */
    public function select(string|array $columns)
    {
        $this->select = is_array($columns) ? implode(', ', $columns) : $columns;
        return $this;
    }

    /**
     * Add a WHERE clause to the query.
     *
     * @param string $column The column to compare.
     * @param string $operator The comparison operator (e.g., '=', '>', '<').
     * @param mixed $value The value to compare against.
     * @return $this Returns an instance of the QueryBuilder for method chaining.
     */
    public function where(string $column, string $operator, mixed $value)
    {
        $this->where = "WHERE $column $operator ?";
        $this->params[] = $value;
        return $this;
    }


    /**
     * Insert data into the database table.
     *
     * @param array $data The associative array of column-value pairs to be inserted.
     * @return int The ID of the last inserted row.
     */
    public function insert(array $data): int
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $this->table ($columns) VALUES ($values)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array_values($data));

        return $this->pdo->lastInsertId();
    }

    /**
     * Update data in the database table.
     *
     * @param array $data The associative array of column-value pairs to be updated.
     * @return int The number of affected rows.
     */
    public function update(array $data): int
    {
        $setClause = implode(', ', array_map(function ($key) {
            return "$key = ?";
        }, array_keys($data)));

        $sql = "UPDATE $this->table SET $setClause $this->where";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array_merge(array_values($data), $this->params));

        return $statement->rowCount();
    }

    /**
     * Delete rows from the database table based on the provided WHERE clause.
     *
     * @return int The number of affected rows.
     */
    public function delete(): int
    {
        $sql = "DELETE FROM $this->table $this->where";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($this->params);

        return $statement->rowCount();
    }

    /**
     * Retrieve a single record from the database based on the provided SELECT columns and WHERE clause.
     *
     * @return object|null The object representing a single record, or null if no records match the criteria.
     */
    public function get(): ?object
    {
        $sql = "SELECT $this->select FROM $this->table $this->where";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($this->params);

        $result = $statement->fetch(PDO::FETCH_OBJ);

        return $result !== false ? $result : null;
    }

    /**
     * Retrieve all records from the database based on the provided SELECT columns and WHERE clause.
     *
     * @return array The array of associative objects representing all records.
     */
    public function getAll(): array
    {
        $sql = "SELECT $this->select FROM $this->table $this->where";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($this->params);

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Execute a raw SQL query.
     *
     * @param string $sql The raw SQL query to execute.
     * @param array $params The parameters to bind to the query.
     * @return mixed The result of the query execution (e.g., PDOStatement).
     */
    public function query(string $sql, array $params = []): mixed
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);

        return $statement;
    }
}
