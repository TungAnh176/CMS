<?php
include './config/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $categoryId = $_POST["id"];

    $database = new Database();
    $conn = $database->getConnection();

    $deleteQuery = "DELETE FROM cms_category WHERE ID = :id";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);

    try {
        $stmt->execute();
        echo "success";
    } catch (PDOException $e) {
        echo "error". $e->getMessage();
    }
} else {
    echo "invalid_request";
}
?>