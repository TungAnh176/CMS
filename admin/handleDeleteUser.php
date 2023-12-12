<?php
    include_once "./config/Database.php";
    include_once("./class/User.php");

    $database = new Database();
    $db = $database -> getConnection();

    $user = new User($db);
    $id = $_POST['id'];
    $deleteUser = $user -> deleteUser($id);
    echo json_encode($deleteUser);
?>