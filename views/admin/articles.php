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

                    <div id="articles-panel">

                        <?php
                        if (isset($_SESSION['delete_error'])) {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo $_SESSION['delete_error'];
                            echo '</div>';

                            unset($_SESSION['delete_error']);
                        }

                        //display that article success messages
                        if (isset($_SESSION['success'])) {
                            echo '<div class="alert alert-success" role="alert">';
                            echo $_SESSION['success'];
                            echo '</div>';

                            unset($_SESSION['success']);
                        }
                        ?>



                        <div class="card">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" style="display: inline-block; width: 52%;">Title</th>
                                    <th scope="col" style="display: inline-block; width: 10%">Author</th>
                                    <th scope="col" style="display: inline-block; width: 10%">Categories</th>
                                    <th scope="col" style="display: inline-block; width: 20%">Date</th>
                                </tr>
                                </thead>
                                <tbody style="overflow-y: auto; height:550px; display: block;">

                                <?php

                                //Display this if no articles exist
                                if (!$articles_array = \classes\models\article\Article::getAll($_SESSION['uid'])) {
                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo "Fetch for categories failed or none exist, try creating a new category!";
                                    echo '</div>';
                                }

                                //Display all articles in the table
                                else {
                                    foreach ($articles_array as $k => $v) {
                                        $author_name = \classes\models\user\User::getName($v['original_author']);



                                        echo '<tr onclick="sendToArticle('. $v['article_id'] . ')" style="cursor: pointer">';
                                        echo '<td>' . $v['title'] . '</td>';
                                        echo '<td>' . $author_name['first_name'] . '</td>';
                                        echo '<td>No categories found.</td>';
                                        echo '<td>' . $v['creation_date']. '</td>';
                                        echo '<form action="/article/delete" method="post">';
                                        echo '<input type="hidden" value="' . $v['article_id'] .'" name="id">';
                                        echo '<td><button class="btn btn-danger" type="submit" style="float:right;">X</button></td>';
                                        echo '</form>';

                                        echo '<form action="/article/edit" method="get">';
                                        echo '<input type="hidden" value="' . $v['article_id'] .'" name="id">';
                                        echo '<td><button class="btn btn-success" type="submit" style="float:right;">Edit</button></td>';
                                        echo '</form>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            <div class="row">

                                <div class="col">
                                    <div class="float-end">
                                        <a class="btn btn-primary" href="/article/new">Create New</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function sendToArticle(id) {
                                location.href = '/article?id=' + id;
                            }
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>
