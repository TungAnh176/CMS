<?php
class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = "tunganh1706";
    private $database = "cms";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error failed to connect to MySQL: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
