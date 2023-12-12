<?php 
    class Articles {
        private $conn;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getArticles() {
            $query = "select p.id, p.title, p.message, c.name, p.userId, p.created, p.updated 
                from cms_posts p inner join cms_category c on p.category_id = c.id
                where p.status = 'published'";
            try {
                $stm = $this->conn->prepare($query);
                $stm->execute();
                return $stm->fetchAll();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function formatMessage($string, $wordsReturn) {
            $array = explode(" ", $string); // chuyển đổi chuỗi thành mảng
            if (count($array) <= $wordsReturn) {
                return $string;
            }
            array_splice($array, $wordsReturn); // Loại các phần tử từ vị trị wordsReturn
            return implode(" ", $array)."....";     // Chuyển đổi mảng thành chuỗi
        }

        public function getArticleById($id) {
            $query = "select p.id, p.title, p.message, c.name, p.userId, p.created, p.updated 
            from cms_posts p inner join cms_category c on p.category_id = c.id
            where p.status = 'published' and p.id = $id";
            try {
                $stm = $this->conn->prepare($query);
                $stm->execute();
                return $stm->fetch();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

?>