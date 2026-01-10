<?php

class Db
{

    private PDO $conn;
    private $host = "mysql";
    private $username = "root";
    private $password = "password";
    private $database = "crm";

    public function __construct()
    {
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
    public function conn()
    {
        return $this->conn;
    }
}
