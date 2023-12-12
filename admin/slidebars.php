
<?php 
    include_once './config/Database.php';
    include_once './class/User.php';
    include_once './class/Post.php';
    include_once './class/Category.php';

    if (!isset($_SESSION['isLogined']) || !$_SESSION['isLogined']) {
        header('Location: login.php');
    }

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    $post = new Post($db);
    $category = new Categories($db);
?>
<div class="col-md-3">
    <div class="d-flex flex-column flex-shrink-0 bg-light" style="width: 280px">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a 
                    href="./dashboard.php" 
                    class="nav-link <?php 
                        if ($_SESSION['active'] == 'dashboard') {
                            echo 'active';
                        }
                        else {
                            echo 'link-dark';
                        }
                    ?>" 
                    aria-current="page"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                    </svg>
                    Dashboard
                    <span class="float-end rounded-pill bg-secondary text-light px-2"><?= $post->totalPost() + $user->totalUsers() + $category->totalCategories() ?></span>
                </a>
            </li>
            <li>
                <a 
                    href="./posts.php" 
                    class="nav-link <?php 
                        if ($_SESSION['active'] == 'post') {
                            echo 'active';
                        }else {
                            echo 'link-dark';
                        }
                    ?>"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                    </svg>
                    Posts
                    <span class="float-end rounded-pill bg-secondary text-light px-2"><?= $post->totalPost() ?></span>
                </a>
            </li>
            <li>
                <a 
                    href="./categories.php" 
                    class="nav-link <?php 
                        if ($_SESSION['active'] == 'categories') {
                            echo 'active';
                        }else {
                            echo 'link-dark';
                        }
                    ?>"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                        <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                    </svg>
                    Categoties
                    <span class="float-end rounded-pill bg-secondary text-light px-2"><?= $category->totalCategories() ?></span>
                </a>
            </li>
            <li>
                <a 
                    href="./users.php" 
                    class="nav-link <?php 
                        if ($_SESSION['active'] == 'users') {
                            echo 'active';
                        }else {
                            echo 'link-dark';
                        }
                    ?>"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    Users
                    <span class="float-end rounded-pill bg-secondary text-light px-2"><?= $user->totalUsers() ?></span>
                </a>
            </li>
        </ul>
    </div>

</div>