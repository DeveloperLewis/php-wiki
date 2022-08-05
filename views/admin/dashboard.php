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
            <h3>Welcome back, USERNAME</h3>
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
                    <?php
                    if ($_SERVER['REQUEST_URI'] == "/admin/dashboard") {
                        require_once('includes/admin/dashboard.panel.php');
                    }

                    if ($_SERVER['REQUEST_URI'] == "/admin/articles") {

                        require_once('includes/admin/articles.panel.php');
                    }

                    if ($_SERVER['REQUEST_URI'] == "/article/new") {
                        require_once('includes/admin/article_new.panel.php');
                    }

                    if ($_SERVER['REQUEST_URI'] == "/article/edit") {
                        require_once('includes/admin/article_edit.panel.php');
                    }

                    if ($_SERVER['REQUEST_URI'] == "/admin/categories") {
                        require_once('includes/admin/categories.panel.php');
                    }

                    if ($_SERVER['REQUEST_URI'] == "/category/new") {
                        require_once('includes/admin/category_new.panel.php');
                    }


                    ?>



                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>