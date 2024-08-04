<?php

namespace FocusCamera\Database;

use PDO;
use PDOException;

class DatabaseConnection {
    private $pdo;

    public function __construct(string $dbPath) {
        try {
            $this->pdo = new PDO("sqlite:$dbPath");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTableIfNotExists();
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }

    private function createTableIfNotExists(): void {
        $sql = "CREATE TABLE IF NOT EXISTS customers (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            type TEXT NOT NULL,
            company_name TEXT
        )";
        $this->pdo->exec($sql);
    }
}