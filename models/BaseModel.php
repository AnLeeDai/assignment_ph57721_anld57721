<?php

namespace models;

use PDO;
use PDOException;

class BaseModel
{
    protected $table;
    protected $pdo;

    public function __construct()
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASSWORD, DB_OPTIONS);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Không thể kết nối đến database: {$e->getMessage()}");
        }
    }

    public function insert($data): false|string
    {
        $keys = array_keys($data);

        $columns = implode(',', $keys);
        $placeholders = ':' . implode(', :', $keys);

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);

        return $this->pdo->lastInsertId();
    }

    public function update($data, $conditions = null, $params = []): int
    {
        $sets = implode(', ', array_map(fn($key) => "$key = :set_$key", array_keys($data)));

        $sql = "UPDATE {$this->table} SET $sets";

        // Append WHERE conditions if provided
        if ($conditions) {
            $sql .= " WHERE $conditions";
        }

        $stmt = $this->pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":set_$key", $value);
        }

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();

        return $stmt->rowCount();
    }


    public function delete(
        $conditions = null,
        $params = []
    ): int
    {
        $sql = "DELETE FROM {$this->table}";

        if ($conditions) {
            $sql .= " WHERE $conditions";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->rowCount();
    }

    public function select(
        $columns = '*', $conditions = null, $params = []
    ): false|array
    {
        $sql = "SELECT $columns FROM {$this->table}";

        if ($conditions) {
            $sql .= " WHERE $conditions";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function selectWithJoin(
        $columns = '*',
        $joins = [],
        $conditions = null,
        $params = []
    ): false|array
    {

        $sql = "SELECT $columns FROM {$this->table}";

        foreach ($joins as $join) {
            $sql .= " {$join['type']} JOIN {$join['table']} ON {$join['on']}";
        }

        if ($conditions) {
            $sql .= " WHERE $conditions";
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetchAll();
    }


    public function find(
        $columns = '*',
        $conditions = null,
        $params = []
    )
    {
        $sql = "SELECT $columns FROM {$this->table}";

        if ($conditions) {
            $sql .= " WHERE $conditions";
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetch();
    }


    public function __destruct()
    {
        $this->pdo = null;
    }
}