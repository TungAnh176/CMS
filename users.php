<?php
// session_start();
require "../CMS/config/Database.php";
try {
    $conn = getConnection();
    $sql = "SELECT * FROM cms_user ORDER BY id DESC LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
} catch (\Throwable $th) {
    //throw $th;
}

?>
<?php
include "layout/header.php";
?>
<main>
    <div class="container">
        <div class="row">
            <h3 class="text-center">User Management</h3>
            <a href="" class="btn btn-success mb-3" style="width:15%"><i class="bi bi-person-add"></i> Add New User</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">FirstName</th>
                        <th scope="col">LastName</th>
                        <th scope="col">Email</th>
                        <th scope="col">Type</th>
                        <th scope="col" colspan="3" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                    <tr>
                        <th scope="row"><?= $user['id']; ?></th>
                        <td><?= $user['first_name']; ?></td>
                        <td><?= $user['last_name']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= ($user['type'] == 0) ? 'Admin' : 'Tác Giả'; ?></td>
                        <td><i class="bi bi-eye"></i></td>
                        <td><i class="bi bi-trash"></i></td>
                        <td><i class="bi bi-pencil"></i></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php
include "layout/footer.php";
?>