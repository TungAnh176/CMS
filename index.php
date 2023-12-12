<?php 
    include './config/Database.php';
    include './class/Articles.php';

    $database = new Database();
    $conn = $database->getConnection();

    $articles = new Articles($conn);
    $articlesList =  $articles->getArticles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include './header.php' ?>
    <div class="container">
        <div id="blog" class="row mt-3">
            <?php foreach($articlesList as $article):?>
                <div class="col-md-10 blogShort border-bottom">
                    <h3>
                        <a href="./view.php?id=<?= $article['id'] ?>" class="li"><?= htmlspecialchars($article['title']) ?></a>
                    </h3>
                    <em><strong>Published on</strong>: <?= htmlspecialchars( $article['created']) ?></em>
                    <em>
                        <strong>Category:</strong>
                        <a href="#"><?= htmlspecialchars($article['name']) ?></a>
                    </em>
                    <br><br>
                    <article>
                        <p>
                            <?= htmlspecialchars($articles->formatMessage($article['message'], 100)) ?>
                        </p>
                    </article>
                    <a class="btn btn-primary btn-sm float-end mb-3" href="./view.php?id=<?= $article['id'] ?>">READ MORE</a>
                </div>
            <?php endforeach?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</body>
</html>