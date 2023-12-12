<?php 
    session_start();
    if (!isset($_SESSION['isLogined']) || !$_SESSION['isLogined']) {
        header('Location: login.php');
    }
    include_once 'config/Database.php';
    include_once 'class/User.php';
    include_once 'class/Post.php';
    include_once 'class/Category.php';
    
    $database = new Database();
    $db = $database->getConnection();

    $post = new Post($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include './header.php'; ?>

    <div class="container">
        <div class="mt-3">
            <div class="row">
                <?php 
                    $_SESSION['active'] = 'post';
                    include './slidebars.php';
                ?>

                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title bg-light p-3 fs-4">Post Listing</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3 class="panel-title"></h3>
                                    </div>
                                    <div class="col-md-2 my-2" align="right">
                                        <a href="./add_post.php" class="btn btn-default btn-secondary btn-sm">Add New</a>				
                                    </div>
                                </div>
                            </div>
                            <table id="postsList" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>User</th>
                                        <th>Status</th>	
                                        <th>Created</th>
                                        <th>Updated</th>															
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?= $post->getContent(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/posts.js"></script>	
   

</body>
</html>