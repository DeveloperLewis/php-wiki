<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
<?php require_once('includes/nav.php'); ?>

<div class="container">
    <div class="card m-4">
        <div class="text-center">
            <h3> <?php
                $name_arr = classes\models\user\User::getName($_SESSION['uid']);
                echo ucfirst($name_arr['first_name']);
                ?>'s Dashboard</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-2 fixed">
                    <div class="card">
                        <a class="m-1 btn btn-primary" href="/admin/dashboard" id="dashboard-button">Dashboard</a>
                        <a class="m-1 btn btn-primary" href="/admin/articles" id="articles-button">Articles</a>
                        <a class="m-1 btn btn-primary" href="/admin/categories" id="categories-button">Categories</a>
                    </div>
                </div>

                <div class="col-10">
                    <div id="dashboard-panel">
                        <div class="row">
                            <div class="col-6">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <?php
                                        if ($count_arr_articles = \classes\models\article\Article::getTotalCount($_SESSION['uid'])) {
                                            $articles_count = $count_arr_articles['COUNT(original_author)'];
                                        } else {
                                            $articles_count = 0;
                                        }
                                        ?>
                                        <h5 class="card-title">Total Articles By You: <?= $articles_count ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <?php
                                        if ($count_arr_categories = \classes\models\article\Category::getTotalCount()) {
                                            $categories_count = $count_arr_categories['COUNT(category_id)'];
                                        } else {
                                            $categories_count = 0;
                                        }
                                        ?>
                                        <h5 class="card-title">Total Categories: <?= $categories_count ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>