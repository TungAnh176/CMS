<?php 
    class Categories {
        private $conn;
        
        public function __construct($db) {
            $this->conn = $db;
        }

        public function totalCategories() {
            $query = 'select count(*) as total from cms_category';
            try {
                $statement = $this->conn->prepare($query);
                $statement->execute();
                $data = $statement->fetch();
                // if ($data) {
                //     $_SESSION['total_categories'] = $data['total'];
                // }
                return $data['total'];
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>