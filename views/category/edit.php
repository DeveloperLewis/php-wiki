<?php
/* @var $category */
?>

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

                    <div class="card">
                        <div class="row m-4">
                            <div class="col-4">

                            </div>
                            <div class="col-4">

                                <?php

                                //Display all errors that show when trying to submit the post request for a new category
                                if (isset($_SESSION['errors'])) {
                                    foreach ($_SESSION['errors'] as $k => $v) {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo $v;
                                        echo '</div>';
                                    }
                                    unset($_SESSION['errors']);
                                }
                                ?>

                                <form action="/category/edit" method="post">
                                    <label>Category Name: </label>
                                    <input type="text" class="form-control" name="name" value="<?php
                                    if(isset($_SESSION['previous'])) { echo $_SESSION['previous']; unset($_SESSION['previous']); }
                                    else {
                                        if (isset($category['category_name'])) {
                                            echo $category['category_name'];
                                        }
                                    }
                                    ?>">

                                    <input type="hidden" name="id" value="<?php if (isset($category['category_id'])) { echo $category['category_id']; }?>">

                                    <button class="btn btn-primary mt-2" type="submit">Edit Category</button>
                                </form>
                            </div>
                            <div class="col-4">

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
