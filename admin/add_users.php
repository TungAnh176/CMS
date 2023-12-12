<?php
    include_once './config/Database.php';
    include_once './class/User.php';

    session_start();

    $database = new Database();
    $db = $database -> getConnection();

    $user = new User($db);

    if (isset($_POST['updateUserButton'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $typeUser = $_POST['typeUser'];
        $statusUser = $_POST['statusUser'];

        $user->updateUser($first_name, $last_name, $email, $password, $typeUser, $statusUser);
        $user->addUser($first_name, $last_name, $email, $password, $typeUser, $statusUser);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add users</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/style.css">
    </head>

    <body>
        <?php include './header.php'; ?>  
        
        <section id="main mt-3">
            <div class="container">
                <div class="row">	
                    <?php 
                        $_SESSION['active'] = 'users';
                        include './slidebars.php';
                    ?>   

                    <div class="col-md-9 bg-light">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add / Edit User</h3>
                        </div>
                        <div class="panel-body">
                        
                            <form method="post" id="updateUserForm" class="p-4">							
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label fw-bolder">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="" placeholder="First name.." required>							
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label fw-bolder">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="" placeholder="Last name.." required>							
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label fw-bolder">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="" placeholder="email.." required>							
                                </div>				
                                	
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label fw-bolder">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="password.." required>							
                                </div>			

                                <div class="form-group mb-3">
                                    <label for="status" class="form-label fw-bolder">User Type </label>							
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="typeUser" id="typeAdmin" value="typeAdmin" required>
                                        <label class="form-check-label" for="typeAdmin">Administrator</label>
                                    </div>
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="typeUser" id="typeAuthor" value="typeAuthor" required>
                                        <label class="form-check-label" for="typeAuthor">Author</label>
                                    </div>										
                                </div>		

                                <div class="form-group mb-3">
                                    <label for="status" class="form-label fw-bolder">User Status </label>							
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="statusUser" id="statusActive" value="statusActive" required>
                                        <label class="form-check-label" for="statusActive">Active</label>
                                    </div>
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="statusUser" id="statusInactive" value="statusInactive" required>
                                        <label class="form-check-label" for="statusInactive">Inactive</label>
                                    </div>										
                                </div>
                                <input type="submit" name="updateUserButton" id="updateUserButton" class="btn btn-info" value="Add" />											
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