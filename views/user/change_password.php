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
<div class="container">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">

            <?php
                if (isset($_SESSION['password_errors'])) {
                    foreach ($_SESSION['password_errors'] as $key => $val) {

                        echo '<div class="alert alert-danger" role="alert">';
                        echo $val;
                        echo '</div>';
                    };

                    unset($_SESSION['password_errors']);
                };
            ?>

            <form action="/user/change-password" method="post">
                <label>Old Password</label>
                <input type="password" class="form-control" name="old-password">
                <label>New Password</label>
                <input type="password" class="form-control" name="new-password">
                <label>Repeat New Password</label>
                <input type="password" class="form-control" name="repeated-new-password">
                <div class="float-end mt-2">
                    <button type="submit" class="btn btn-primary">Change</button>
                </div>
            </form>

            <div class="float-start mt-2">
                <a class="btn btn-danger" href="/admin/dashboard">Cancel</a>
            </div>

        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>