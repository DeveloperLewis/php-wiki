<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
<?php require_once('includes/nav.php'); ?>

<div class="container">
                <div class="col-12">
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

                            <form action="/category/new" method="post">
                                <label>Category Name: </label>
                                <input type="text" class="form-control" name="name" value="<?php
                                //Refill value if post failed
                                if (isset($_SESSION['previous'])) {
                                    echo $_SESSION['previous'];
                                    unset($_SESSION['previous']);
                                }
                                ?>">

                                <button class="btn btn-primary mt-2 float-end" type="submit">Add Category</button>
                                <a class="btn btn-danger mt-2 float-start" href="/admin/categories">Cancel</a>
                            </form>
                        </div>
                        <div class="col-4">

                        </div>
                    </div>
                </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>