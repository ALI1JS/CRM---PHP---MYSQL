<?php


class Db
{

    private readonly PDO $conn; // readonly ==> assinged only once

    public function __construct( // Constructor Property Promotion
        private $host = "mysql",
        private $username = "root",
        private $password = "password",
        private $database = "crm"
    ) {
        try {

            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->database;charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );

        } catch (PDOException $e) {
            die("Connection Failed: " . $e->getMessage());
        }
    }
    public function conn(): PDO
    {
        return $this->conn;
    }
}
