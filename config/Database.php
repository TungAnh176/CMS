<?php
    function getConnection() {
        $host = 'localhost';
        $user = 'root';
        $password = "tunganh1706";
        $database = "cms";
        try {
            return new PDO("mysql:host=$host;dbname=$database", $user, $password);
        } catch (PDOException $e) {
            echo ("Error failed to connect to MySQL: " . $e->getMessage());
        }
    }
