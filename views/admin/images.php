<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('includes/header.php'); ?>
</head>
<body>
<?php require_once('includes/nav.php'); ?>

<div class="container">
    <div class="m-4">

        <div class="text-center m-4">
            <h1>Images</h1>
            <?php
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success" role="alert">';
                echo $_SESSION['success'];
                echo '</div>';

                unset($_SESSION['success']);
            }
            ?>
            <hr>
        </div>

        <div class="image">

        </div>

        <div class="row">
            <div class="col">
                <div class="float-start">
                    <a class="btn btn-danger" href="/admin/dashboard"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="/image/new">Upload New</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>