<?php 
    include_once './config/Database.php';
    include_once './class/User.php';
    session_start();
    if (!isset($_SESSION['isLogined']) || !$_SESSION['isLogined']) {
        header('Location: login.php');
    }

    $database = new Database();
    $db = $database -> getConnection();

    $user = new User($db);
    $dataUsers = $user -> getUsers();
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
                        $_SESSION['active'] = 'users';
                        include './slidebars.php';
                    ?>

                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title bg-light p-3 fs-4">Latest Users</h3>
                            </div>
                            <div class="panel-body">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h3 class="panel-title"></h3>
                                        </div>
                                        <div class="col-md-2 my-2" align="right">
                                            <a href="./add_users.php" class="btn btn-default btn-secondary btn-sm">Add New</a>				
                                        </div>
                                    </div>
                                </div>
                                <table id="postsList" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Status</th>																
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <?php foreach($dataUsers as $user): ?>
                                            <tr>
                                                <td><?php echo $user['first_name']. " ". $user['last_name']; ?></td>
                                                <td><?php echo $user['email']; ?></td>
                                                <td>
                                                    <?php 
                                                        if ($user['type'] == 1) echo 'Admin';
                                                        else if ($user['type'] == 2) echo 'Author';
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if ($user['deleted'] == 0) echo 'Active';
                                                        else if ($user['type'] == 1) echo 'Inactive';
                                                    ?>
                                                </td>
                                                <td class="text-center d-flex align-items-center justify-content-between flex-1">
                                                    <a href="./add_users.php?id=<?php echo $user['id']?>" class="btn btn-sm btn-warning text-white w-100 me-2">Edit</a>
                                                    <button class="btn-delete btn btn-sm btn-danger text-white w-100" data-order=<?php echo $user['id']?>>Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <p class="message"></p>

                                <div class="alert-box invisible opacity-0" style="transition-property: visibility, opacity; transition: 0.3s linear">
                                    <div class="overlay fixed-top fixed-left fixed-right fixed-bottom z-1" style="background-color: rgba(0, 0, 0, 0.3);"></div>
                                    <div class="wrap-box position-absolute z-2 w-50 h-50 d-flex flex-column justify-content-center align-items-center bg-white rounded" style="left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                        <h3 class="alert-heading mb-5">Delete item <span></span> ?</h3>
                                        <div class="group-btns d-flex justify-content-center align-items-center">
                                            <button class="btn-cancel z-3 me-2 bg-secondary text-white border-0 rounded pt-2 pb-2 ps-5 pe-5">Cancel</button>
                                            <button class="btn-accept z-3 bg-success text-white border-0 rounded pt-2 pb-2 ps-5 pe-5">Accept</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="./js/users.js"></script>
    </body>
</html>