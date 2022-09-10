<?php
/* @var $articles */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <div class="row mt-4">
        <div class="col">
            <div class="text-center">
        <?php 
            //If the user is logged in, display some things about them
            if(isset($_SESSION['uid'])) {
                $name = classes\models\user\User::getName($_SESSION['uid']);
                $date = classes\models\user\User::getCreatedAt($_SESSION['uid']);

                echo "Welcome back " . $name['first_name'] . ", your account was created at: " . $date['created_at'];
            }

        ?>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-8">
                <h2>Recent Articles</h2>
            </div>
            <div class="col-lg-4">
                <div class="float-end" style="margin-left: 10px;">
                    <form class="input-group">
                        <input type="search" class="form-control rounded" placeholder="Search Articles"/>
                        <button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>

                <div class="float-end">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</button>
                        <ul class="dropdown-menu" style="max-height: 300px; overflow-y: auto;">
                            <?php
                            $result = \classes\models\article\Category::getAll();

                            if (!$result) {

                            } else {
                                foreach ($result as $k => $v) {
                                    echo '<li><a class="dropdown-item" href="article/search?category=' . $v['category_id'] . '">' . $v['category_name'] . '</a></li>';
                                }
                            }

                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="mt-2">
        </div>

        <div class="row">
            <?php
                if (isset($articles)) {
                    foreach ($articles as $k => $v) {
            ?>

            <div class="col-lg-4 mt-2">
                <div class="card" style="height: 100%">
                    <img class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= $v['title']?></h5>
                        <hr>
                        <p class="card-text"><?php
                            if (strlen($v['body']) > 200) {
                                $v['body'] = substr($v['body'], 0, 200) . '...';
                                echo $v['body'];
                            } else {
                                echo $v['body'];
                            }
                            ?> <a href="/article?id=<?= $v['article_id']; ?>">Read more.</a></p>
                    </div>
                    <div class="card-footer">
                        <?php
                            $category_arr = \classes\models\article\Category::getById($v['category_ids']);
                            if (!empty($category_arr)) {
                                $category = $category_arr['category_name'];
                            } else {
                                $category = "None found";
                            }
                        ?>
                        <small class="text-muted">Last updated: <?= substr($v['last_edited_date'], 0, 10) ?></small><span class="badge bg-primary float-end"><?= $category ?></span>
                    </div>
                </div>
            </div>

            <?php
                    }
                }
            ?>
        </div>
    </div>
    <?php require_once('includes/footer.php'); ?>
</body>
</html>