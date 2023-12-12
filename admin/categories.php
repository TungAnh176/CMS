<?php
    session_start();
    if (!isset($_SESSION['isLogined']) || !$_SESSION['isLogined']) {
        header('Location: login.php');
    }
    include './config/Database.php';
    global $conn;
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
                $_SESSION['active'] = 'categories';
                include './slidebars.php';
                ?>

                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title bg-light p-3 fs-4">Categories</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3 class="panel-title"></h3>
                                    </div>
                                    <div class="col-md-2 my-2" align="right">
                                        <a href="./add_categories.php" class="btn btn-default btn-secondary btn-sm">Add New</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $database = new Database();
                            $conn = $database->getConnection();
                            $selectQuery = 'Select * from cms_category order by id desc';
                            $stmt = $conn->prepare($selectQuery);
                            $stmt->execute();
                            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            echo "<table id='postsList' class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
                            $columnName = array(
                                "ID", "Name"
                            );
                            foreach ($columnName as $column) {
                                echo "<th>$column</th>";
                            }
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            foreach ($data as $row) {
                                echo "<tr>";
                                foreach ($row as $key => $value) {
                                    echo "<td>$value</td>";
                                }
                            
                                echo "<td>
        <a href='./add_categories.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
        <button class='btn btn-sm btn-danger' onclick='confirmDelete({$row['id']})'>Delete</button>
      </td>";
echo "</tr>";
   
                            }
                            echo "</tbody>";
                            echo "</table>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
    function confirmDelete(categoryId) {
        var confirmDelete = confirm("Are you sure you want to delete this category?");
        if (confirmDelete) {
            deleteCategory(categoryId);
        }
    }

    function deleteCategory(categoryId) {
        $.ajax({
            type: "POST",
            url: "delete_category.php",
            data: { id: categoryId },
            success: function(response) {
                if (response === "success") {
                    location.reload(); // Reload the entire page
                } else {
                    alert("Error deleting category");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error deleting category: " + error);
                alert("Error deleting category");
            }
        });
    }
</script>

</body>

</html>