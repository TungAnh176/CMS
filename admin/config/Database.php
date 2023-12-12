<?php 
    class Database {
        private $username = 'root';
        private $password = '';

        public function getConnection() {
            try {
                $conn = new PDO('mysql:host=localhost;dbname=cms', $this->username, $this->password);
                if ($conn) {
                    return $conn;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>