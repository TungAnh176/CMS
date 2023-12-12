<?php
session_start();
include_once './config/Database.php';

$database = new Database();
$conn = $database->getConnection();


if (isset($_GET['id'])) {
    
    $categoryId = $_GET['id'];
    
    $selectQuery = 'SELECT * FROM cms_category WHERE id = :id';
    
    $stmt = $conn->prepare($selectQuery);
    $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
    $stmt->execute();
    $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$categoryData) {
        echo "Category not found.";
        exit;
    }
    $pageTitle = 'Edit Category';
} else {
    // Add a new category
    $categoryData = array('id' => '', 'name' => ''); // Default values for a new category
    $pageTitle = 'Add Category';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryName = $_POST['name']; // Update the form field name

    if (isset($_GET['id'])) {
        // Update existing category
        $updateQuery = 'UPDATE cms_category SET name = :name WHERE id = :id'; // Update the column name
        $stmt = $conn->prepare($updateQuery);
        $stmt->bindParam(':name', $categoryName, PDO::PARAM_STR);
        $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
    } else {
        // Insert new category
        $insertQuery = 'INSERT INTO cms_category (name) VALUES (:name)'; // Update the column name
        $stmt = $conn->prepare($insertQuery);
        $stmt->bindParam(':name', $categoryName, PDO::PARAM_STR);
    }

    try {
        $stmt->execute();
        echo "Category saved successfully.";
        
    } catch (PDOException $e) {
        echo "Error saving category: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
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

                <div class="col-md-9 bg-light">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $pageTitle; ?></h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" id="postForm">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name"  
                                        value="<?php echo $categoryData['name']; ?>" 
                                        placeholder="Category name.." required>
                                </div>
                                <input type="submit" name="categorySave" id="categorySave" class="btn btn-info"
                                    value="Save" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>

</html>