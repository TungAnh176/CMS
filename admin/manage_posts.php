<?php
include_once 'config/Database.php';
include_once 'class/Post.php';
$database = new Database();
$db = $database->getConnection();
$post = new Post($db);
if(!empty($_POST['action']) && $_POST['action'] == 'postDelete') {
	$id = (isset($_POST['postId']) && $_POST['postId']) ? $_POST['postId'] : '0';
	$post->postDelete($id);
	$data=$post->getContent();
	echo json_encode(['data'=>$data,'count'=>$post->totalPost()]);
}
?>