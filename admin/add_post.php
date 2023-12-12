<?php 
    session_start();
    include_once 'config/Database.php';
    include_once 'class/User.php';
    include_once 'class/Post.php';
    include_once 'class/Category.php';

$database = new Database();
$db = $database->getConnection();
$post = new Post($db);
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['savePost'])){
	$post->updateInsert();
    header('Location:posts.php');
}
$nameCategory=$post->getCategory();
$id=$_GET['id'] ?? null;
$dataPosts=$post->getPosts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include './header.php'; ?>
    <section id="main mt-3">
        <div class="container">
            <div class="row">	
                <?php 
                    $_SESSION['active'] = 'post';
                    include './slidebars.php';
                ?>
                <div class="col-md-9 bg-light">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add / Edit New Post</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" id="postForm">							
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= !empty($dataPosts)? $dataPosts['title']: null ?>" placeholder="Post title.." required>							
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="lastname" class="form-label">Message</label>							
                                <textarea class="form-control" rows="5" id="message" name="message" placeholder="Post message.." required><?=!empty($dataPosts)? $dataPosts['message'] : null?></textarea>					
                            </div>	
                            <div class="form-group mb-3">
                                <label for="sel1">Category</label>
                                <select class="form-control" id="category" name="category" required>
                                        <?php if(!empty($nameCategory)): ?>
                                    <?php foreach($nameCategory as $value): ?>
                                    <?php if($value['name']==$dataPosts['name']): ?>
                                        <option value="<?= $dataPosts['name'] ?>" selected><?= $dataPosts['name'] ?></option>
                                        <?php else: ?>
                                            <option value="<?=$value['name'] ?>"><?=$value['name'] ?></option>
                                    <?php endif; ?>
                                    
                                        
                                    <?php endforeach; ?>
                                    <?php endif; ?>			
                                </select>
                            </div>						
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" id="publish" value="published" <?= !empty($dataPosts) ?(($dataPosts['status']=='published') ?'checked' :null) : null ?> >
                                <label class="form-check-label" for="inlineRadio1">Publish</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" id="draft" value="draft" <?=!empty($dataPosts) ?(($dataPosts['status']=='draft') ?'checked' :null) : null ?>>
                                <label class="form-check-label" for="inlineRadio2">Draft</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" id="archived" value="archived" <?=!empty($dataPosts) ?(($dataPosts['status']=='archived') ?'checked' :null) : null ?>>
                                <label class="form-check-label" for="inlineRadio3">Archive</label>
                            </div>	
                            <div class="mt-3">
                                <input type="submit" name="savePost" id="savePost" class="btn btn-info" value="Save" />											
                            </div>									
                        </form>				
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</body>
</html>