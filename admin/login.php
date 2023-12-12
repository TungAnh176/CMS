<?php 
    session_start();
    if (isset($_SESSION['isLogined']) && $_SESSION['isLogined']) {
        header('Location: dashboard.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarText">
                <h3 class="navbar-text text-uppercase">
                    My demo cms
                </h3>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
        </div>
    </nav>
    <div class="container contact mt-5">	
        <div class="col-md-6 shadow p-3 mb-5 bg-body rounded">                    
            <div class="panel panel-info">
                <div class="panel-heading p-3" style="background:#00796B;color:white;">
                    <div class="panel-title">Admin In</div>                        
                </div> 
                <div class="panel-body mt-3" >
                    <form id="loginform" class="form-horizontal" role="form" method="POST" action="./handle_login.php">                                    
                        <?php if(isset($_SESSION['errorMessage'])): ?>
                            <span class="text-danger"><?= $_SESSION['errorMessage'] ?></span>
                        <?php endif ?>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" id="email" name="email" placeholder="email" style="background:white;" required>                                        
                        </div>                                
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password"placeholder="password" required>
                        </div>
                        <div style="margin-top:10px" class="form-group">                               
                            <div class="col-sm-12 controls">
                                <input type="submit" name="login" value="Login" class="btn btn-success">						  
                            </div>						
                        </div>	
                    </form>   
                </div>                     
            </div>  
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>
</html>