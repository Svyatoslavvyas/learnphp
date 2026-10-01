<?php 
namespace App;

use PDO;
use PDOException;


class DB
{

    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO('sqlite:' . dirname(__DIR__) . '/db.sqlite');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec(
                'CREATE TABLE IF NOT EXISTS posts (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    title TEXT NOT NULL,
                    body TEXT NOT NULL DEFAULT ""
                )'
            );
            $this->conn->exec(
                'CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    email TEXT NOT NULL UNIQUE,
                    password TEXT NOT NULL
                )'
            );
        } catch (PDOException $e) {
            throw new PDOException('Database connection failed.', 0, $e);
        }
    }

    public function all($table, $class)
    {
        $stmt = $this->conn->prepare('SELECT * FROM ' . $this->identifier($table));
        $stmt->execute();



        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
        return $stmt->fetchAll();
    }

    public function find($table, $class, $id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM ' . $this->identifier($table) . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject($class);
    }

    public function findBy($table, $class, $field, $value)
    {
        $stmt = $this->conn->prepare(
            'SELECT * FROM ' . $this->identifier($table) . ' WHERE ' . $this->identifier($field) . ' = :value'
        );
        $stmt->execute(['value' => $value]);
        return $stmt->fetchObject($class);
    }

    public function insert($table, $fields)
    {
        $columns = array_map([$this, 'identifier'], array_keys($fields));
        $placeholders = array_map(static function ($column) {
            return ':' . $column;
        }, array_keys($fields));
        $sql = 'INSERT INTO ' . $this->identifier($table)
            . ' (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $placeholders) . ')';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($fields);
        return (int) $this->conn->lastInsertId();
    }

    public function update($table, $fields, $id)
    {
        $assignments = [];
        foreach (array_keys($fields) as $field) {
            $assignments[] = $this->identifier($field) . ' = :' . $field;
        }
        $fields['id'] = $id;
        $stmt = $this->conn->prepare(
            'UPDATE ' . $this->identifier($table) . ' SET ' . implode(', ', $assignments) . ' WHERE id = :id'
        );
        $stmt->execute($fields);
    }

    public function delete($table, $id)
    {
        $stmt = $this->conn->prepare('DELETE FROM ' . $this->identifier($table) . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    private function identifier($identifier)
    {
        if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $identifier)) {
            throw new \InvalidArgumentException('Invalid database identifier.');
        }
        return '"' . $identifier . '"';
    }
}